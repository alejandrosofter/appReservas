<?php

class TransaccionesController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	public function actionNuevoPago()
	{
		$this->layout="//layouts/layoutSolo";
		// $model=$this->loadModel($_GET['id']);
		if(isset($_POST['Transacciones'])){
			$model->ingresarPago($_POST['Transacciones']);
			return;
		}
		$this->render('nuevoPago',array(
		));
	}
	public function actionGetProximo()
	{
		$tipo=TransaccionesTiposNro::model()->getProximo($_GET['idTipo']);
		$dat['data']=$tipo;
		echo CJSON::encode($dat);
	}
	public function actionGetProxNro()
	{
		$tipo=TransaccionesTiposNro::model()->getProximo($_GET['idTipo']);
		$dat['data']=$tipo;
		echo CJSON::encode($dat);
	}
	public function actionGetNroFactura()
	{
		$cliente=Clientes::model()->findByPk($_GET['idCliente']);
		$dat['data']=$cliente->condicionIva->tipoTransaccion->proximo;
		echo CJSON::encode($dat);
	}
	public function actionImprimir()
	{
		$this->layout='//layouts/layoutImpresion';
		$transaccion=Transacciones::model()->findByPk($_GET['id']);
		$separador=$transaccion->idTipoComprobante==2?'<br><br>':"<br>";
		$forma1=$this->getForma($_GET['id'], $this->agregado());
		$forma=$this->getForma($_GET['id']);
		$this->render('impresion',array('forma'=>$forma1.$separador.$forma));
	}
	private function agregado()
	{
		$cad='<small><small>Informamos a nuestros clientes que las SEÑAS EFECTUADAS REPRESENTAN EL COMPROMISO DE RESERVA Y LAS MISMAS <B>NO SE DEVUELVEN POR NINGÚN MOTIVO<B><BR>';
		$cad.="Al señar garantizamos congelar la tarifa durante los 40 días siguientes. Vencido ese plazo, la misma se actualizará.<br>";
		$cad.="EL EVENTO DEBERÁ QUEDAR SALDADO EN SU TOTALIDAD 10 DÍAS ANTES, de lo contrario se suspendrá, sin reintegro alguno<br>";
		$cad.="Tenga en cuenta que si Ud. decide cambiar la fecha reservada deberá acercarse personalmente con <b>MAS DE 30 DÍAS DE ANTICIPACIÓN</b> a la fecha original del evento.<br>";
		$cad.="De lo contrario se cobrarán los siguientes adicionales:<br>";
		$cad.="Con aviso entre <b>30 y 20 días</b> antes del evento: ADICIONAL DEL 25%<br>";
		$cad.="Con aviso entre <b>20 y 10 días</b> antes del evento: ADICIONAL DEL 50%<br>";
		$cad.="Con aviso entre <b>10 y 1 día</b> antes del evento: NO SE HACEN CAMBIOS<br></small></small>";
		$cad="<big>EL SALDO $.......................... SE MANTIENE HASTA ……/……./…….  VENCIDO ESTE PLAZO LA TARIFA SE ACTUALIZARÁ  AL VALOR VIGENTE AL MOMENTO DE CANCELAR. LA SEÑA REPRESENTA EL COMPROMISO DE RESERVA – NO SE HACEN DEVOLUCIONES POR NINGUN MOTIVO  ( COVID: SE REPROGRAMARÁ LA FECHA EN CASO DE RESTRICCIONES) SOLO ACEPTAMOS CAMBIO DE FECHA CON 30 DIAS DE ANTICIPACION</big>";
		return $cad;
	}
	private function getForma($id,$agregado=null)
	{
		Yii::import("ext.EnLetras", true);
		$transaccion=Transacciones::model()->findByPk($id);
		$let=new EnLetras();
		$rt=$transaccion->reservaTransaccion;
		$reserva=$rt->reserva;
		$cliente=$reserva->cliente;
		$forma=$transaccion->tipoComprobante->plantilla->texto;
		$params['cuit']=$cliente->cuit;
		$params['cliente']=$cliente->nombres;
		$params['direccion']=$cliente->direccion;
		$params['agregado']=$agregado==null?'':$agregado;
		$params['telefono']=$cliente->telefonoFijo.'/'.$cliente->telefonoMovil;
		$params['fecha']=date("d-m-Y", strtotime($transaccion->fecha));
		$params['detalle']=$transaccion->getServicios();
		$params['nroComprobante']=str_pad($transaccion->nroComprobante, Settings::model()->getValorSistema('PROXIMO_NROFACTURA_DIGOTOS'), "0", STR_PAD_LEFT);
		$params['pesosLetra']=$let->ValorEnLetras($transaccion->importe,'pesos');
		$params['importe']=number_format($transaccion->importe,2);
		$params['tipoEntrega']=$this->getTipoEntrega($rt->reserva);
		foreach($params as $campo=>$item)
			$forma = str_replace("%".$campo, $item,$forma);
		return $forma;
	}
	public function actionGetImpresion()
	{
		$transaccion=Transacciones::model()->findByPk($_GET['id']);
		$forma=$this->getForma($_GET['id']);
		$separador=$transaccion->idTipoComprobante==2?'<br><br>':"<br>";
		$forma1=$this->getForma($_GET['id'], $this->agregado());
		$forma=$this->getForma($_GET['id']);
		$dat['data']=$forma1.$separador.$forma;
		echo CJSON::encode($dat);
	}
	private function getTipoEntrega($reserva)
	{
		if(($reserva->importe-$reserva->pagado)==0) return 'Cancela';
		if(($reserva->importe-$reserva->pagado)>0)
			if(count($reserva->pagos)==1)return 'Seña';
		return 'Adelanto';
	}
	public function init()
	{
		$this->layout="//layouts/column1";
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
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

	public function actionCreateIngreso()
	{
		$model=new Transacciones;
		$modelCliente=new TransaccionesClientes;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Transacciones'])&&($_POST['idReservaPago']!=''))
		{
			$model->attributes=$_POST['Transacciones'];
			$modelCliente->attributes=$_POST['TransaccionesClientes'];

			if($model->save()){
				$modelCliente->idTransaccion=$model->id;
				$modelCliente->save();
				if(isset($_POST['idReservaPago']))
					if($_POST['idReservaPago']!='')$this->agregaReservaPago($_POST['idReservaPago'],$model->id);
				if($model->tipoComprobante->esElectronica) $this->redirect(array('/facturasElectronicas/create','idTransaccionCliente'=>$modelCliente->id));
				else $this->render('imprimirTransaccion',array(
			'model'=>$model,'modelCliente'=>$modelCliente
		));
				return;
			}
				
		}
		$model->idTipoComprobante=2;
		$model->fecha=Date('Y-m-d');
		$this->render('create',array(
			'model'=>$model,'modelCliente'=>$modelCliente
		));
	}
	private function agregaReservaPago($idReserva,$idTransaccion)
	{
		$mod=new ReservasTransacciones;
		$mod->idReserva=$idReserva;
		$mod->idTransaccion=$idTransaccion;
		$mod->save();
	}
	public function actionCreateEgreso()
	{
		$model=new Transacciones;
		$modelProveedor=new TransaccionesProveedores;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Transacciones']))
		{
			$model->attributes=$_POST['Transacciones'];
			$modelProveedor->attributes=$_POST['TransaccionesProveedores'];
			if($model->save()){
				$modelProveedor->idTransaccion=$model->id;
				$modelProveedor->save();
				$this->redirect(array('index','id'=>$model->id));

			}
				
		}
		$model->fecha=Date('Y-m-d');
		$this->render('createEgreso',array(
			'model'=>$model,'modelProveedor'=>$modelProveedor
		));
	}

	public function actionUpdateProveedor($id)
	{
		$model=$this->loadModel($id);
		$modelProveedor=$model->proveedor;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Transacciones']))
		{
			$model->attributes=$_POST['Transacciones'];
			$modelCliente->attributes=$_POST['TransaccionesProveedores'];
			if($model->save()){
				$modelProveedor->save();
				$this->redirect(array('index','id'=>$model->id));

			}
		}

		$this->render('updateProveedores',array(
			'model'=>$model,'modelProveedor'=>$modelProveedor
		));
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelCliente=$model->cliente;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Transacciones']))
		{
			$model->attributes=$_POST['Transacciones'];
			$modelCliente->attributes=$_POST['TransaccionesClientes'];
			if($model->save()){
				$modelCliente->save();
				//$this->redirect(array('index','id'=>$model->id));

			}
		}

		$this->render('update',array(
			'model'=>$model,'modelCliente'=>$modelCliente
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
		$model=new Transacciones('search');
		if(isset($_GET['Transacciones']))
			$model->attributes=$_GET['Transacciones'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Transacciones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transacciones']))
			$model->attributes=$_GET['Transacciones'];

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
		$model=Transacciones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='transacciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
