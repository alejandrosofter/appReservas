<?php

/**
 * This is the model class for table "proveedores".
 *
 * The followings are the available columns in table 'proveedores':
 * @property integer $id
 * @property string $nombreProveedor
 * @property string $cuit
 * @property string $direccion
 * @property string $telefonoFijo
 * @property string $nombreContacto
 * @property string $telefonoContacto
 * @property string $emailProveedor
 *
 * The followings are the available model relations:
 * @property TransaccionesProveedores[] $transaccionesProveedores
 */
class Proveedores extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proveedores the static model class
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
		return 'proveedores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombreProveedor, cuit, direccion, telefonoFijo, nombreContacto, telefonoContacto, emailProveedor', 'length', 'max'=>255),
			array('nombreProveedor,emailProveedor,telefonoContacto', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreProveedor, cuit, direccion, telefonoFijo, nombreContacto, telefonoContacto, emailProveedor', 'safe', 'on'=>'search'),
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
			'transaccionesProveedores' => array(self::HAS_MANY, 'TransaccionesProveedores', 'idProveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreProveedor' => 'Nombre Proveedor',
			'cuit' => 'Cuit',
			'direccion' => 'Direccion',
			'telefonoFijo' => 'Telefono Fijo',
			'nombreContacto' => 'Nombre Contacto',
			'telefonoContacto' => 'Telefono Contacto',
			'emailProveedor' => 'Email Proveedor',
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
		$criteria->compare('nombreProveedor',$this->buscar,true,'OR');
		$criteria->compare('cuit',$this->buscar,true,'OR');
		$criteria->compare('direccion',$this->buscar,true,'OR');
		$criteria->compare('telefonoFijo',$this->buscar,true,'OR');
		$criteria->compare('nombreContacto',$this->buscar,true,'OR');
		$criteria->compare('telefonoContacto',$this->buscar,true,'OR');
		$criteria->compare('emailProveedor',$this->buscar,true,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}