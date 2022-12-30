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
			array('importe,oldImporte,dias,idTipoReserva', 'numerical'),
			array('idCliente,idTipoReserva,fecha', 'required'),
			array('nombreCumpleano, estado', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fechaUpdateImporte,oldImporte,buscar,id,fecha,dias,idTipoReserva, idCliente, nombreCumpleano, estado, importe', 'safe', 'on'=>'search'),
		);
	}

	public function getEstados()
	{
		return array('PENDIENTE'=>'PENDIENTE','FINALIZADO'=>'FINALIZADO');
	}
	public function getEstadosReserva()
	{
		return array('PENDIENTE'=>'PENDIENTE','CANCELADA'=>'CANCELADA');
	}
	public function getDetalleServicios($html=true)
	{	
		$serv=$this->servicios;
		$sal="";
		foreach($serv as $t)
			if(isset($t->servicio))
				if($html)
					$sal.=$t->servicio->nombreServicio.' <small><b>$ '.number_format($t->costo,2).' '.$this->detalle($t);
					else $sal.=$t->servicio->nombreServicio.' $ '.number_format($t->costo,2).' '.$this->detalleSolo($t);
		
		return $sal;
	}
	private function detalleSolo($t)
	{
		if($t->servicio->idCategoria==1)
			return ''. date("d/m/Y H:i",$t->fechaInicio).' a '.date("H:i",$t->fechaFin).'';
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
	public function estadoActualizacion(){
		if($this->importe!= $this->oldImporte && $this->oldImporte!=0){
			return Yii::app()->dateFormatter->format("dd/MM/yy",$this->fechaUpdateImporte)." $".$this->oldImporte."->$".$this->importe;
		}
		return "-";
	}
	public function estadoActualizarTarifa(){
		$dias=$this->getDiasReserva();
		$cantidadDias= Settings::model()->getValorSistema('RESERVAS_DIAS_VTO');
		return $cantidadDias>$dias?"ACTUALIZABLE":"EN FECHA";
	}
	public function vencimientos($returnArray=false)
	{
		$cantidadDias=Settings::model()->getValorSistema('RESERVAS_DIAS_VTO');
		$criteria=new CDbCriteria;
		$criteria->with=array('pagado');
		$criteria->addCondition('DATEDIFF(NOW(),t.fecha)>'.$cantidadDias);
		$criteria->addCondition('t.estado="PENDIENTE"');
		// $criteria->addCondition('pagado>=t.importe');
		$criteria->order="t.id desc";
		if($returnArray) return self::model()->findAll($criteria);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));

	}
	public function actualizarImporteReserva(){
		$this->actualizarReservasServicios();
		$this->recalcularImporte();
	}
	public function actualizarReservasServicios(){
		
		foreach($this->servicios as $servicio){
			$fecha=date('Y-m-d',strtotime($this->fecha));
			$newValue=Servicios::model()->importeServicio($servicio->idServicio,$fecha);
			// 
			$servicio->costo=$newValue['importe'];
			$servicio->save();
		}
	}
	public function recalcularImporte(){
		$importe=0;
	
		foreach($this->servicios as $servicio)
			$importe+=$servicio->costo;
		$oldImporte=$this->importe;
		$this->importe=$importe;
		
		if($oldImporte!=$importe){
			echo "actualizando reserva nuevo valor".$importe." old value ".$oldImporte." <br>";
			$this->oldImporte=$oldImporte;
			$this->fechaUpdateImporte=date('Y-m-d H:i:s');
			$this->save();
		}
		// else {
		// 	echo "no se actualiza importe <br>";
		// }
		
	}
	public function actualizaReservaEstado()
	{
		// $reserva=Reservas::model()->findByPk($idReserva);
		$estado=$this->pagado>=$this->importe?"CANCELADA":"PENDIENTE";
		$this->estado=$estado;
	
		//si la el anio de la reserva es menor al anio actual, la cancelo
		if(date('Y',strtotime($this->fecha))*1<=2020)$this->estado='CANCELADA';
		$this->save();
	}
	public function rollBackImporte()
	{
		$importe=0;
	
		foreach($this->servicios as $servicio)
			$importe+=$servicio->costo;
		// if($this->oldImporte>0){
		// 	$this->importe=$this->oldImporte;
		// 	$this->oldImporte=0;
		// 	$this->fechaUpdateImporte=null;
		// 	$this->save();
		if($this->importe!=$importe && count($this->servicios)==1){
			echo "ACTUALIZA VALOR SERVICIO <br>";
			foreach($this->servicios as $servicio){
				$servicio->costo=$this->importe;
				$servicio->save();
			}
		}
		if(count($this->servicios)>1 && $this->importe!=$importe)	
		 echo "CAMBIO MANUAL idReserva ".$this->id." cantidad servicios: ".count($this->servicios)." a reserva ".$this->nombreCumpleano." importe ".$this->importe." importe ".$importe." <br>"; 
		// }
	}
	public function getColor(){
		if($this->estado=='CANCELADA')return '#919191';
		if($this->estado=='PENDIENTE')return '#fd6363';
	}
	public function buscar()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('pagado');
		$criteria->compare('cliente.nombres',$this->buscar,'OR');
		$criteria->compare('nombreCumpleano',$this->buscar,true,'OR');
		if($this->dias!='')$criteria->addCondition('DATEDIFF(NOW(),t.fecha)>'.$this->dias);
		$criteria->join="INNER join reservas_servicios on t.id=reservas_servicios.idReserva";
		
		$criteria->order="t.id desc";
		return self::model()->with('serv','pagado','tieneGastro')->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('pagado');
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