<?php

/**
 * This is the model class for table "transacciones_proveedores".
 *
 * The followings are the available columns in table 'transacciones_proveedores':
 * @property integer $id
 * @property integer $idProveedor
 * @property integer $idTransaccion
 *
 * The followings are the available model relations:
 * @property Transacciones $idTransaccion0
 * @property Proveedores $idProveedor0
 */
class TransaccionesProveedores extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransaccionesProveedores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transacciones_proveedores';
	}
	public function anual($ano)
	{
		$sal=array();
		for($i=0;$i<12;$i++){
			$criteria=new CDbCriteria;
			$criteria->compare('YEAR(fecha)',$ano,false);
			$criteria->compare('MONTH(fecha)',($i+1),false);
			$criteria->select='t.*,round(SUM(importe),2) as importe';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importe; else $sal[]=0;
		}
		return $sal;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProveedor, idTransaccion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idProveedor, idTransaccion', 'safe', 'on'=>'search'),
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
			'idTransaccion0' => array(self::BELONGS_TO, 'Transacciones', 'idTransaccion'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedores', 'idProveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProveedor' => 'Proveedor',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('idProveedor',$this->idProveedor);
		$criteria->compare('idTransaccion',$this->idTransaccion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}