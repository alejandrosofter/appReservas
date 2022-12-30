<style>
    body{
        font-family: Arial;
    }
 th, td {
  border: 1px solid black;
  font-size:12px;
  padding-left: 10px;
}
</style>
<?php
//loop con formas de pago
$formasPago=FormasDePago::model()->findAll();
foreach($formasPago as $formaPago)
{
    $modelTransaccion=new Transacciones;
	$modelTransaccion->fecha=$model->fecha;
    $modelTransaccion->idFormaPago=$formaPago->id;
    $items=$modelTransaccion->getTransacciones($formaPago->id);
    if(!isset($items))
        $items=array();
        $saldo=0;
    ?>
    <h3><?php echo $formaPago->nombreFormaPago; ?></h3>
    <table  >
        <tr >
        <!-- <th>
                Fecha
            </th> -->
            <th style="width:400px">
                Cliente
            </th>
            <th style="width:100px">
                Importe
            </th>
            <th style="width:100px">
                Nro Comp.
            </th>
            <th style="width:100px">
                Saldo
            </th>
            <!-- <th>
                Forma de Pago
            </th> -->
        </tr>
    
    <?php
    for($i=0;$i<count($items);$i++)
    {
        $item=$items[$i]; 
        $saldo+=$item->importe;
    ?>
    <tr>
    <!-- <td>
            <?php echo Yii::app()->dateFormatter->format("dd/MM/yyyy",$item->fecha) ?>
        </td> -->
        <td>
            <?php echo $item->cliente->cliente->nombres; ?>
        </td>
        <td>
            <?php echo Yii::app()->numberFormatter->formatCurrency($item->importe,"") ?>
        </td>
        <td>
            <?php echo ($item->nroComprobante) ?>
        </td>
        <td>
            <?php echo Yii::app()->numberFormatter->formatCurrency($saldo,"") ?>
        </td>
       
        <!-- <td>
            <?php echo $item->formaPago->nombreFormaPago; ?>
        </td> -->
    </tr>
    <?php
    }
    ?>
    </table>
    <?php
}
?>