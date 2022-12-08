<?php

/**
 * This is the model class for table "cierreCaja_items".
 *
 * The followings are the available columns in table 'cierreCaja_items':
 * @property integer $id
 * @property integer $idCierreCaja
 * @property integer $idTransaccion
 *
 * The followings are the available model relations:
 * @property CierreCaja $idCierreCaja0
 */
class CierreCajaItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CierreCajaItems the static model class
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
		return 'cierreCaja_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCierreCaja, idTransaccion', 'required'),
			array('idCierreCaja, idTransaccion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idCierreCaja, idTransaccion', 'safe', 'on'=>'search'),
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
			'idCierreCaja0' => array(self::BELONGS_TO, 'CierreCaja', 'idCierreCaja'),
			'transaccion' => array(self::BELONGS_TO, 'Transacciones', 'idTransaccion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCierreCaja' => 'Id Cierre Caja',
			'idTransaccion' => 'Id Transaccion',
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
		$criteria->compare('idCierreCaja',$this->buscar,'OR');
		$criteria->compare('idTransaccion',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}