<?php $dataChart=array();
 $categorias=array();
$reserv=array();
for($i=0;$i<$cantidadDias;$i++){
    $mes=isset($_POST['mes'])?$_POST['mes']:Date('m');
    $dia=Reservas::model()->getDia(jddayofweek ( cal_to_jd(CAL_GREGORIAN, $mes,($i+1), date("Y")) , 0 ),true);
    $categorias[]=($i+1).'<br>'.$dia;
}
   

$totFacturas=0;
 foreach($mensualFacturas as $item){
    $totFacturas+=$item;
    $fact[]=$item+0;
 }
$totReservas=0;
$countReservas=0;
 foreach($mensualReservas as $item){
    $totReservas+=$item;
    $reserv[]=$item+0;
 }
$totCobros=0;
 foreach($mensualCobros as $item){
    $totCobros+=$item;
    $cobros[]=$item+0;
 }
 $totGastro=0;
 foreach($anualGastro as $item){
    $totGastro+=$item;
     $gastro[]=$item+0;
 }
 $gastronomia=array('name'=> 'GASTRO <b>$ '.number_format($totGastro,2).'</b>','data'=>$gastro);
  $facturacion=array('name'=> 'FACTURACION $ '.number_format($totFacturas,2),'data'=>$fact);
  $cobros=array('name'=> 'COBROS $ '.number_format($totCobros,2),'data'=>$cobros);
$reservas=array('name'=> 'RESERVAS $ '.number_format($totReservas,2),'data'=>$reserv);
$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
        'chart'=>array(
            'type'=> 'column',
        ),
        'title'=>array(
            'text'=> 'ESTADISTICO MENSUAL'
        ),
         'tooltip'=>array(
                'formatter'=>'js:function() { return "<b>Total</b>: $"+ number_format(this.point.y,2)  }'
                     ),
        'xAxis'=>array(
            'categories'=> $categorias,
        ),
        'yAxis'=>array(
            'title'=>array('text'=>'$ a escala')
        ),
        'plotOptions'=>array(
            'column'=> array(
                'pointPadding'=>0.2,
                'borderWidth'=>'0',
                
            )
        ),
        'series'=>array($facturacion,$cobros,$reservas,$gastronomia)
        )));
?>