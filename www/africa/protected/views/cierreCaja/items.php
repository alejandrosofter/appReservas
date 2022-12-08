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
            Saldo
        </th>
        <!-- <th>
            Forma de Pago
        </th> -->
    </tr>

<?php
$items=$model->items;
if(!isset($items))
    $items=array();
    $saldo=0;
for($i=0;$i<count($items);$i++)
{
    $item=$items[$i]->transaccion; 
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