<h3>IMPRESIONES DEL SISTEMA</h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'settings-grid',
	'dataProvider'=>Settings::model()->consultarImpresionesSistema(),

	'columns'=>array(
	array(
			'class'=>'CButtonColumn',
			'template' => '{update} {delete}',
			
		),
	
                'descripcion'
                ),
		

)); ?>