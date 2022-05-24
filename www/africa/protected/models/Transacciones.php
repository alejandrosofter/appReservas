<?php

/**
 * This is the model class for table "transacciones".
 *
 * The followings are the available columns in table 'transacciones':
 * @property integer $id
 * @property string $fecha
 * @property double $importe
 * @property string $detalle
 * @property string $color
 *
 * The followings are the available model relations:
 * @property TransaccionesClientes[] $transaccionesClientes
 * @property TransaccionesProveedores[] $transaccionesProveedores
 */
class Transacciones extends CActiveRecord
{
		public $fechaInicio;
	public $fechaFin;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transacciones the static model class
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
		return 'transacciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('importe,importeFacturado', 'numerical'),
			array('color', 'length', 'max'=>255),
			array('fecha, detalle', 'safe'),
			array('fecha, importe,nroComprobante,idTipoComprobante', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,importeFacturado,idTipoComprobante,nroComprobante,fechaInicio,fechaFin,id, fecha, importe, detalle, color', 'safe', 'on'=>'search'),
		);
	}
	public function getnombreEmisor()
	{
		if(isset($this->cliente))
			return $this->cliente->cliente->nombres;
		if(isset($this->proveedor))
		return $this->proveedor->proveedor->nombreProveedor;
	}
	public function getIcono()
	{
		if(isset($this->cliente))
			return '<img title="$ Ingreso" src="images/iconos/famfam/arrow_right.png"/>';
		return '<img title="$ Egreso" src="images/iconos/famfam/arrow_left.png"/>';
	}
	public function getServicios($html=true)
	{
		$rt=$this->reservaTransaccion;
		if($html)return $this->htmlServicios($rt->reserva->servicios,$rt->transaccion,$rt->reserva);
		return $rt->reserva->servicios;
	}
	private function htmlServicios($servicios,$trans,$reserva)
	{

		if($trans->tipoComprobante->discriminaIva())
			return $this->htmlDiscrimina($servicios,$trans,$reserva);
		if($trans->tipoComprobante->id==TransaccionesTipos::COMP_X) return $this->htmlRecivo($servicios,$trans,$reserva);
		return $this->htmlNoDiscrimina($servicios,$trans,$reserva);
	}
	private function htmlRecivo($servicios,$trans,$reserva)
	{
		$cad='<table class="table table-condensed">';
		$cad.='<tr><th>Servicio</th><th>Detalle</th><th>Importe</th></tr>';
		$saldo=number_format($reserva->importe-$reserva->pagado,2);
		foreach($servicios as $serv){
			$importe=($trans->importeFacturado=='' || $trans->importeFacturado==0)?$trans->importe:$trans->importeFacturado;
			$detalle=$serv->servicio->idCategoria==1?'El día '.Date('d/m/Y',$serv->fechaInicio).' DESDE las '.Date('H:i',$serv->fechaInicio).' HASTA las '.Date('H:i',$serv->fechaFin):$serv->servicio->descripcion;
			$cad.='<tr><td>'.$serv->servicio->nombreServicio.'</td><td>'.$detalle.'</td><td> $'.number_format($importe,2).'</td></tr>';
		}
		$cad.='</table>';
		
		return $cad;
	}
	private function htmlNoDiscrimina($servicios,$trans,$reserva)
	{
		$cad='<table class="table table-condensed">';
		$cad.='<tr><th>Servicio</th><th>Detalle</th><th>Importe</th></tr>';
		$saldo=number_format($reserva->importe-$reserva->pagado,2);
		foreach($servicios as $serv){
			$importe=($trans->importeFacturado=='' || $trans->importeFacturado==0)?$trans->importe:$trans->importeFacturado;
			$detalle=$serv->servicio->idCategoria==1?'El día '.Date('d/m/Y',$serv->fechaInicio).' DESDE las '.Date('H:i',$serv->fechaInicio).' HASTA las '.Date('H:i',$serv->fechaFin):$serv->servicio->descripcion;
			$cad.='<tr><td>'.$serv->servicio->nombreServicio.'</td><td>'.$detalle.'</td><td> $'.number_format($importe,2).'</td></tr>';
		}
		$cad.='</table>';
		$cad.="<br><br><br><br><br><br><br><br><br><br>";
		$cad.='<div style="float:right">SUB-TOTAL $'.number_format($importe,2).'</div><br>';
		$cad.='<big><big><div style="float:right">TOTAL $'.number_format($importe,2).'</div></big></big>';
		
		return $cad;
	}
	private function htmlDiscrimina($servicios,$trans,$reserva)
	{
		$cad='<table class="table table-condensed">';
		$cad.='<tr><th>Servicio</th><th>Detalle</th><th>IVA 21</th><th>Neto</th><th>Importe</th></tr>';
		$neto=0;
		$total=0;
		$ivaSum=0;
		$saldo=number_format($reserva->importe-$reserva->pagado,2);
		foreach($servicios as $serv){
			$importe=($trans->importeFacturado=='' || $trans->importeFacturado==0)?$trans->importe:$trans->importeFacturado;
			$iva=$importe-($importe/1.21);
			$detalle=$serv->servicio->idCategoria==1?'El día '.Date('d/m/Y',$serv->fechaInicio).' DESDE las '.Date('H:i',$serv->fechaInicio).' HASTA las '.Date('H:i',$serv->fechaFin):$serv->servicio->descripcion;
			$cad.='<tr><td>'.$serv->servicio->nombreServicio.'</td><td>'.$detalle.'</td><td>'.number_format($iva,2).'</td><td>'.number_format($importe/1.21,2).'</td><td>'.number_format($importe,2).'</td></tr>';
			$neto+=($importe/1.21);
			$total+=$importe;
			$ivaSum+=$iva;
		}
		$cad.="<tr></tr><tr></tr><tr></tr>";
		$cad.='<tr><th></th><th></th><th>'.number_format($ivaSum,2).'</th><th>'.number_format($neto,2).'</th><th>$'.number_format($total,2).'</th></tr>';
		$cad.='</table>';
		$cad.="<br><br><br><br>";
		$cad.='<div style="float:right">SUB-TOTAL $'.number_format($neto,2).'</div><br>';
		$cad.='<big><big><div style="float:right">TOTAL $'.number_format($total,2).'</div></big></big>';
		return $cad;
	}
	public function getLinkEdita()
	{
		if(isset($this->cliente))
			return "index.php?r=transacciones/update&id=".$this->id;
		return "index.php?r=transacciones/updateProveedor&id=".$this->id;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cliente' => array(self::HAS_ONE, 'TransaccionesClientes', 'idTransaccion'),
			'reservaTransaccion' => array(self::HAS_ONE, 'ReservasTransacciones', 'idTransaccion'),
			'proveedor' => array(self::HAS_ONE, 'TransaccionesProveedores', 'idTransaccion'),
			'tipoComprobante' => array(self::BELONGS_TO, 'TransaccionesTipos', 'idTipoComprobante'),
			'prov' => array(self::HAS_ONE, 'Proveedores', array('idProveedor'=>'id'),'through'=>'proveedor'),
			'cli' => array(self::HAS_ONE, 'Clientes', array('idCliente'=>'id'),'through'=>'cliente'),
			
		);
	}

	public function beforeSave() 
	{
		$t=TransaccionesTipos::model()->findByPk($this->idTipoComprobante);
		if($this->isNewRecord)$t->aumentaProximo();
		return parent::beforeSave();
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'importe' => 'Importe',
			'detalle' => 'Detalle',
			'idTipoComprobante' => 'Tipo Comprobante',
			'color' => 'Color',
		);
	}

	public function ultimaFactura($condIva)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('idTipoComprobante',$condIva->idTransaccionTipo,false);
		$criteria->limit=1;
		$criteria->order='t.id desc';
		$res=self::model()->findAll($criteria);
		if(count($res)>0)return $res[0];
		return null;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with=array('prov','cli');
		if($this->fechaInicio!='')
			$criteria->addBetweenCondition('fecha',$this->fechaInicio,$this->fechaFin);
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->compare('prov.nombreProveedor',$this->buscar,true,'OR');
		$criteria->compare('cli.nombres',$this->buscar,true,'OR');
		$criteria->order='t.id desc';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}