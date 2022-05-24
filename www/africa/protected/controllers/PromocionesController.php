<?php

class PromocionesController extends RController
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Promociones;
		$model->servicios=isset($_POST['servicios'])?$_POST['servicios']:'';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Promociones']))
		{
			$model->attributes=$_POST['Promociones'];
			$model->servicios=isset($_POST['servicios'])?$_POST['servicios']:'';
			if($model->save()){
				$this->cargarServicios($model);
			}
				$this->redirect(array('index','id'=>$model->id));
		}
		

		$this->render('create',array(
			'model'=>$model,
		));
	}
	private function cargarServicios($model)
	{
		$servicios=$model->servicios;
		foreach($servicios as $idServicio){
			$mod=new PromocionesServicios;
			$mod->idServicio=$idServicio;
			$mod->idPromocion=$model->id;
			$mod->save();
		}
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
		$model->servicios=$this->getServicios($model->id);
		if(isset($_POST['Promociones']))
		{
			$model->attributes=$_POST['Promociones'];
			if($model->save()){
				$this->cargaNuevos($model);
				$this->redirect(array('index','id'=>$model->id));
			}
				
		}
		
		
		$this->render('update',array(
			'model'=>$model,
		));
	}
	private function cargaNuevos($model)
	{
		$modelServicios=new PromocionesServicios;
		$modelServicios->idPromocion=$model->id;

		$servicios=$modelServicios->search();
		$arr=array();
		foreach($servicios->data as $serv)$arr[]=$serv->delete();
		foreach($model->servicios as $serv){
			$mod=new PromocionesServicios;
			$mod->idServicio=$serv;
			$mod->idPromocion=$model->id;
			$mod->save();
		}
		return $arr;
	}
	private function getServicios($id)
	{
		if(isset($_POST['servicios'])) return $_POST['servicios'];
		$model=new PromocionesServicios;
		$model->idPromocion=$id;

		$servicios=$model->search();
		$arr=array();
		foreach($servicios->data as $serv)$arr[]=$serv->idServicio;
		return $arr;
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
		$model=new Promociones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promociones']))
			$model->attributes=$_GET['Promociones'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Promociones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promociones']))
			$model->attributes=$_GET['Promociones'];

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
		$model=Promociones::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='promociones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
