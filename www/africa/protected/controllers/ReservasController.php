<?php

class ReservasController extends RController
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
	public function init()
	{
		$this->layout="//layouts/column1";
	}

	public function actionCambiarImporte()
	{
		$this->layout="//layouts/layoutSolo";
		$model=$this->loadModel($_GET['id']);
		if(isset($_POST['Reservas']['importe'])){
			$model->cambiarImporte($_POST['Reservas']['importe']);
			echo 'Se ha cambiado el importe!';
			return;
		}
		$this->render('cambiaImporte',array(
			'model'=>$model,
		));
	}
	public function accessRules()
	{
		return array(
		);
	}
	public function actionCheckReserva($idServicio,$fecha,$hora,$duracionTiempo,$importe)
	{
		$opciones=array();
		$arr=array('ocupado'=>false,'opciones'=>$opciones,'mensaje'=>'');
		$fechaEvento=strtotime($fecha.' '.$hora.':00');
		$fechaEventoHasta=$fechaEvento+$duracionTiempo*60;
		$servicio=Servicios::model()->findByPk($idServicio);
		if($servicio->idCategoria==1)
		if(!ReservasServicios::model()->estaDisponible($fechaEvento,$fechaEventoHasta,$idServicio)){
			$horariosRecomendar=Settings::model()->getValorSistema('DATOS_HORARIOS');
			$recomenda=$this->recomendarFechas($idServicio,$fecha,$hora,$duracionTiempo);
			$arr=array('ocupado'=>true,'opciones'=>$opciones,'data'=>$recomenda,'mensaje'=>'La fecha seleccionada esta ocupada');
		}
		
			
		echo CJSON::encode($arr);
	}
	private function recomendarFechas($idServicio,$fecha,$hora,$duracionTiempo)
	{
		$salida=array();
		$cantidad=Settings::model()->getValorSistema('DATOS_HORARIOS_CANTIDAD')+0;
		for($i=0;$i<$cantidad;$i++){
			$fechaAux=date('Y-m-d', strtotime($fecha. ' + '.($i).' days'));
			$salida=array_merge($salida,$this->recomiendaPorFecha($idServicio,$fechaAux,$hora,$duracionTiempo));
		}
		
		return $salida;
	}
	private function recomiendaPorFecha($idServicio,$fecha,$hora,$duracionTiempo)
	{
		$d=Settings::model()->getValorSistema('DATOS_HORARIOS');
		$rangos=explode(';',$d);
		$salida=array();
		foreach($rangos as $rango){
			$rango=trim($rango);
			$horarios=explode('-',$rango);
			$inicio=strtotime($fecha.' '.$horarios[0].':00');
			$fin=strtotime($fecha.' '.$horarios[1].':00');
			$duracion=($fin-$inicio)/60;
			$importe=$this->getImporteReserva($idServicio,$fecha);
			if(ReservasServicios::model()->estaDisponible($inicio,$fin,$idServicio)){
				$servicio=Servicios::model()->findByPk($idServicio);
				$salida[]=array('servicio'=>$servicio,'fecha'=>$fecha,'hora'=>$horarios[0],'horaFin'=>$horarios[1],'idServicio'=>$idServicio,'duracion'=>$duracion,'importe'=>$importe['importe']);
			}
				
		}
		return $salida;
	}
	public function actiontodas()
	{
		echo CJSON::encode(Reservas::model()->todas($_GET['ano']));
	}
	public function actionCheckImporte($idServicio,$fecha)
	{
		echo CJSON::encode($this->getImporteReserva($idServicio,$fecha));
	}
	private function getImporteReserva($idServicio,$fecha)
	{
		$servicio=Servicios::model()->findByPk($idServicio);
		$esFeriado=Feriados::model()->esFeriado($fecha);
		$i = strtotime($fecha);
		$dia= jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 );
		$esFinde=$dia==0 || $dia==6;
		if($esFeriado||$esFinde) $imp= $servicio->importe2; else $imp=$servicio->importe;

		$promocion=PromocionesServicios::model()->getPromociones($idServicio,$fecha);

		$imp=$this->aplicarDescuentos($promocion,$imp);
		$arr=array('importe'=> $imp,'dia'=>$dia,'promocion'=>$promocion);
		return $arr;
	}
	private function aplicarDescuentos($promociones,$imp)
	{
		foreach($promociones as $prom){
			$descuentaPorcentaje=$imp*($prom->promocion->porcentaje/100);
			$descuentaImporte=$prom->promocion->importe;
			$imp-=$descuentaPorcentaje;
			$imp-=$descuentaImporte;
		}
		return $imp;
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
	public function actionRipFecha()
	{
		$arr=Reservas::model()->findAll();
		foreach($arr as $item){
			$item->fecha=isset($item->pagoPrim->transaccion)?$item->pagoPrim->transaccion->fecha:"";
			$item->save();
		}
		echo 'RIPEADOS!';
	}
	public function actionCreate()
	{
		$model=new Reservas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$arr=array();
		if(isset($_GET['Reservas']))
		{
			$model->attributes=$_GET['Reservas'];
			if($model->validate() && isset($_GET['Servicios'])){
				$model->importe=$this->getImporte($_GET['Servicios']);
				$model->save();
				ReservasServicios::model()->guardar($model,$_GET['Servicios']);
				TareasReservas::model()->guardar($model,isset($_GET['Tareas'])?$_GET['Tareas']:array());
				
				$idTrans=ReservasTransacciones::model()->guardar($model,isset($_GET['Pagos'])?$_GET['Pagos']:array());
				$this->enviarMail($model);
				$arr['error']=false;
				$arr['id']=$model->id;
				$arr['idTransaccion']=$idTrans;
				echo CJSON::encode($arr);
				return;
			}else{
				$arr['error']=true;
				$arr['mensaje']='';
				if(!$model->validate()) $arr['mensaje'].='Hay campos de la reserva que no ha completado! '.$model->hasErrors();
				if(!isset($_GET['Servicios'])) $arr['mensaje'].=' Debe seleccionar por lo menos 1 servicio!';
				echo CJSON::encode($arr);
				return;
			}
			
		}
		if(isset($_GET['idCliente'])) $model->idCliente=$_GET['idCliente'];
		$model->fecha=Date('Y-m-d');
		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionGetImpagas($idCliente)
	{
		echo CJSON::encode(Reservas::model()->impagas($idCliente));
	}
	private function enviarMail($model)
	{
		$arranca=strtotime($model->comienza);
		$termina=$arranca+$model->duracion;
		$mensaje="Hola <big>".$model->cliente->nombres."</big> su reserva se ha realizado con éxito!. A continuación lo detallamos : <br>";
		$mensaje.="<b>Cumpleañero: </b>".$model->nombreCumpleano.'<br>';
		$mensaje.="<b>Comienzo del Evento: </b>".date('d-m-Y',$arranca).' a las '.date('H:i',$arranca).'<br>';
		$mensaje.="<b>Finalización: </b>".date('H:i',$termina).'<br>';
		$mensaje.="<b>Pagos: </b> $".$model->pagado.'<br>';
		$mensaje.="<b>Importe Total: </b> $".$model->importe.'<br>';
		$mensaje.="Desde ya muchas gracias por confiar en nuestros servicios, atte la Administracion de África!";
		Mail::model()->enviarMensajeBase($model->cliente->email,$mensaje,'Su reserva ha sido realizada! AFRICA',Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'));
	}

	private function getImporte($servicios)
	{
		$total=0;
		foreach($servicios as $serv)$total+=$serv['importe'];
		return $total;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel($_GET['id']);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['Reservas'])) 
		{
			$model->attributes=$_GET['Reservas'];
			if($model->validate() && isset($_GET['Servicios'])){
				$model->importe=$this->getImporte($_GET['Servicios']);
				$model->save();
				$arr=array('error'=>false,'mensaje'=>'');
				echo CJSON::encode($arr);
				ReservasServicios::model()->guardar($model,$_GET['Servicios']);
				TareasReservas::model()->guardar($model,isset($_GET['Tareas'])?$_GET['Tareas']:array());
				//ReservasTransacciones::model()->guardar($model,isset($_GET['Pagos'])?$_GET['Pagos']:array());
				return;
			}else{
				$arr=array('error'=>true,'mensaje'=>"Faltan completar datos!");
				echo CJSON::encode($arr);
				return;
			}
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
		$this->loadModel($id)->delete();
		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Reservas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reservas']))
			$model->attributes=$_GET['Reservas'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reservas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reservas']))
			$model->attributes=$_GET['Reservas'];

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
		$model=Reservas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='reservas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
