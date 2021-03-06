<?php
$this->breadcrumbs = array(
    'Configuraciónes' => array(''),
);

?>

<h1>Variables de <span class="bolder colored">Sistema</span></h1>
A traves de esta interfaz ud. podrá modificar valores del sistema que alteran su funcionamiento en distintas áreas:
<br><br>
<div class='form'>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'settings-form',
    'enableAjaxValidation' => false,
        ));
//$this->widget('ext.bootstrap.widgets.BootAlert', array(
//    'id' => 'alert',
//    'keys' => array('success', 'info', 'warning', 'error'),
//));
?>
<div class="tabbable tabs-left">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#lA" data-toggle="tab">Datos de Empresa</a></li>
                <li class=""><a href="#lE" data-toggle="tab">Datos de Comprobantes</a></li>
                <li class=""><a href="#lB" data-toggle="tab">Plantilla</a></li>
                <li class=""><a href="#lC" data-toggle="tab">Datos de Horarios</a></li>
                <li class=""><a href="#lD" data-toggle="tab">Datos de Email</a></li>
                <li class=""><a href="#lF" data-toggle="tab">Autorizaciones</a></li>
                <li class=""><a href="#facturaElectronica" data-toggle="tab">Factura Electronica</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="lA">
                  <?=$this->renderPartial('_variablesDatosEmpresa', array(), true)?>
                </div>
                <div class="tab-pane" id="lB">
                  <b><?php echo 'Plantilla de las Impresiones' ?></b>
<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
	"value"=>Settings::model()->getValorSistema('PLANTILLA_BASE'),
    "name"=>'PLANTILLA_BASE',         # Attribute in the Data-Model
 
    "width"=>'100%',
   // "toolbarSet"=>'Full',          # EXISTING(!) Toolbar (see: fckeditor.js)
    "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                    # Path to fckeditor.php
    "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                    # Realtive Path to the Editor (from Web-Root)
    
                                    # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                                    # Additional Parameter (Can't configure a Toolbar dynamicly)
    ) ); ?>
                </div>
                <div class="tab-pane" id="lC">
                   <?=$this->renderPartial('_variablesHorarios', array(), true)?>
                </div>
                <div class="tab-pane" id="lE">
                   <?=$this->renderPartial('_variablesComprobantes', array(), true)?>
                </div>
                <div class="tab-pane" id="lD">
                   <?=$this->renderPartial('_variablesEmail', array(), true)?>
                </div>
                <div class="tab-pane" id="lF">
                   <?=$this->renderPartial('_autoriza', array(), true)?>
                </div>
                <div class="tab-pane" id="facturaElectronica">
                   <?=$this->renderPartial('_facturaElectronica', array(), true)?>
                </div>
              </div>
            </div>





    <div class="actions">
<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>