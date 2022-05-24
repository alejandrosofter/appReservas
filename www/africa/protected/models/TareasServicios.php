<?php

/**
 * This is the model class for table "tareas_servicios".
 *
 * The followings are the available columns in table 'tareas_servicios':
 * @property integer $id
 * @property integer $idTarea
 * @property integer $idServicio
 * @property integer $posicion
 *
 * The followings are the available model relations:
 * @property Servicios $idServicio0
 * @property Tareas $idTarea0
 */
class TareasServicios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TareasServicios the static model class
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
		return 'tareas_servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTarea, idServicio, posicion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idTarea, idServicio, posicion', 'safe', 'on'=>'search'),
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
			'servicio' => array(self::BELONGS_TO, 'Servicios', 'idServicio'),
			'tarea' => array(self::BELONGS_TO, 'Tareas', 'idTarea'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTarea' => 'Id Tarea',
			'idServicio' => 'Id Servicio',
			'posicion' => 'Posicion',
		);
	}

	public function tareas($idServicio)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idServicio',$idServicio,false);
		$criteria->order='t.posicion';
		$res= self::model()->findAll($criteria);
		$arr=array();
		foreach($res as $it)$arr[]=$it->tarea;
		return $arr;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idTarea',$this->buscar,'OR');
		$criteria->compare('idServicio',$this->idServicio,false);
		$criteria->compare('posicion',$this->buscar,'OR');
		$criteria->order='t.posicion';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}