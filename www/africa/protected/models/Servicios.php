<?php

/**
 * This is the model class for table "servicios".
 *
 * The followings are the available columns in table 'servicios':
 * @property integer $id
 * @property string $nombreServicio
 * @property double $importe
 * @property double $duracionTiempo
 * @property string $color
 * @property integer $idServicioPadre
 * @property string $descripcion
 * @property double $importe2
 * @property integer $idCategoria
 *
 * The followings are the available model relations:
 * @property PromocionesServicios[] $promocionesServicioses
 * @property ReservasServicios[] $reservasServicioses
 * @property ServiciosCategorias $idCategoria0
 * @property Servicios $idServicioPadre0
 * @property Servicios[] $servicioses
 * @property ServiciosPeloteros[] $serviciosPeloteroses
 * @property TareasServicios[] $tareasServicioses
 */
class Servicios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Servicios the static model class
	 */
	 public $buscar;
	 public $anoStat;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idServicioPadre, idCategoria,duracionTiempo', 'numerical', 'integerOnly'=>true),
			array('importe, duracionTiempo, importe2', 'numerical'),
			array('nombreServicio, color', 'length', 'max'=>255),
			array('descripcion', 'safe'),
			array('nombreServicio,importe,importe2', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreServicio, importe, duracionTiempo, color, idServicioPadre, descripcion, importe2, idCategoria', 'safe', 'on'=>'search'),
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
			'promocionesServicioses' => array(self::HAS_MANY, 'PromocionesServicios', 'idServicio'),
			'reservasServicioses' => array(self::HAS_MANY, 'ReservasServicios', 'idServicio'),
			'stat' => array(self::STAT, 'ReservasServicios', 'idServicio','select'=>'SUM(costo)'),
			'cantidad' => array(self::STAT, 'ReservasServicios', 'idServicio','select'=>'count(id)'),
			'categoria' => array(self::BELONGS_TO, 'ServiciosCategorias', 'idCategoria'),
			'servicio' => array(self::BELONGS_TO, 'Servicios', 'idServicioPadre'),
			'servicioses' => array(self::HAS_MANY, 'Servicios', 'idServicioPadre'),
			'peloteros' => array(self::HAS_MANY, 'ServiciosPeloteros', 'idServicio'),
			'tareasServicioses' => array(self::HAS_MANY, 'TareasServicios', 'idServicio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreServicio' => 'Nombre Servicio',
			'importe' => 'Importe Semana',
			'duracionTiempo' => 'Duración Tiempo',
			'color' => 'Color',
			'idServicioPadre' => 'Servicio Padre',
			'descripcion' => 'Descripcion',
			'importe2' => 'Importe Fín Semana',
			'idCategoria' => 'Categoria',
		);
	}
	public $cantidadTotal;
	public $importeTotal;
	public function estadistica($ano,$agrupa,$mes=null)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('reservasServicioses');
		$criteria->addCondition("YEAR(FROM_UNIXTIME(reservasServicioses.fechaInicio))=".$ano);
		$criteria->select='t.*,sum(reservasServicioses.costo) as importeTotal,count(reservasServicioses.id) as cantidadTotal';
		if($mes!=null)$criteria->addCondition("MONTH(FROM_UNIXTIME(reservasServicioses.fechaInicio))=".$mes);
		switch ($agrupa){
			case 'idServicio':$ag='idServicio';break;
			case 'dia':$ag='DAYOFWEEK(FROM_UNIXTIME(reservasServicioses.fechaInicio))';break;
		}
		$criteria->group=$ag;
		$criteria->having=('costo>0');
		return self::model()->findAll($criteria);
	}
	public function hijos($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		if($id=='')$id=0;
		$criteria->compare('idServicioPadre',$id,false);
		$criteria->order='nombreServicio';
		return self::model()->findAll($criteria);
	}
	public function serviciosPadres()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addCondition('isnull(idServicioPadre)');
		$criteria->order='t.idCategoria,nombreServicio';
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreServicio',$this->buscar,true,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('duracionTiempo',$this->buscar,'OR');
		$criteria->compare('color',$this->buscar,true,'OR');
		$criteria->compare('idServicioPadre',$this->buscar,'OR');
		$criteria->compare('descripcion',$this->buscar,true,'OR');
		$criteria->compare('importe2',$this->buscar,'OR');
		$criteria->compare('idCategoria',$this->buscar,'OR');
		$criteria->order='t.idServicioPadre';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>20)
		));
	}
}