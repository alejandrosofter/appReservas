<?php

/**
 * This is the model class for table "transacciones_tipos".
 *
 * The followings are the available columns in table 'transacciones_tipos':
 * @property integer $id
 * @property string $nombreTipoTransaccion
 * @property integer $idPlantilla
 * @property integer $esFiscal
 * @property integer $proximo
 *
 * The followings are the available model relations:
 * @property CondicionesIva[] $condicionesIvas
 * @property Transacciones[] $transacciones
 * @property Plantillas $idPlantilla0
 */
class TransaccionesTipos extends CActiveRecord
{
	const COMP_X=2;
	const COMP_IVA=1;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransaccionesTipos the static model class
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
		return 'transacciones_tipos';
	}
	public function discriminaIva()
	{
		if($this->id==self::COMP_IVA)
			return true;
		return false;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPlantilla, esFiscal, proximo', 'numerical', 'integerOnly'=>true),
			array('nombreTipoTransaccion', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, nombreTipoTransaccion, idPlantilla, esFiscal, proximo', 'safe', 'on'=>'search'),
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
			'condicionesIvas' => array(self::HAS_MANY, 'CondicionesIva', 'idTransaccionTipo'),
			'transacciones' => array(self::HAS_MANY, 'Transacciones', 'idTipoComprobante'),
			'plantilla' => array(self::BELONGS_TO, 'Plantillas', 'idPlantilla'),
			'nro' => array(self::HAS_ONE, 'TransaccionesTiposNro', 'idTransaccionTipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombreTipoTransaccion' => 'Nombre Tipo Transaccion',
			'idPlantilla' => 'Id Plantilla',
			'esFiscal' => 'Es Fiscal',
			'proximo' => 'Proximo',
		);
	}

	public function aumentaProximo()
	{
		$modeloProx=$this->nro;
		$modeloProx->proximoNro=$modeloProx->proximoNro+1;
		$modeloProx->save();
	}
	public function proximoNro($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$id,false);
		$res=self::model()->findAll($criteria);
		if($res>0)return $res[0]->proximo;
		return 0;
	}
	public function porEstado($estado)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('estado',$estado);
		return self::model()->findAll($criteria);
	}
	public function soloElectronicas()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('esElectronica',"1");
		return self::model()->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('nombreTipoTransaccion',$this->buscar,true,'OR');
		$criteria->compare('idPlantilla',$this->buscar,'OR');
		$criteria->compare('esFiscal',$this->buscar,'OR');
		$criteria->compare('proximo',$this->buscar,'OR');
		$criteria->order='t.importe';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}