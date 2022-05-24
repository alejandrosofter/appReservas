<?php

/**
 * This is the model class for table "reservas_servicios".
 *
 * The followings are the available columns in table 'reservas_servicios':
 * @property integer $id
 * @property integer $idReserva
 * @property integer $idServicio
 * @property integer $fechaInicio
 * @property integer $fechaFin
 * @property double $costo
 *
 * The followings are the available model relations:
 * @property Reservas $idReserva0
 * @property Servicios $idServicio0
 */
class ReservasServicios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReservasServicios the static model class
	 */
	 public $buscar;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}   
 
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservas_servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idReserva, idServicio, fechaInicio, fechaFin', 'numerical', 'integerOnly'=>true),
			array('costo', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idReserva, idServicio, fechaInicio, fechaFin, costo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'reserva' => array(self::BELONGS_TO, 'Reservas', 'idReserva'),
			'servicio' => array(self::BELONGS_TO, 'Servicios', 'idServicio'),
      'gastro' => array(self::BELONGS_TO, 'Servicios', 'idServicio',"condition"=>"servicios.idCategoria=2", 'join' => 'INNER JOIN servicios ON t.idServicio = servicios.id'),
			'pelot'=>array(
                self::HAS_MANY,'ServiciosPeloteros',array('id'=>'idServicio'),'through'=>'servicio'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idReserva' => 'Id Reserva',
			'idServicio' => 'Id Servicio',
			'fechaInicio' => 'Fecha Inicio',
			'fechaFin' => 'Fecha Fin',
			'costo' => 'Costo',
		);
	}
	public function proximosGastro()
	{
		$criteria=new CDbCriteria;
		$criteria->limit=20;
		$criteria->addCondition('servicio.idCategoria=2');
		$criteria->addCondition('FROM_UNIXTIME(fechaInicio)>NOW()');
		//$criteria->order="IF((fechaInicio)<UNIX_TIMESTAMP(NOW()),fechaInicio,fechaInicio+100000000) asc";
		$criteria->order="fechaInicio";
		return self::model()->with('servicio','reserva')->findAll($criteria);
	}
	public function guardar($mod,$datos)
	{
		$this->quitarTodos($mod->servicios);

		foreach($datos as $item){
			$model=new ReservasServicios;
			$model->idReserva=$mod->id;
			$model->idServicio=$item['idServicio'];
			$model->fechaInicio=strtotime($item['fecha'].' '.$item['hora']);
			$model->fechaFin=strtotime($item['fecha'].' '.$item['hora'])+$item['duracionTiempo']*60;
			$model->costo=$item['importe'];
			$model->save();
		}
	}
	public $dia;
	public $cantidad;
	public function estadistica($ano,$agrupa,$mes=null)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('YEAR(FROM_UNIXTIME(fechaInicio))='.$ano);
		if($mes!=null)$criteria->addCondition('MONTH(FROM_UNIXTIME(fechaInicio))='.$mes);
		switch ($agrupa){
			case 'idServicio':$ag='idServicio';break;
			case 'dia':$ag='WEEKDAY(FROM_UNIXTIME(t.fechaInicio))';break;
			default: $ag='';
		}
		$criteria->group=$ag;
		$criteria->select='t.*,WEEKDAY(FROM_UNIXTIME(t.fechaInicio)) as dia,sum(costo) as costo,count(t.id) as cantidad';
		return self::model()->with('servicio','reserva')->findAll($criteria);
	}
	public function estadisticaFecha($fecha,$idCat=1)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('servicio');
			$criteria->addCondition('servicio.idCategoria='.$idCat);
		$criteria->addCondition('DATE_FORMAT(FROM_UNIXTIME(fechaInicio),"%Y-%m-%d")="'.$fecha.'"');
		$criteria->select='t.*,sum(costo) as costo,count(t.id) as cantidad';
		$res= self::model()->with('servicio','reserva')->findAll($criteria);
		if(count($res)>0)$sal=$res[0]->costo; else $sal=0;
		return $sal;
	}
	public function diario($ano,$mes,$idCat=1)
	{
		$sal=array();
		$dias=cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

		for($i=0;$i<$dias;$i++){
			$fecha=$ano.'-'.$mes.'-'.str_pad(($i+1), 2, "0", STR_PAD_LEFT);
			$sal[]=$this->estadisticaFecha($fecha,$idCat);
		}
		return $sal;

	}
	public function estaDisponible($fechaStampInicio,$fechaFin,$idServicio)
	{
		$servicio=Servicios::model()->findByPk($idServicio);
		
		$criteria=new CDbCriteria;
		$criteria->with=array('pelot');
		$criteria->addCondition('('.$fechaStampInicio.'>= fechaInicio AND '.$fechaStampInicio.' <= fechaFin) OR ('.$fechaFin.'>= fechaInicio AND '.$fechaFin.' <= fechaFin)');
		$i=0;$str="";
		foreach($servicio->peloteros as $pelotero){
			$i++;
			$sep=count($servicio->peloteros)==$i?'':' OR ';
			$str.=' pelot.idPelotero='.$pelotero->idPelotero.$sep;
		}
			$criteria->addCondition($str);
			
		$res=self::model()->findAll($criteria);
		if(count($res)>0) return false;
		return true;
	}
	public function mensual($ano,$mes)
	{
		$sal=array();
		$res= $this->estadisticaFecha ($ano,'',$mes);
		if(count($res)>0)$sal[]=$res[0]->costo; else $sal[]=0;
		return $sal;
	}
	public $importeFinal;
	public function anual($ano,$catServicio=1)
	{
		$sal=array();
		
		for($i=0;$i<12;$i++){
			$cad='';
			$criteria=new CDbCriteria;

			$criteria->with=array('servicio');
			$criteria->addCondition('servicio.idCategoria='.$catServicio);
			$criteria->compare('YEAR(FROM_UNIXTIME(fechaInicio))',$ano,false);
			$criteria->compare('MONTH(FROM_UNIXTIME(fechaInicio))',($i+1),false);
			$criteria->select='t.*,sum(costo) as importeFinal';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importeFinal; else $sal[]=0;
		}
		return $sal;
	}
	private function quitarTodos($items)
	{
		foreach($items as $item)$item->delete();
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idReserva',$this->buscar,'OR');
		$criteria->compare('idServicio',$this->buscar,'OR');
		$criteria->compare('fechaInicio',$this->buscar,'OR');
		$criteria->compare('fechaFin',$this->buscar,'OR');
		$criteria->compare('costo',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}