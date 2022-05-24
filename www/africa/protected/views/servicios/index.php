<?php
$this->breadcrumbs=array(
	'Servicios',
);
$this->menu=array(
	array('label'=>'Nuevo Servicio', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Servicios</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicios-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array('header'=>'Servicio','type'=>'html','value'=>'"<b>".$data->nombreServicio."</b>"'),
		array('header'=>'Importe de Semana','type'=>'html','value'=>'Yii::app()->numberFormatter->formatCurrency($data->importe,"$")'),
		array('header'=>'Importe de Fin de Semana','type'=>'html','value'=>'Yii::app()->numberFormatter->formatCurrency($data->importe2,"$")'),
		array('header'=>'Duración (min)','type'=>'html','value'=>'($data->duracionTiempo!=0)?($data->duracionTiempo." min"):"-"'),
		array('header'=>'Servicio Padre','type'=>'html','value'=>'($data->servicio!=null)?($data->servicio->nombreServicio.""):"-"'),
		'color',
		//array('header'=>'Servicio Padre','type'=>'html','value'=>'"<b>".isset($data->servicio->nombreServicio)?$data->servicio->nombreServicio:"-"."</b>"'),
		'categoria.nombreCategoria',
		
		array(
			'htmlOptions'=>array('style'=>'width:90px'),
			'class'=>'CButtonColumn','template' => '{tareas} {peloteros} {update} {delete}',
			'buttons'  => array(
				'tareas' => array(
                
                'label'=>'Tareas por defecto',
                'imageUrl'=>'images/iconos/famfam/note.png',
                'url' => '"index.php?r=tareasServicios/index&idServicio=".$data->id',

            ),
            'peloteros' => array(
                
                'label'=>'Peloteros asignados en el servicio',
                'imageUrl'=>'images/iconos/famfam/shading.png',
                'url' => '"index.php?r=serviciosPeloteros/index&idServicio=".$data->id',

            ),
            'update' => array(
                'visible'=>'Yii::app()->user->checkAccess("asociados.update")'

            ),
            'delete' => array(
                'visible'=>'Yii::app()->user->checkAccess("asociados.delete")'

            ),
         ),
		),
	),
)); ?>
