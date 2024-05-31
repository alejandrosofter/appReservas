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
	 public $TIPOCOMP_DEFAULT=6;
	public $TIPODOC_DEFAULT=96;
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
	public function getNombreCliente()
	{
		$modeloCliente=Clientes::model()->findByPk($this->idCliente);
		return $modeloCliente->nombres;
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
	public function getComprobante($nroCoprobante)
	{
		return FacturasElectronicas::model()->findByAttributes(array('nroComprobante'=>$nroCoprobante));

	}
	public function getnombreFactura(){
		return $this->nombreTipoComprobante." ".($this->esExcento?"(exento)":"")." ".str_pad($this->nroComprobante,4,"0",STR_PAD_LEFT);
	}
	public function getComprobanteAsociado()
	{
		if($this->comprobanteAsociado!==null || $this->comprobanteAsociado!=='0' )
		{
			$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
			$comprobante=FacturasElectronicas::model()->findByPk($this->comprobanteAsociado);
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
					else return null;							
		}
		return null;
	}
public function getData($importeTotal,$calculaIva)
{
	$pv=$this->getPuntoVenta();
	$importeNeto=$calculaIva?$importeTotal/1.21:$importeTotal;
	$importeIva=$calculaIva?$importeTotal-$importeNeto:0;
	$arrIva=$calculaIva?array(
		'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles) 
		'BaseImp' 	=>$this->formatImporte($importeNeto), // Base imponible
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
		'ImpNeto' 	=> $this->esExcento?0:$this->formatImporte($importeNeto), // Importe neto gravado
		'ImpOpEx' 	=> $this->esExcento?$this->formatImporte($importeTotal):0,   // Importe exento de IVA
		'ImpIVA' 	=> $this->esExcento?0: $this->formatImporte($importeIva),  //Importe total de IVA
		'ImpTrib' 	=> 0,   //Importe total de tributos
		'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
		'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
		'Iva' 		=> $this->esExcento?null: array( // (Opcional) Alícuotas asociadas al comprobante
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
	try{
		$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetVoucherTypes();
	}catch(Exception $e){
		return array();
	}
}
public function getNombreTipoComprobante($tipos=null)
{
	$afip=$this::model()->getAfip();
	$tipos= $tipos?$tipos: $afip->ElectronicBilling->GetVoucherTypes();
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
public function getLinkQr()
{
	$cuit=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT');
	$data=array(
		"ver"=>1,
		"fecha"=>$this->fecha,
		"cuit"=>(int)$cuit,
		"ptoVta"=>(int)$this->getNroPuntoVenta(),
		"tipoCmp"=>(int)$this->idTipoComprobante,
		"nroCmp"=>(int)$this->nroComprobante,
		"importe"=>(float) $this->importe,
		"moneda"=>"PES",
		"ctz"=>(float) 1,
		"tipoDocRec"=>(int)$this->tipoDoc,
		"nroDocRec"=>(int)$this->doc,
		"tipoDocAut"=>"A",
		"codAut"=>(int)$this->nroCae

	);
	$json=json_encode($data);
	$base64=base64_encode($json);
	return "https://serviciosweb.afip.gob.ar/genericos/comprobantes/cae.aspx?p=".$base64;
	// $afip=$this::model()->getAfip();
	// return $afip->ElectronicBilling->GetQrCode($this->idTipoComprobante,$this->getNroPuntoVenta(),$this->getProximoNro($this->getNroPuntoVenta(),$this->idTipoComprobante));
}
private function formatImporte($importe){
	return number_format($importe,2,".","");
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
	try{
		$afip=$this::model()->getAfip();
	return $afip->ElectronicBilling->GetLastVoucher($puntoVenta,$idTipoComprobante)+1;
	}catch(Exception $e){
		return 1;
	}
}
public function getTipoDocumentos()
{
	try{
		$afip=$this::model()->getAfip();
		return $afip->ElectronicBilling->GetDocumentTypes();
	}	catch(Exception $e){
		return array();
	}
	
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
			array('fecha, detalle,esExcento, importe, estado, idTipoComprobante, doc, tipoDoc, idCliente', 'required'),
			array('nroCae, idTransaccion,nroComprobanteNotaCredito, idTipoComprobante, tipoDoc, idCliente', 'numerical', 'integerOnly'=>true),
			array('detalle,detalleError,comprobanteAsociado, fechaVto,nroComprobante', 'length', 'max'=>255),
			array('importe', 'length', 'max'=>10),
			array('estado, doc', 'length', 'max'=>50),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buscar,id,esExcento, fecha, detalle, importe,nroComprobanteNotaCredito, nroComprobante,fechaVto,detalleError, nroCae, estado, idTransaccion, idTipoComprobante, doc, tipoDoc, idCliente', 'safe', 'on'=>'search'),
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
			'esExcento'=>"Es excento",
			"comprobanteAsociado"=>"Comprobante Asociado (notas de credito)",
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

		$criteria->compare('cliente.nombres',$this->buscar,'OR');
		// $criteria->compare('t.nroComprobante',$this->buscar,'OR');
		$criteria->with=array('cliente');
		$criteria->order="t.id DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}