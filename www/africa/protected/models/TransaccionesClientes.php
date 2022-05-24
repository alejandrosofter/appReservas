<?php

/**
 * This is the model class for table "transacciones_clientes".
 *
 * The followings are the available columns in table 'transacciones_clientes':
 * @property integer $id
 * @property integer $idCliente
 * @property integer $idTransaccion
 *
 * The followings are the available model relations:
 * @property Transacciones $idTransaccion0
 * @property Clientes $idCliente0
 */
class TransaccionesClientes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransaccionesClientes the static model class
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
		return 'transacciones_clientes';
	}
	public $cantidadFinal;
	public $importeFinal;
	public function diario($mes,$ano,$tipoComprobantes,$campoSalida)
	{
		$sal=array();
		$dias=cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

		for($i=0;$i<$dias;$i++){
			$cad='';
			$fecha=$ano.'-'.$mes.'-'.($i+1);
			$criteria=new CDbCriteria;
			$criteria->with=array('transaccionCli');
			$criteria->addCondition('transaccionCli.fecha="'.$fecha.'"');
			foreach($tipoComprobantes as $tipo)
				$cad.=" transaccionCli.idTipoComprobante=".$tipo. ' OR ';
			$cad.="1=1";
			$criteria->select='t.*,sum(transaccionCli.'.$campoSalida.') as importeFinal';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importeFinal; else $sal[]=0;
		}
		return $sal;
	}
	public function anual($ano,$tipoComprobantes)
	{
		$sal=array();
		for($i=0;$i<12;$i++){
			$cad='';
			$criteria=new CDbCriteria;
			$criteria->with=array('transaccionCli');
			$criteria->compare('YEAR(transaccionCli.fecha)',$ano,false);
			$criteria->compare('MONTH(transaccionCli.fecha)',($i+1),false);
			foreach($tipoComprobantes as $tipo)
				$cad.=" transaccionCli.idTipoComprobante=".$tipo. ' OR ';
			$cad.="1=1";
			$criteria->select='t.*,sum(transaccionCli.importe) as importeFinal';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importeFinal; else $sal[]=0;
		}
		return $sal;
	}
	public function anualFacturacion($ano,$tipoComprobantes)
	{
		$sal=array();
		
		for($i=0;$i<12;$i++){
			$cad='';
			$criteria=new CDbCriteria;
			$criteria->with=array('transaccionCli');
			$criteria->compare('YEAR(transaccionCli.fecha)',$ano,false);
			$criteria->compare('MONTH(transaccionCli.fecha)',($i+1),false);
			foreach($tipoComprobantes as $tipo)
				$cad.=" transaccionCli.idTipoComprobante=".$tipo. ' OR ';
			$cad.="1=1";
			$criteria->addCondition($cad);
			$criteria->select='t.*,sum(transaccionCli.importeFacturado) as importeFinal';
			$res= self::model()->findAll($criteria);
			if(count($res)>0)$sal[]=$res[0]->importeFinal; else $sal[]=0;
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
			array('idCliente, idTransaccion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idCliente, idTransaccion', 'safe', 'on'=>'search'),
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
			'transaccionCli' => array(self::BELONGS_TO, 'Transacciones', 'idTransaccion'),
			'cliente' => array(self::BELONGS_TO, 'Clientes', 'idCliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idCliente' => 'Cliente',
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
		$criteria->compare('idCliente',$this->buscar,'OR');
		$criteria->compare('idTransaccion',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}