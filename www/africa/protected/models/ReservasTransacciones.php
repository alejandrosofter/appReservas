<?php

/**
 * This is the model class for table "reservas_transacciones".
 *
 * The followings are the available columns in table 'reservas_transacciones':
 * @property integer $id
 * @property integer $idTransaccion
 * @property integer $idReserva
 *
 * The followings are the available model relations:
 * @property Reservas $idReserva0
 * @property Transacciones $idTransaccion0
 */
class ReservasTransacciones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReservasTransacciones the static model class
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
		return 'reservas_transacciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTransaccion, idReserva', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idTransaccion, idReserva', 'safe', 'on'=>'search'),
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
			'reserva' => array(self::BELONGS_TO, 'Reservas', 'idReserva'),
			'transaccion' => array(self::BELONGS_TO, 'Transacciones', 'idTransaccion'),
		);
	}
	public function guardar($mod,$datos)
	{
		$this->quitarTodos($mod->pagos);
		foreach($datos as $item){
			$transaccion= $this->guardarTransaccion($item,$mod);
			$model=new ReservasTransacciones;
			$model->idReserva=$mod->id;
			$model->idTransaccion=$transaccion->id;
			$model->save();

		}
		if(isset($model))return $model->idTransaccion;
		
		
	}
	private function quitarTodos($items)
	{
		foreach($items as $item)$item->delete();
	}
	private function getTipo($tipo,$idCliente)
	{
		$cliente=Clientes::model()->findByPk($idCliente);
		return $tipo==1?$cliente->condicionIva->tipoTransaccion->id:TransaccionesTipos::COMP_X;
	}
	private function guardarTransaccion($item,$modelReserva)
	{
		$model=new Transacciones;
		if($item['id']>0)$model->id=$item['id'];
		$model->importe=$item['importe'];
		$model->fecha=$item['fecha']==''?Date('Y-m-d'):$item['fecha'];
		$model->detalle="Entrega por reserva!";
		$model->idTipoComprobante=2; //es recivo X
		$model->importeFacturado=$model->idTipoComprobante==2?0:$model->importe;
		$model->nroComprobante=TransaccionesTiposNro::model()->getProximo(2);
		$model->save();

		$mt=new TransaccionesClientes;
		$mt->idTransaccion=$model->id;
		$mt->idCliente=$modelReserva->idCliente;
		$mt->save();
		return $model;
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTransaccion' => 'Id Transaccion',
			'idReserva' => 'Id Reserva',
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
		$criteria->compare('idTransaccion',$this->buscar,'OR');
		$criteria->compare('idReserva',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}