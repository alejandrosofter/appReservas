<?php

/**
 * This is the model class for table "reservas".
 *
 * The followings are the available columns in table 'reservas':
 * @property integer $id
 * @property integer $idCliente
 * @property string $nombreCumpleano
 * @property string $estado
 * @property double $importe
 *
 * The followings are the available model relations:
 * @property Clientes $idCliente0
 * @property ReservasServicios[] $reservasServicioses
 * @property TareasReservas[] $tareasReservases
 */
class Reservas extends CActiveRecord
{
	public $dias;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reservas the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getDiasReserva()
	{
		$datetime1 = new DateTime($this->fecha);
		$datetime2 = new DateTime('now');
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%R%a días');
	}
	public function getDia2($dia,$resumido=false)
	{
		//0 lunes
		$dias=array('Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo');
		$res= $dias[($dia*1)];
		if($resumido)return substr($res,0,3);
		return $res;
	}

	public function getDia($dia,$resumido=false)
	{
		//0 lunes
		$dias=array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado');
		$res= $dias[($dia*1)];
		if($resumido)return substr($res,0,3);
		return $res;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservas';
	}
	public function cambiarImporte($nuevoImporte)
	{
		$diferencia=$nuevoImporte-$this->importe;
		foreach($this->servicios as $reservaServicio){
				$reservaServicio->costo+=$diferencia;
				$diferencia=0;
				$reservaServicio->save();
		}
		$this->importe=$nuevoImporte;
		$this->save();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCliente,dias,idTipoReserva', 'numerical', 'integerOnly'=>true),
			array('importe,dias,idTipoReserva', 'numerical'),
			array('idCliente,idTipoReserva,fecha', 'required'),
			array('nombreCumpleano, estado', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,fecha,dias,idTipoReserva, idCliente, nombreCumpleano, estado, importe', 'safe', 'on'=>'search'),
		);
	}

	public function getEstados()
	{
		return array('PENDIENTE'=>'PENDIENTE','FINALIZADO'=>'FINALIZADO');
	}
	public function getDetalleServicios()
	{	
		$serv=$this->servicios;
		$sal="";
		foreach($serv as $t)
			if(isset($t->servicio))
				$sal.=$t->servicio->nombreServicio.' <small><b>$ '.$t->costo.' '.$this->detalle($t);
		
		return $sal;
	}
	private function detalle($t)
	{
		if($t->servicio->idCategoria==1)
			return '</b> '. date("d/m/Y H:i",$t->fechaInicio).' a '.date("H:i",$t->fechaFin).'</small><br>';
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cliente' => array(self::BELONGS_TO, 'Clientes', 'idCliente'),
			'tipo' => array(self::BELONGS_TO, 'ReservasTipos', 'idTipoReserva'),
			'servicios' => array(self::HAS_MANY, 'ReservasServicios', 'idReserva'),
			'serv' => array(self::HAS_ONE, 'Servicios', array('idReserva'=>'id'),'through'=>'servicios'),
			'servicioPrim' => array(self::HAS_ONE, 'ReservasServicios', 'idReserva'),
			'pagoPrim' => array(self::HAS_ONE, 'ReservasTransacciones', 'idReserva'),
			'tareas' => array(self::HAS_MANY, 'TareasReservas', 'idReserva'),

			'pagos' => array(self::HAS_MANY, 'ReservasTransacciones', 'idReserva'),
			'duracion'=>array( self::STAT, 'ReservasServicios', 'idReserva','select'=>'SUM(fechaFin-fechaInicio)'),
			'tieneGastro'=>array( self::STAT, 'ReservasServicios', 'idReserva','select'=>'count(IF(servicios.idCategoria=2,1,0))', 'join' => 'INNER JOIN servicios ON t.idServicio = servicios.id'),
      
			'comienza'=>array( self::STAT, 'ReservasServicios', 'idReserva','select'=>' FROM_UNIXTIME(MIN(fechaInicio))',"condition"=>"servicios.idCategoria<>2", 'join' => 'INNER JOIN servicios ON t.idServicio = servicios.id'),
			'pagado'=>array( self::STAT, 'ReservasTransacciones', 'idReserva','select'=>'SUM(transacciones.importe)', 'join' => 'INNER JOIN transacciones ON t.idTransaccion = transacciones.id',),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCliente' => 'Cliente',
			'nombreCumpleano' => 'Nombre Cumpleañero',
			'estado' => 'Estado',
			'importe' => 'Importe',
			'idTipoReserva' => 'Tipo Reserva',

		);
	}
	public function impagas($idCliente)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$arr=array();
		$criteria=new CDbCriteria;
		$criteria->compare('idCliente',$idCliente,false);
		$criteria->order='id desc';
		$res= self::model()->with('pagado')->findAll($criteria);
		foreach($res as $r)
			if(($r->importe-$r->pagado)>0)
			$arr[]=array('comienza'=>date('d-m-Y H:i',strtotime($r->comienza)),'debe'=>$r->importe-$r->pagado ,'id'=>$r->id);
		return $arr;
	}
	public function proximos($gastro)
	{
		$criteria=new CDbCriteria;
		$criteria->limit=Settings::model()->getValorSistema('CANTIDAD_PROXIMOS_ALERTA');
		$criteria->addCondition('FROM_UNIXTIME(fechaInicio)>NOW()');
		//$criteria->order="IF((fechaInicio)<UNIX_TIMESTAMP(NOW()),fechaInicio,fechaInicio+100000000) desc";
		$criteria->order="fechaInicio asc";
		return self::model()->with('serv','pagado','tieneGastro')->findAll($criteria);
	}
  public function comienzaEvento()
  {
    $res= $this->model()->serv;
    $min=0;
    if(count($res)>0)$min=$res[0]->fechaInicio;
		foreach($res as $r) if($r<$min)$min=$r->fechaInicio;
    return $min;
  }
	public function todas($ano)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('servicioPrim');
		$criteria->addCondition('year(FROM_UNIXTIME(servicioPrim.fechaInicio))='.$ano);
		$res= self::model()->findAll($criteria);
		foreach($res as $r){
			$comienza=$r->comienza;
			$termina=date('Y-m-d H:i:s',strtotime($r->comienza)+$r->duracion);
			$titulo=$r->nombreCumpleano==''?$r->cliente->nombres:$r->nombreCumpleano;
			$class=$this->getClass($r);
			$color= isset($r->servicioPrim)?$r->servicioPrim->servicio->color:'';
			$arr['reservas'][]=array('className'=>$class,'start'=>$comienza,'end'=>$termina,'title'=>"".$titulo."",'allDay' => false,'color'=>'#'.$color);
		}
		$arr['feriados']=Feriados::model()->findAll();
		$arr['promociones']=Promociones::model()->findAll();
		return $arr;
	}
	private function getClass($r)
	{
		if($this->tieneGastro($r->servicios) && $this->tieneAmbientacion($r->servicios))
			return 'gastroAmbientacion';
		if($this->tieneGastro($r->servicios))return 'gastro';
		if($this->tieneAmbientacion($r->servicios))return 'ambientacion';
		return "";
	}
	private function tieneGastro($servicios)
	{
		foreach($servicios as $s)
			if(isset($s->servicio))
			if($s->servicio->idCategoria==2)//GASTRO
				return true;
		return false;
	}
	private function tieneAmbientacion($servicios)
	{
		foreach($servicios as $s)
			if(isset($s->servicio))
			if($s->servicio->idCategoria==3) //AMBIENTACION
				return true;
		return false;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cliente.nombres',$this->buscar,'OR');
		$criteria->compare('nombreCumpleano',$this->buscar,true,'OR');
		if($this->dias!='')$criteria->addCondition('DATEDIFF(NOW(),t.fecha)>'.$this->dias);
		$criteria->join="INNER join reservas_servicios on t.id=reservas_servicios.idReserva";
		
		$criteria->order="t.id desc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}