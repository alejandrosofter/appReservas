<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/styleFactura.css">
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/print.js', CClientScript::POS_HEAD); ?>

</head>
<body>
<?=$content?>
</body>
</html>
