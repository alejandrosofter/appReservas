<?php
 $dataChart=array();
 foreach($data as $item){
 	$num=($item->importeTotal+0);
 	 $dataChart[]=array('name'=> $item->nombreServicio,'y'=>$item->cantidadTotal*1,'x'=>$num*1);
 }
 
$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
        'chart'=>array(
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
        ),
        'title'=>array(
            'text'=> 'Por Servicio'
        ),
        'tooltip'=>array(
             'formatter'=> 'js:function(){return "<b>"+this.point.name+"</b>: "+number_format(this.percentage,2)+"%"+ 
             "<br>Con un TOTAL $" +number_format(this.point.x)+
             "<br>"+this.point.y+ " reserva/s"}'
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