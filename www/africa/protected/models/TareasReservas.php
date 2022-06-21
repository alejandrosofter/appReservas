<?php

/**
 * This is the model class for table "tareas_reservas".
 *
 * The followings are the available columns in table 'tareas_reservas':
 * @property integer $id
 * @property integer $idTarea
 * @property integer $idReserva
 * @property integer $posicion
 *
 * The followings are the available model relations:
 * @property Reservas $idReserva0
 * @property Tareas $idTarea0
 */
class TareasReservas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TareasReservas the static model class
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
		return 'tareas_reservas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTarea, idReserva, posicion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, idTarea, idReserva, posicion', 'safe', 'on'=>'search'),
		);
	}

	public function guardar($mod,$datos)
	{
		$i=0;
		$this->quitarTodos($mod->tareas);

		foreach($datos as $item){
			$i++;
			$tarea= $this->guardarTarea($item);
			$model=new TareasReservas;
			$model->idReserva=$mod->id;
			$model->idTarea=$tarea->id;
			$model->posicion=$i;
			$model->save();
		}
	}
	private function quitarTodos($items)
	{
		foreach($items as $item)$item->delete();
	}
	private function guardarTarea($item)
	{
		$model=new Tareas;
		$model->descripcion=$item['descripcion'];
		$model->estado=$item['estado'];
		$model->fecha=$item['fecha']==''?Date('Y-m-d'):$item['fecha'];
		$model->save();
		return $model;
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'reserva' => array(self::BELONGS_TO, 'Reservas', 'idReserva'),
			'tarea' => array(self::BELONGS_TO, 'Tareas', 'idTarea'),
			'comienza'=>array( self::STAT, 'ReservasServicios', 'id','select'=>'FROM_UNIXTIME(MIN(fechaInicio))'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTarea' => 'Id Tarea',
			'idReserva' => 'Id Reserva',
			'posicion' => 'Posicion',
		);
	}

	public function proximos()
	{
		$criteria=new CDbCriteria;
		$criteria->limit=Settings::model()->getValorSistema('CANTIDAD_PROXIMOS_ALERTA');
		$criteria->compare('tarea.estado',Tareas::PENDIENTE,false);
		// $criteria->join="inner join reservas_servicios on reservas_servicios.idReserva = t.idReserva";
		$criteria->order="reserva.fecha desc";
		// $criteria->group="t.id";
		return self::model()->with('comienza','tarea','reserva')->findAll($criteria);
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->buscar,'OR');
		$criteria->compare('idTarea',$this->buscar,'OR');
		$criteria->compare('idReserva',$this->buscar,'OR');
		$criteria->compare('posicion',$this->buscar,'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}