<?php

class FacturasElectronicasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			// 'accessControl', // perform access control for CRUD operations
		);
	}
	private function escribeArchivo($file,$data){
		$fp = fopen($file, 'w');
		fwrite($fp, $data);
		fclose($fp);
	}
	public function actionescribirCertificados(){
		$pk=Settings::model()->getValorSistema('FACTURAELECTRONICA_PK');
		$cert=Settings::model()->getValorSistema('FACTURAELECTRONICA_CERT');
		$csr=Settings::model()->getValorSistema('FACTURAELECTRONICA_CSR');
		$path=Yii::getPathOfAlias('webroot').'/afip.php-master/src/Afip_res/';
		$filePk=$path.'key';
		$fileCert=$path.'cert';
		$fileCsr=$path.'csr';
		$this->escribeArchivo($filePk,$pk);
		$this->escribeArchivo($fileCert,$cert);
		$this->escribeArchivo($fileCsr,$csr);
		echo CJSON::encode(array('msg'=>'Certificados escritos correctamente!'));
	}
	public function actionImprimir($id)
	{
		$this->layout="//layouts/printFactura";
		$model=$this->loadModel($id);
		$fechaVtoPago=FacturasElectronicas::model()->formatearFecha2($model->fecha,1,"d-m-Y");
		$fechaEmision=date("d/m/Y",strtotime($model->fecha));
		$nroComprobante=str_pad($model->nroComprobante,8,"0", STR_PAD_LEFT);
		$fechaDesde=date("d/m/Y",strtotime($model->fecha));
		$fechaHasta=date("d/m/Y",strtotime($model->fecha));
		$nombreCliente=$model->cliente->nombres;
		$nroDocCliente=$model->cliente->cuit;
		$tipoDocCliente="CUIT";
		$condicionIva=$model->cliente->condicionIva->nombreCondicionIva;
		$domicilio=$model->cliente->direccion;
		$importeTotal=number_format($model->importe,2);
		$importeSubTotal=number_format($model->importe,2);
		$importeIva=number_format($model->importe*0.21,2);
		$nroCae=$model->nroCae;
		$vtoCae=$model->fechaVto;
		$letraComprobante=str_replace("Factura","",$model->getNombreTipoComprobante());
		$letraComprobante=str_replace("Nota de Crédito","",$letraComprobante);
		$codigoComprobante=str_pad($model->idTipoComprobante,3,"0", STR_PAD_LEFT);
		$cantidad=1;
		$subTotal=number_format($model->importe*$cantidad,2);
		$item=array('cantidad'=>$cantidad,'unidadMedida'=>'unidad','detalle'=>$model->detalle,'importeUnidad'=>$importeTotal,'subTotal'=>$subTotal);
		$items=array($item);
		$this->render('factura',array(
			'model'=>$this->loadModel($id),'fechaVtoPago'=>$fechaVtoPago,"fechaEmision"=>$fechaEmision,
			'nroComprobante'=>$nroComprobante,'fechaDesde'=>$fechaDesde,'fechaHasta'=>$fechaHasta,
			'nombreCliente'=>$nombreCliente,'nroDocCliente'=>$nroDocCliente,"tipoDocCliente"=>$tipoDocCliente,
			'condicionIva'=>$condicionIva,"domicilio"=>$domicilio,'importeTotal'=>$importeTotal,
			'importeSubTotal'=>$importeSubTotal,'nroCae'=>$nroCae,'vtoCae'=>$vtoCae,
			"letraComprobante"=>$letraComprobante,"codigoComprobante"=>$codigoComprobante,
			"tipoComprobante"=>mb_strtoupper($model->getNombreTipoComprobante(), 'UTF-8'),
			"importeIva"=>$importeIva,
			"puntoVenta"=>$model->getNroPuntoVenta(),"items"=>$items,"linkQr"=>$model->getLinkQr()
		));
	}
	//ALTER TABLE `facturasElectronicas` CHANGE `nroCae` `nroCae` VARCHAR(100) NOT NULL;
	public function actionTest()
	{
		$nroComp=isset($_GET['nroComp'])?$_GET['nroComp']:1;
		
		$pv=FacturasElectronicas::model()->infoComprobante($nroComp,4,6);

		print_r($pv);
	}
	public function actionCheckServer()
	{
		try{
			$data=FacturasElectronicas::model()->getEstadoServidor();
			echo CJSON::encode($data);
		}
		catch(Exception $e){
			throw new CHttpException(500,$e->getMessage());
		}
		
		
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEnviarAfip($id){
		$model=$this->loadModel($id);
		try{
			$data=$model->getData($model->importe,true);
			$comprobante=$model->crearComprobante($data);
			$model->estado='COMPLETADO';
			$model->nroCae=$comprobante['CAE'];
			$model->fechaVto=$comprobante['CAEFchVto'];
			$model->nroComprobante=$comprobante['voucher_number'];
			$model->detalleError="ok";
			$model->save();
			$model->actualizarCliente();
			// $this->redirect(array('imprimir','id'=>$model->id));
		}catch(Exception $e){
			throw new CHttpException(500,$e->getMessage());
		// 	echo "ERROR: ";
		// 	echo $e->getMessage();
		// 	print_r($data);
		// 	switch($e->getCode()){
		// 		case "10177":{
		// 			$model->estado='ERROR';
		// 			$model->detalleError=$e->getMessage();
		// 			$model->save();
		// 			// $this->redirect(array('view','id'=>$model->id));
		// 			echo "Este Cliente no esta registrado con impuesto IVA. Debe ser del tipo B.";
		// 			break;
		// 		}
		// 	}
		}
	}
	public function actionsendComprobanteAfip($id)
	{
		$model=$this->loadModel($id);
		$this->render('sendAfip',array(
			'model'=>$model,"_view"=>$this->renderPartial("view",array("model"=>$model),true)
		));
		
		
	}
	public function actionCreate()
	{
		$model=new FacturasElectronicas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->fecha=date("Y-m-d");
		$model->estado="PENDIENTE"	;
		if(isset($_GET['idTransaccionCliente'])){
			$modeloTransaccion=TransaccionesClientes::model()->findByPk($_GET['idTransaccionCliente']);
			$model->idTransaccion=$modeloTransaccion->idTransaccion;
			$model->idCliente=$modeloTransaccion->idCliente;
			$model->importe=$modeloTransaccion->transaccionCli->importeFacturado;
			$model->detalle=$modeloTransaccion->transaccionCli->reservaTransaccion->reserva->getDetalleServicios(false);
			$model->doc=$modeloTransaccion->cliente->cuit;
			$model->tipoDoc=$modeloTransaccion->cliente->tipoDoc;
			$model->idTipoComprobante=$modeloTransaccion->cliente->idTipoComprobante;

		}else{
			$model->idTipoComprobante=6;//FACTURA B
			$model->tipoDoc=96; //DNI
		}
		if(isset($_POST['FacturasElectronicas']))
		{
			$model->attributes=$_POST['FacturasElectronicas'];
			if($model->save()){
				$model->actualizarCliente();
				$this->redirect(array('sendComprobanteAfip','id'=>$model->id));
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacturasElectronicas']))
		{
			$model->attributes=$_POST['FacturasElectronicas'];
			if($model->save())
				if(isset($_GET['andSend'])) $this->redirect(array('sendComprobanteAfip','id'=>$model->id));
				else $this->redirect(array('index','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new FacturasElectronicas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasElectronicas']))
			$model->attributes=$_GET['FacturasElectronicas'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacturasElectronicas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacturasElectronicas']))
			$model->attributes=$_GET['FacturasElectronicas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=FacturasElectronicas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='facturas-electronicas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
