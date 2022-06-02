<?php

/**
 * This is the model class for table "facturasElectronicas".
 *
 * The followings are the available columns in table 'facturasElectronicas':
 * @property integer $id
 * @property string $fecha
 * @property string $detalle
 * @property string $importe
 * @property string $fechaVto
 * @property integer $nroCae
 * @property string $estado
 * @property integer $idTransaccion
 * @property integer $idTipoComprobante
 * @property string $doc
 * @property integer $tipoDoc
 * @property integer $idCliente
 *
 * The followings are the available model relations:
 * @property Transacciones $idTransaccion0
 */
include 'afip.php-master/src/Afip.php';
class FacturasElectronicas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturasElectronicas the static model class
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
		return 'facturasElectronicas';
	}
	public function actualizarCliente(){
		$modeloCliente=Clientes::model()->findByPk($this->idCliente);
		$modeloCliente->cuit=$this->doc;
		$modeloCliente->tipoDoc=$this->tipoDoc;
		$modeloCliente->idTipoComprobante=$this->idTipoComprobante;
		$modeloCliente->save();
	}
	private function getAfip()
	{
		$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
		return new Afip(array('CUIT' => $cuit,"production"=>true));
	}
	public function necesitaNroComprobante()
	{
		//chequeo si idTipoComprobante esta dentro del array
		if (in_array($this->idTipoComprobante, $this->getCodigosNotasCredito())) return true;
		return false;
	}
	public function getCodigosNotasCredito()
	{
		return array(3,8,13,53,203,208,213);
	}
	public function getComprobanteAsociado()
	{
		if($this->necesitaNroComprobante())
		{
			$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
			$comprobante=FacturasElectronicas::model()->findByAttributes(array('nroComprobante'=>$this->nroComprobanteNotaCredito));
			// return 
			// array("CbteAsoc"=>
			// 	array(
			// 		"Nro"=>$comprobante->nroComprobante,
			// 		"Tipo"=>$comprobante->idTipoComprobante,
			// 		"PtoVta"=>$this->getPuntoVenta(),
			// 	)
			// 	);	
			if(isset( $comprobante->idTipoComprobante))
				return  array(
					'CbteAsoc' => array('Tipo' => $comprobante->idTipoComprobante,
					'PtoVta' => $this->getNroPuntoVenta(),
					'Nro' => $comprobante->nroComprobante,
					'Cuit' => $cuit,
					'CbteFch' => intval(date('Ymd', strtotime($comprobante->fecha)))
					));		
					else throw new CHttpException(500, 'No se encontro el comprobante asociado');							
		}
		return null;
	}
public function getData($importeTotal,$calculaIva)
{
	$pv=$this->getPuntoVenta();
	$codigosNotasDeCredito=$this->getCodigosNotasCredito();
	$importeNeto=$calculaIva?$importeTotal/1.21:$importeTotal;
	$importeIva=$calculaIva?$importeTotal-$importeNeto:0;
	$arrIva=$calculaIva?array(
		'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles) 
		'BaseImp' 	=> $this->formatImporte($importeNeto), // Base imponible
		'Importe' 	=> $this->formatImporte($importeIva) // Importe 
	):array();
	return  array(
		'CbtesAsoc'=> $this->getComprobanteAsociado(),
		'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
		'PtoVta' 	=> $pv->Nro,  // Punto de venta
		'CbteTipo' 	=> $this->idTipoComprobante,  // Tipo de comprobante (ver tipos disponibles) 
		'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
		'DocTipo' 	=> $this->tipoDoc, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
		'DocNro' 	=> $this->doc,  // Número de documento del comprador (0 consumidor final)
		'CbteDesde' 	=> $this->getProximoNro($pv->Nro,$this->idTipoComprobante),  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
		'CbteHasta' 	=> $this->getProximoNro($pv->Nro,$this->idTipoComprobante),  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
		'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
		'FchServDesde'=>$this->formatearFecha2($this->fecha),
		'FchServHasta'=>$this->formatearFecha2($this->fecha),
		'FchVtoPago'=>$this->formatearFecha2($this->fecha,1),
		'ImpTotal' 	=> $this->formatImporte($importeTotal), // Importe total del comprobante
		'ImpTotConc' 	=> 0,   // Importe neto no gravado
		'ImpNeto' 	=> $this->formatImporte($importeNeto), // Importe neto gravado
		'ImpOpEx' 	=> 0,   // Importe exento de IVA
		'ImpIVA' 	=> $this->formatImporte($importeIva),  //Importe total de IVA
		'ImpTrib' 	=> 0,   //Importe total de tributos
		'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
		'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
		'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
			$arrIva
		), 
	);
}
	public function getPuntoVenta()
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetSalesPoints();
}
public function getNroPuntoVenta()
{
	$pv=$this->getPuntoVenta();
	return $pv->Nro;
}
public function getTiposComprobantes()
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetVoucherTypes();
}
public function getNombreTipoComprobante()
{
	$afip=$this::model()->getAfip();
	$tipos= $afip->ElectronicBilling->GetVoucherTypes();
	foreach($tipos as $tipo)
	{
		if($tipo->Id==$this->idTipoComprobante)
			return $tipo->Desc;
	}
	return "-";
}
public function getEstadoServidor()
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetServerStatus();
}
public function formatearFecha($fecha)
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->FormatDate($fecha);
}
public function formatearFecha2($fecha,$masDias=0,$formato="Ymd")
{
	$time = strtotime($fecha);
	if($masDias>0) $time = strtotime('+'.$masDias.' day', $time);
	return date($formato,$time);
}

private function formatImporte($importe){
	return number_format($importe,2);
}
public function getListaTributos()
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetTaxTypes();
}
public function getOpciones()
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetOptionsTypes();
}
public function getProximoNro($puntoVenta,$idTipoComprobante)
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetLastVoucher($puntoVenta,$idTipoComprobante)+1;
}
public function getTipoDocumentos()
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetDocumentTypes();
}
public function getNombreTipoDocumentos()
{
	$afip=$this::model()->getAfip();
	$tipos= $afip->ElectronicBilling->GetDocumentTypes();
	foreach($tipos as $tipo)
	{
		if($tipo->Id==$this->tipoDoc)
			return $tipo->Desc;
	}
	return "-";
}
public function crearComprobante($data)
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->CreateNextVoucher($data);
}
public function infoComprobante($nroComprobante,$ptoVenta,$tipoComprobante)
{
	$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetVoucherInfo($nroComprobante,$ptoVenta,$tipoComprobante);
}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, detalle, importe, estado, idTipoComprobante, doc, tipoDoc, idCliente', 'required'),
			array('nroCae, idTransaccion,nroComprobanteNotaCredito, idTipoComprobante, tipoDoc, idCliente', 'numerical', 'integerOnly'=>true),
			array('detalle,detalleError, fechaVto,nroComprobante', 'length', 'max'=>255),
			array('importe', 'length', 'max'=>10),
			array('estado, doc', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id, fecha, detalle, importe,nroComprobanteNotaCredito, nroComprobante,fechaVto,detalleError, nroCae, estado, idTransaccion, idTipoComprobante, doc, tipoDoc, idCliente', 'safe', 'on'=>'search'),
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
			'transaccion' => array(self::BELONGS_TO, 'Transacciones', 'idTransaccion'),
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
			'fecha' => 'Fecha',
			'detalle' => 'Detalle',
			'importe' => 'Importe',
			'fechaVto' => 'Fecha Vto',
			'nroCae' => 'Nro Cae',
			'estado' => 'Estado',
			'idTransaccion' => 'Id Transaccion',
			'idTipoComprobante' => 'Tipo Comprobante',
			'doc' => 'Nro (cuit/dni)',
			'tipoDoc' => 'Tipo Doc',
			'idCliente' => 'Cliente',
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
		$criteria->compare('fecha',$this->buscar,true,'OR');
		$criteria->compare('detalle',$this->buscar,true,'OR');
		$criteria->compare('importe',$this->buscar,true,'OR');
		$criteria->compare('fechaVto',$this->buscar,true,'OR');
		$criteria->compare('nroCae',$this->buscar,'OR');
		$criteria->compare('estado',$this->buscar,true,'OR');
		$criteria->compare('idTransaccion',$this->buscar,'OR');
		$criteria->compare('idTipoComprobante',$this->buscar,'OR');
		$criteria->compare('doc',$this->buscar,true,'OR');
		$criteria->compare('tipoDoc',$this->buscar,'OR');
		$criteria->compare('idCliente',$this->buscar,'OR');
		$criteria->order="fecha DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}