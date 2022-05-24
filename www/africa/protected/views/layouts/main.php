<!DOCTYPE html>
<html>
    <head>
  <link rel="stylesheet" type="text/css" href="js/">
    <link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/printable.js"></script>
    <!-- Add fancyBox -->
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

<!-- CONTEXT -->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/src/jquery.ui.position.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/src/jquery.contextMenu.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/prettify/prettify.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/screen.js', CClientScript::POS_HEAD); ?>

    <link href="js/contextMenu//src/jquery.contextMenu.css" rel="stylesheet" type="text/css" />

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/webcam/jquery.webcam.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.3', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/print.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timeago.js', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/block.js', CClientScript::POS_HEAD); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
    <script>
function number_format (number, decimals, dec_point, thousands_sep) {
// Formats a number with grouped thousands
//
// version: 906.1806
// discuss at: http://phpjs.org/functions/number_format
// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
// +     bugfix by: Michael White (http://getsprink.com)
// +     bugfix by: Benjamin Lupton
// +     bugfix by: Allan Jensen (http://www.winternet.no)
// +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
// +     bugfix by: Howard Yeend
// +    revised by: Luke Smith (http://lucassmith.name)
// +     bugfix by: Diogo Resende
// +     bugfix by: Rival
// +     input by: Kheang Hok Chin (http://www.distantia.ca/)
// +     improved by: davook
// +     improved by: Brett Zamir (http://brett-zamir.me)
// +     input by: Jay Klehr
// +     improved by: Brett Zamir (http://brett-zamir.me)
// +     input by: Amir Habibi (http://www.residence-mixte.com/)
// +     bugfix by: Brett Zamir (http://brett-zamir.me)
// *     example 1: number_format(1234.56);
// *     returns 1: '1,235'
// *     example 2: number_format(1234.56, 2, ',', ' ');
// *     returns 2: '1 234,56'
// *     example 3: number_format(1234.5678, 2, '.', '');
// *     returns 3: '1234.57'
// *     example 4: number_format(67, 2, ',', '.');
// *     returns 4: '67,00'
// *     example 5: number_format(1000);
// *     returns 5: '1,000'
// *     example 6: number_format(67.311, 2);
// *     returns 6: '67.31'
// *     example 7: number_format(1000.55, 1);
// *     returns 7: '1,000.6'
// *     example 8: number_format(67000, 5, ',', '.');
// *     returns 8: '67.000,00000'
// *     example 9: number_format(0.9, 0);
// *     returns 9: '1'
// *     example 10: number_format('1.20', 2);
// *     returns 10: '1.20'
// *     example 11: number_format('1.20', 4);
// *     returns 11: '1.2000'
// *     example 12: number_format('1.2000', 3);
// *     returns 12: '1.200'
var n = number, prec = decimals;

var toFixedFix = function (n,prec) {
    var k = Math.pow(10,prec);
    return (Math.round(n*k)/k).toString();
};

n = !isFinite(+n) ? 0 : +n;
prec = !isFinite(+prec) ? 0 : Math.abs(prec);
var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

var abs = toFixedFix(Math.abs(n), prec);
var _, i;

if (abs >= 1000) {
    _ = abs.split(/\D/);
    i = _[0].length % 3 || 3;

    _[0] = s.slice(0,i + (n < 0)) +
          _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
    s = _.join(dec);
} else {
    s = s.replace('.', dec);
}

var decPos = s.indexOf(dec);
if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
    s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
}
else if (prec >= 1 && decPos === -1) {
    s += dec+new Array(prec).join(0)+'0';
}
return s; }
</script>
     <script>
 jQuery(document).ready(function() {
    jQuery.timeago.settings.allowFuture = true;
  // Spanish
jQuery.timeago.settings.strings = {
   prefixAgo: "hace",
   prefixFromNow: "dentro de",
   suffixAgo: "",
   suffixFromNow: "",
   seconds: "menos de un minuto",
   minute: "un minuto",
   minutes: "unos %d minutos",
   hour: "una hora",
   hours: "%d horas",
   day: "un día",
   days: "%d días",
   month: "un mes",
   months: "%d meses",
   year: "un año",
   years: "%d años"
};
  jQuery("abbr.timeago").timeago();
  
});
 $(".imprime").fancybox({
    fitToView : false,
    width   : '500px',
    height    : '400px',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
 </script>

<div class="container">
<?php $this->widget( 'ext.EChosen.EChosen');?>
<?php if(isset(Yii::app()->user->id)) $usuario=Usuarios::model()->findByPk(Yii::app()->user->id);?>
 <?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    
    'brandUrl'=>'index.php',

    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>true,
            'items'=>array(
               
                array('label'=>'Clientes','icon'  => 'user', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Clientes', 'url'=>'index.php?r=clientes'),
                    array('label'=>'Agregar', 'url'=>'index.php?r=clientes/create'),
                )),
                array('label'=>'Proveedores','icon'  => 'user', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Proveedores', 'url'=>'index.php?r=proveedores'),
                    array('label'=>'Agregar', 'url'=>'index.php?r=proveedores/create'),
                )),
                array('label'=>'Reservas','icon'  => 'time', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Reservas', 'url'=>'index.php?r=reservas'),
                    array('label'=>'Agregar', 'url'=>'index.php?r=reservas/create'),
                    '---',
                    array('label'=>'Ver Feriados', 'url'=>'index.php?r=feriados'),
                    array('label'=>'Agregar', 'url'=>'index.php?r=feriados/create'),
                )),
                array('label'=>'Servicios','icon'  => 'wrench', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Servicios', 'url'=>'index.php?r=servicios'),
                    array('label'=>'Agregar Servicio', 'url'=>'index.php?r=servicios/create'),
                    '---',
                    array('label'=>'Ver Peloteros', 'url'=>'index.php?r=peloteros'),
                    array('label'=>'Agregar Pelotero', 'url'=>'index.php?r=peloteros/create'),
                    '---',
                    array('label'=>'Ver Promociones', 'url'=>'index.php?r=promociones'),
                    array('label'=>'Agregar Promociones', 'url'=>'index.php?r=promociones/create'),
                    '---',
                    array('label'=>'Ver Categorias', 'url'=>'index.php?r=serviciosCategorias'),
                    array('label'=>'Agregar Categoria', 'url'=>'index.php?r=serviciosCategorias/create'),
                )),
                 array('label'=>'Transacciónes','icon'  => 'star', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Transacciones', 'url'=>'index.php?r=transacciones'),
                    array('label'=>'Agregar Ingreso', 'url'=>'index.php?r=transacciones/createIngreso'),
                    array('label'=>'Agregar Egreso', 'url'=>'index.php?r=transacciones/createEgreso'),
                )),
                 array('label'=>'Estadisticas','icon'  => 'signal', 'url'=>'index.php?r=estadisticas', 'items'=>array(
                   
                    array('label'=>'Anual', 'url'=>'index.php?r=estadisticas/general'),
                    array('label'=>'Mensual', 'url'=>'index.php?r=estadisticas/mensual'),
                )),
                 array('label'=>'Configuraciónes','icon'  => 'asterisk', 'url'=>'#', 'items'=>array(
                    array('label'=>'Datos de Sistema', 'url'=>'index.php?r=settings/variablesSistema'),
                    array('label'=>'Envio de Mails', 'url'=>'index.php?r=mail'),
                     array('label'=>'Usuarios', 'url'=>'index.php?r=usuarios')
                )),
                 array('label'=>'','encodeLabel'=>true,'icon'  => 'arrow-down white', 'url'=>'#','activeCssClass'=>'icon-user', 'items'=>$this->menu),
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>(isset(Yii::app()->user->id))?$usuario->nombreUsuario:'','icon'  => 'user white', 'url'=>'#', 'items'=>array(
                    array('label'=>'Logout', 'icon'  => 'circle-arrow-left','url'=>'index.php?r=site/logout'),
                    array('label'=>'Mis Datos','icon'  => 'user', 'url'=>'index.php?r=usuarios/update&id='.Yii::app()->user->id),
                )),
            ),
        ),
    ),
)); ?>

		
<div class='bread'>
<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
</div>
<div class='contenedor span5'>
<?=$content?>
</div>

</div>
<footer class="footer">
      <div class="container">
        <p>Diseño y programación desarrollado por <a href="http://www.softer.com.ar" target="_blank">SOFTER</a></p>
        <p>Cualquier duda o consulta por favor contactar a <a href="mailto:alejandro@softer.com.ar">info@softer.com.ar</a></p>
       
      </div>
    </footer>
</body>
</html>