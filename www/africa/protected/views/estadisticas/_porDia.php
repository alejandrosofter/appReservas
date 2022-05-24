<?php

 $dataChart=array();
 foreach($data as $item){
 	$num=($item->costo+0);
   
 	 $dataChart[]=array('name'=> Reservas::model()->getDia2($item->dia),'y'=>$num,'x'=>$item->cantidad);
 }
 
$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
        'chart'=>array(
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
        ),
        'title'=>array(
            'text'=> 'Por Día'
        ),
        'tooltip'=>array(
             'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+number_format(this.percentage,2)+"%"+ 
             "<br>Con un TOTAL $" +number_format(this.y)+
             "<br>"+this.point.x+ " reserva/s"}'
        ),
        'plotOptions'=>array(
            'pie'=> array(
                'allowPointSelect'=>true,
                'cursor'=>'pointer',
                'dataLabels'=>array('enabled'=>true),
                'showInLegend'=>true
            )
        ),
        'series'=>array(
                array(
                    'type'=> 'pie',
                    'name'=>'Browser share',
                    'data'=>$dataChart
                ),
            )
        )));
?>
