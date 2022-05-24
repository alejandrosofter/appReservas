<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $id
 * @property string $nombres
 * @property string $telefonoFijo
 * @property string $telefonoMovil
 * @property string $email
 * @property string $descripcionCliente
 *
 * The followings are the available model relations:
 * @property Reservas[] $reservases
 * @property TransaccionesClientes[] $transaccionesClientes
 */
class Clientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Clientes the static model class
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
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombres,direccion,localidad, telefonoFijo, telefonoMovil, email', 'length', 'max'=>255),
			array('descripcionCliente', 'safe'),
			array('nombres,email,telefonoMovil,idCondicionIva,cuit', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,direccion,localidad, nombres, telefonoFijo, telefonoMovil, email, descripcionCliente', 'safe', 'on'=>'search'),
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
			'reservases' => array(self::HAS_MANY, 'Reservas', 'idCliente'),
			'condicionIva' => array(self::BELONGS_TO, 'CondicionesIva', 'idCondicionIva'),
			'transaccionesClientes' => array(self::HAS_MANY, 'TransaccionesClientes', 'idCliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombres' => 'Nombre / Razón Social',
			'cuit' => 'Cuit / Dni',
			'idCondicionIva' => 'Condicion Iva',
			'telefonoFijo' => 'Telefono Fijo',
			'telefonoFijo' => 'Telefono Fijo',
			'telefonoMovil' => 'Telefono Movil',
			'email' => 'Email',
			'direccion' => 'Dirección',
			'descripcionCliente' => 'Descripcion Cliente',
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
		$criteria->compare('nombres',$this->buscar,true,'OR');
		$criteria->compare('telefonoFijo',$this->buscar,true,'OR');
		$criteria->compare('telefonoMovil',$this->buscar,true,'OR');
		$criteria->compare('email',$this->buscar,true,'OR');
		$criteria->compare('descripcionCliente',$this->buscar,true,'OR');
		$criteria->order='t.nombres';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}