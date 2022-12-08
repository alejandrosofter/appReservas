<table>
    <tr>
    <!-- <th>
            Fecha
        </th> -->
        <th>
            Cliente
        </th>
        <th>
            Importe
        </th>
        <th>
            Saldo
        </th>
        <!-- <th>
            Forma de Pago
        </th> -->
    </tr>

<?php
$items=$model->getTransacciones();
if(!isset($items))
    $items=array();
    $saldo=0;
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