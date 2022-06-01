<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(               // related city displayed as a link
            'label'=>'Fecha',
            'type'=>'html',
            'value'=>date("d/m/Y",strtotime($model->fecha)),
        ),
		array(               // related city displayed as a link
            'label'=>'Cliente',
            'type'=>'html',
            'value'=>$model->cliente->nombres
        ),
		array(               // related city displayed as a link
            'label'=>'Tipo Comprobante',
            'type'=>'html',
            'value'=>$model->getNombreTipoComprobante()
        ),
		array(               // related city displayed as a link
            'label'=>'Tipo DOC',
            'value'=>$model->getNombreTipoDocumentos()
        ),
		array(               // related city displayed as a link
            'label'=>'Nro. DOC',
            'value'=>$model->doc
        ),
		'detalle',
		array(               // related city displayed as a link
            'label'=>'Importe',
            'type'=>'html',
            'value'=>"<b>".number_format($model->importe,2)."</b>",
        ),
		array(               // related city displayed as a link
            'label'=>'Estado',
            'type'=>'html',
            'value'=>"<b>".$model->estado."</b>",
        ),
	),
)); ?>
