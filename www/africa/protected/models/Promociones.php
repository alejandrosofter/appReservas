<?php

/**
 * This is the model class for table "promociones".
 *
 * The followings are the available columns in table 'promociones':
 * @property integer $id
 * @property string $titulo
 * @property double $importe
 * @property double $porcentaje
 * @property string $fechaInicio
 * @property string $fechaExpira
 *
 * The followings are the available model relations:
 * @property PromocionesServicios[] $promocionesServicioses
 */
class Promociones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promociones the static model class
	 */
	 public $buscar;
	 public $servicios;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promociones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('importe, porcentaje', 'numerical'),
			array('titulo,fechaInicio,fechaExpira', 'required'),
			array('titulo', 'length', 'max'=>255),
			array('fechaInicio, fechaExpira', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,servicios, titulo, importe, porcentaje, fechaInicio, fechaExpira', 'safe', 'on'=>'search'),
		);
	}
	private function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false){
   $f0 = strtotime($fecha_principal);
   $f1 = strtotime($fecha_secundaria);
   if ($f0 < $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp; }
   $resultado = ($f0 - $f1);
   switch ($obtener) {
       default: break;
       case "MINUTOS"   :   $resultado = $resultado / 60;   break;
       case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
       case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
       case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
   }
   if($redondear) $resultado = round($resultado);
   return $resultado;
}
	public function getEstado()
	{
		$fechaActual=Date('Y-m-d');
		if($fechaActual>$this->fechaInicio &&$fechaActual<=$this->fechaExpira)
		{
			$dias=$this->diferenciaEntreFechas($fechaActual,$this->fechaExpira,'DIAS');
			return 'Activa (restan '.$dias.' días)';
			} 
		if($fechaActual>$this->fechaExpira) return 'Finalizada';
		return  'no';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'promocionesServicioses' => array(self::HAS_MANY, 'PromocionesServicios', 'idPromocion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'titulo' => 'Titulo',
			'importe' => 'Importe',
			'porcentaje' => 'Porcentaje',
			'fechaInicio' => 'Fecha Inicio',
			'fechaExpira' => 'Fecha Expira',
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
		$criteria->compare('titulo',$this->buscar,true,'OR');
		$criteria->compare('importe',$this->buscar,'OR');
		$criteria->compare('porcentaje',$this->buscar,'OR');
		$criteria->compare('fechaInicio',$this->buscar,true,'OR');
		$criteria->compare('fechaExpira',$this->buscar,true,'OR');
		$criteria->order='IF(UNIX_TIMESTAMP(fechaExpira)-UNIX_TIMESTAMP(NOW())<0,UNIX_TIMESTAMP(fechaExpira)-UNIX_TIMESTAMP(NOW())+10000000,UNIX_TIMESTAMP(fechaExpira)-UNIX_TIMESTAMP(NOW()))';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}