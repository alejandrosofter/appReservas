<?php

/**
 * This is the model class for table "transacciones_tipos_nro".
 *
 * The followings are the available columns in table 'transacciones_tipos_nro':
 * @property integer $id
 * @property integer $idTransaccionTipo
 * @property integer $proximoNro
 *
 * The followings are the available model relations:
 * @property TransaccionesTipos $idTransaccionTipo0
 */
class TransaccionesTiposNro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransaccionesTiposNro the static model class
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
		return 'transacciones_tipos_nro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTransaccionTipo, proximoNro', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idTransaccionTipo, proximoNro', 'safe', 'on'=>'search'),
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
			'tipo' => array(self::BELONGS_TO, 'TransaccionesTipos', 'idTransaccionTipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTransaccionTipo' => 'Id Transaccion Tipo',
			'proximoNro' => 'Proximo Nro',
		);
	}

	public function getProximo($idTipoTransaccion)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('idTransaccionTipo',$idTipoTransaccion,"AND",false);
		$res=self::model()->findAll($criteria);
		foreach($res as $item)return $item->proximoNro;
		return 0;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idTransaccionTipo',$this->buscar,'OR');
		$criteria->compare('proximoNro',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}