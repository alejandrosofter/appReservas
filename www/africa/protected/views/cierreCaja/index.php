<?php
$this->breadcrumbs=array(
	'Cierre Cajas',
);
$this->menu=array(
	array('label'=>'Nuevo Cierre de Caja', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Cierre Cajas</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cierre-caja-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array('header'=>'Fecha','type'=>'html','value'=>'Yii::app()->dateFormatter->format("dd/MM/yyyy",$data->fecha)'),

		array('header'=>'Importe ','type'=>'html','value'=>'Yii::app()->numberFormatter->formatCurrency($data->importe,"$")'),

		array(
			'class'=>'CButtonColumn','template'=>'{imprimir} {update} {delete}',
			'buttons'=>array(
				'imprimir' => array(
                
                'label'=>'Imprimir',
                'imageUrl'=>'images/iconos/famfam/printer.png',
                'url' => '"javascript:imprimir($data->id)"',

            ),
				
				)
		),
	),
)); ?>
<div id='imp' style='display:none'></div>
<script>

function imprimir(id)
{
	$.getJSON('index.php?r=cierreCaja/getImpresion',{"id":id}, function(data) {
$( "#imp" ).html(data.data);
$('#imp').print();

	});
}
</script>