<?php

class EstadisticasController extends RController
{
	public $layout='//layouts/main';
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
	public function accessRules()
	{
		return array(
		);
	}
	public function actionIndex()
	{
		$this->render('index',array(
			
		));
	}
	public function actionMensual()
	{
		$mes=isset($_POST['mes'])?$_POST['mes']:Date('m');
		$ano=isset($_POST['ano'])?$_POST['ano']:Date('Y');
		$dias=cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
		$mensualCobros=TransaccionesClientes::model()->diario($mes,$ano,array(),'importe');
		$mensualFacturas=TransaccionesClientes::model()->diario($mes,$ano,array(1,3),'importeFacturado');
		$mensualReservas=ReservasServicios::model()->diario($ano,$mes);
		$anualGastro=ReservasServicios::model()->diario($ano,$mes,2);
		$datosServicio=Servicios::model()->estadistica($ano,'idServicio',$mes);
		$datosDia=ReservasServicios::model()->estadistica($ano,'dia',$mes);
		$this->render('mensual',array(
			'anualGastro'=>$anualGastro,'cantidadDias'=>$dias,'mensualReservas'=>$mensualReservas,'mensualCobros'=>$mensualCobros,'mensualFacturas'=>$mensualFacturas,'datosServicio'=>$datosServicio,'datosDia'=>$datosDia
		));
	}
	public function actionGeneral()
	{
		$ano=isset($_POST['ano'])?$_POST['ano']:Date('Y');
		$datosServicio=Servicios::model()->estadistica($ano,'idServicio');
		$datosDia=ReservasServicios::model()->estadistica($ano,'dia');
		$anualCobros=TransaccionesClientes::model()->anual($ano,array());
		$anualReservas=ReservasServicios::model()->anual($ano);
		$anualGastro=ReservasServicios::model()->anual($ano,2);
		$anualFacturas=TransaccionesClientes::model()->anualFacturacion($ano,array(1,3));
		$this->render('generales',array(
			'anualGastro'=>$anualGastro,'datosServicio'=>$datosServicio,'datosDia'=>$datosDia,'anualReservas'=>$anualReservas,'anualCobros'=>$anualCobros,'anualFacturas'=>$anualFacturas
		));
	}

}
?>