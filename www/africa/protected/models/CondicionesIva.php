<?php

/**
 * This is the model class for table "condicionesIva".
 *
 * The followings are the available columns in table 'condicionesIva':
 * @property integer $id
 * @property string $nombreCondicionIva
 * @property integer $idTransaccionTipo
 *
 * The followings are the available model relations:
 * @property Clientes[] $clientes
 * @property TransaccionesTipos $idTransaccionTipo0
 */
class CondicionesIva extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CondicionesIva the static model class
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
		return 'condicionesIva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTransaccionTipo', 'numerical', 'integerOnly'=>true),
			array('nombreCondicionIva', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreCondicionIva, idTransaccionTipo', 'safe', 'on'=>'search'),
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
			'clientes' => array(self::HAS_MANY, 'Clientes', 'idCondicionIva'),
			'tipoTransaccion' => array(self::BELONGS_TO, 'TransaccionesTipos', 'idTransaccionTipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreCondicionIva' => 'Nombre Condicion Iva',
			'idTransaccionTipo' => 'Id Transaccion Tipo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreCondicionIva',$this->buscar,true,'OR');
		$criteria->compare('idTransaccionTipo',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}