<?php

/**
 * This is the model class for table "promociones_servicios".
 *
 * The followings are the available columns in table 'promociones_servicios':
 * @property integer $id
 * @property integer $idPromocion
 * @property integer $idServicio
 *
 * The followings are the available model relations:
 * @property Servicios $idServicio0
 * @property Promociones $idPromocion0
 */
class PromocionesServicios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PromocionesServicios the static model class
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
		return 'promociones_servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPromocion, idServicio', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idPromocion, idServicio', 'safe', 'on'=>'search'),
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
			'promocion' => array(self::BELONGS_TO, 'Promociones', 'idPromocion'),
		);
	}

	public function getPromociones($idServicio,$fecha)
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('promocion');
		$criteria->compare('idServicio',$idServicio,false);
		$criteria->addCondition("'$fecha' >= promocion.fechaInicio AND '$fecha' <= promocion.fechaExpira");
		return self::model()->findAll($criteria);

	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idPromocion' => 'Id Promocion',
			'idServicio' => 'Id Servicio',
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
		$criteria->compare('idPromocion',$this->idPromocion);
		$criteria->compare('idServicio',$this->idServicio);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}