<?php $dataChart=array();
$categorias=array('ENE','FEB',"MAR",'ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');

 $totFacturas=0;
 foreach($anualFacturas as $item){
     $fact[]=$item+0;
     $totFacturas+=$item;
 }
$totReservas=0;
 foreach($anualReservas as $item){
     $reserv[]=$item+0;
     $totReservas+=$item;
 }
$totCobros=0;
 foreach($anualCobros as $item){
    $totCobros+=$item;
     $cobros[]=$item+0;
 }
 $totGastro=0;
 foreach($anualGastro as $item){
    $totGastro+=$item;
     $gastro[]=$item+0;
 }
   $gastronomia=array('name'=> 'GASTRO <b>$ '.number_format($totGastro,2).'</b>','data'=>$gastro);
  $facturacion=array('name'=> 'FACTURACION <b>$ '.number_format($totFacturas,2).'</b>','data'=>$fact);
  $cobros=array('name'=> 'COBROS <b>$ '.number_format($totCobros,2).'</b>','data'=>$cobros);
  $reservas=array('name'=> 'RESERVAS <b>$ '.number_format($totReservas,2).'</b>','data'=>$reserv);
$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
        'chart'=>array(
            'type'=> 'column',
        ),
        'title'=>array(
            'text'=> 'HISTORIAL ANUAL '
        ),
         'tooltip'=>array(
                'formatter'=>'js:function() { return "<b>Total</b> "+number_format(this.point.y,2)  }'
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
        'series'=>array($facturacion,$cobros,$reservas, $gastronomia)
        )));
?>