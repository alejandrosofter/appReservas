<?php

/**
 * This is the model class for table "tareas".
 *
 * The followings are the available columns in table 'tareas':
 * @property integer $id
 * @property string $descripcion
 * @property string $estado
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property TareasReservas[] $tareasReservases
 * @property TareasServicios[] $tareasServicioses
 */
class Tareas extends CActiveRecord
{
	const PENDIENTE="PENDIENTE";
	const LISTO="LISTO";
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tareas the static model class
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
		return 'tareas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado', 'length', 'max'=>255),
			array('descripcion, fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, descripcion, estado, fecha', 'safe', 'on'=>'search'),
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
			'tareasReservases' => array(self::HAS_MANY, 'TareasReservas', 'idTarea'),
			'tareasServicioses' => array(self::HAS_MANY, 'TareasServicios', 'idTarea'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descripcion' => 'Descripcion',
			'estado' => 'Estado',
			'fecha' => 'Fecha',
		);
	}

	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('descripcion',$this->buscar,true,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');
		$criteria->compare('fecha',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}