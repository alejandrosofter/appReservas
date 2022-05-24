<div class='row'>
<div class='span8'>
<?=$this->renderPartial('/reservas/calendario');?>
</div>
<div class='span3'>
<h3>Próximos  </h3>
<div class="tabbable" style="margin-bottom: 18px;">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Eventos</a></li>
                <li class=""><a href="#tab2" data-toggle="tab">Comidas</a></li>
                <li class=""><a href="#tab3" data-toggle="tab">Tareas</a></li>
              </ul>
              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                <div class="tab-pane active" id="tab1">
                  <?=$this->renderPartial('/reservas/proximos')?>
                </div>
                <div class="tab-pane" id="tab2">
                  <?=$this->renderPartial('/reservas/proximosGastro')?>
                </div>
                <div class="tab-pane" id="tab3">
                  <?=$this->renderPartial('/tareas/proximos')?>
                </div>
              </div>
            </div>

<h3></h3>
</div>

</div>
<br>
</body>