<div id="panel">
<button onClick="imprimir()">Imprimir</button>
<button onClick="volver()">Volver</button>
<script>
    function volver(){
        location.href='index.php?r=facturasElectronicas'
    }
function imprimir()
{
    $("#printable").print();
}
</script>
</div>
<div class="printable" id="printable">
    <img style="position:absolute;top:0.35in;left:0.23in;width:8.58in;height:2.21in" src="images/factura/vi_1.png" />
    <img style="position:absolute;top:0.35in;left:0.23in;width:8.58in;height:2.22in" src="images/factura/vi_2.png" />
    <img style="position:absolute;top:2.57in;left:0.23in;width:8.58in;height:0.34in" src="images/factura/vi_3.png" />
    <div style="position:absolute;top:1.65in;left:5.17in;width:1.24in;line-height:0.16in;">
    <span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Fecha de Emisión:
    </span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> 
    </span><br/></SPAN></div>
    <img style="position:absolute;top:0.38in;left:3.33in;width:2.36in;height:0.36in" src="images/factura/vi_4.png" />
    <div style="position:absolute;top:0.49in;left:4.00in;width:1.10in;line-height:0.25in;"><span style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Helvetica;color:#000000">ORIGINAL</span><span style="font-style:normal;font-weight:bold;font-size:14pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:1.67in;left:1.27in;width:2.77in;line-height:0.16in;"><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">ZANOTTI BRANCHINI FRANCO Y ZANOTTI</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">BRANCHINI M.PAULA SH</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <img style="position:absolute;top:0.76in;left:0.23in;width:8.58in;height:0.00in" src="images/factura/vi_5.png" />
    <img style="position:absolute;top:1.35in;left:4.52in;width:0.00in;height:1.22in" src="images/factura/vi_6.png" />
    <div style="position:absolute;top:2.03in;left:1.76in;width:2.67in;line-height:0.16in;"><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">Antonio Cañal 2480 - Comodoro Rivadavia,</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">Chubut</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.70in;left:0.32in;width:1.93in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">Período Facturado Desde:</span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.70in;left:3.52in;width:0.51in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">Hasta:</span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.70in;left:5.50in;width:2.01in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">Fecha de Vto. para el pago:</span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <img style="position:absolute;top:2.94in;left:0.22in;width:8.58in;height:0.95in" src="images/factura/vi_7.png" />
    <div style="position:absolute;top:3.56in;left:0.32in;width:1.19in;line-height:0.14in;"><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000">Condición de venta:</span><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:3.26in;left:0.32in;width:1.41in;line-height:0.14in;"><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000">Condición frente al IVA:</span><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:3.00in;left:3.37in;width:4in;line-height:0.14in;"><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000">Apellido y Nombre / Razón Social: </span><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Helvetica;color:#000000"><?=$nombreCliente;?></span><span style="font-style:normal;font-weight:normal;font-size:8pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:3.26in;left:4.73in;width:0.62in;line-height:0.14in;"><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000">Domicilio:</span><br/></SPAN></div>
    <div style="position:absolute;top:3.26in;left:5.5in;width:3in;line-height:0.14in;">
    <span style="font-style:normal;font-size:12pt;font-family:Helvetica;color:#000000"><?=$domicilio;?> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.70in;left:2.41in;width:0.80in;line-height:0.18in;"><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"><?=$fechaDesde;?></span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.70in;left:4.02in;width:0.80in;line-height:0.18in;"><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"><?=$fechaHasta;?></span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.70in;left:7.50in;width:0.80in;line-height:0.18in;"><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"><?=$fechaVtoPago;?></span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:1.64in;left:6.48in;width:0.80in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"><?=$fechaEmision;?></span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.00in;left:5.17in;width:2.07in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000">CUIT: </span></SPAN><br/></div>
    <div style="position:absolute;top:2.00in;left:5.17in;width:2.07in;line-height:0.18in;"><DIV style="position:relative; left:0.42in;"><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">30713017503</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></DIV><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Ingresos Brutos:</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Fecha de Inicio de Actividades:</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:3.56in;left:1.71in;width:0.27in;line-height:0.14in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Helvetica;color:#000000">Otra</span><span style="font-style:normal;font-weight:normal;font-size:8pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:1.41in;left:5.17in;width:1.61in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Punto de Venta: </span></SPAN><br/></div>
    <div style="position:absolute;top:1.41in;left:6.98in;width:1.56in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Comp. Nro: </span></SPAN><br/></div>
    <div style="position:absolute;top:1.41in;left:5.17in;width:1.61in;line-height:0.18in;"><DIV style="position:relative; left:1.15in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"><?=$puntoVenta;?></span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></DIV></div>
    <div style="position:absolute;top:1.41in;left:6.98in;width:1.56in;line-height:0.18in;"><DIV style="position:relative; left:0.85in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"><?=$nroComprobante;?></span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></DIV></div>
    <div style="position:absolute;top:2.03in;left:0.32in;width:1.39in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Domicilio Comercial:</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:1.67in;left:0.32in;width:0.93in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Razón Social:</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:0.89in;left:0.80in;width:2.86in;line-height:0.32in;"><span style="font-style:normal;font-weight:bold;font-size:21pt;font-family:Helvetica;color:#000000">AFRICA EVENTOS</span><span style="font-style:normal;font-weight:bold;font-size:18pt;font-family:Helvetica;color:#000000"> </span><br/><DIV style="position:relative; left:0.05in;"><span style="font-style:normal;font-weight:bold;font-size:18pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></DIV></div>
    <div style="position:absolute;top:2.41in;left:0.32in;width:1.58in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Condición frente al IVA:</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:0.98in;left:5.17in;width:3.39in;line-height:0.32in;"><span style="font-style:normal;font-weight:bold;font-size:18pt;font-family:Helvetica;color:#000000"><?=$tipoComprobante;?></span><span style="font-style:normal;font-weight:bold;font-size:18pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <img style="position:absolute;top:0.77in;left:4.17in;width:0.71in;height:0.62in" src="images/factura/vi_8.png" />
    <div style="position:absolute;top:0.86in;left:4.39in;width:0.36in;line-height:0.43in;"><span style="font-style:normal;font-weight:bold;font-size:24pt;font-family:Helvetica;color:#000000"><?=$letraComprobante;?></span><span style="font-style:normal;font-weight:bold;font-size:24pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <img style="position:absolute;top:0.77in;left:4.16in;width:0.73in;height:0.01in" src="images/factura/vi_9.png" />
    <img style="position:absolute;top:0.77in;left:4.16in;width:0.01in;height:0.64in" src="images/factura/vi_10.png" />
    <img style="position:absolute;top:1.39in;left:4.16in;width:0.73in;height:0.01in" src="images/factura/vi_11.png" />
    <img style="position:absolute;top:0.77in;left:4.88in;width:0.01in;height:0.64in" src="images/factura/vi_12.png" />
    <div style="position:absolute;top:1.22in;left:4.25in;width:0.57in;line-height:0.14in;"><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000">COD. <?=$codigoComprobante;?></span><span style="font-style:normal;font-weight:bold;font-size:8pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.41in;left:1.98in;width:1.77in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">IVA Responsable Inscripto</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:3.26in;left:1.98in;width:2in;line-height:0.14in;"><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Helvetica;color:#000000"><?=$model->esExcento?"Exento":$condicionIva;?></span><span style="font-style:normal;font-weight:normal;font-size:8pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.18in;left:6.35in;width:0.88in;line-height:0.16in;"><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">M.C.R. 99123</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:2.36in;left:7.36in;width:0.72in;line-height:0.16in;"><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">01/01/2013</span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:3.00in;left:0.32in;width:2in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"><?=$tipoDocCliente;?>: </span><span style="font-style:normal;font-weight:normal;font-size:12pt;font-family:Helvetica;color:#000000"><?=$nroDocCliente;?></span><span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:4in;left:0.32in;width:8.5in;line-height:0.14in;">
    <table style="width:100%">
    <tr class="tablaTitulo">
    <th>Codigo</th><th style="width:300px">Producto/Servicio</th><th>Cantidad</th><th>U.Medida</th><th>$ Unitario</th><th>$ Sub-Total</th>
    </tr>
    <?php
    for($i=0;$i<count($items);$i++){?>
    <tr>
        <td>1</td>
        <td><?=$items[$i]['detalle']?></td>
        <td><?=$items[$i]['cantidad']?></td>
        <td><?=$items[$i]['unidadMedida']?></td>
        <td><?=$items[$i]['importeUnidad']?></td>
        <td><?=$items[$i]['subTotal']?></td>
    </tr>
    <?php
    }?>

    </table>
    </div>
    <img style="position:absolute;top:8.80in;left:0.23in;width:8.58in;height:1.42in" src="images/factura/vi_46.png" />
    <img style="position:absolute;top:8.80in;left:0.22in;width:8.59in;height:1.44in" src="images/factura/vi_47.png" />
    <div style="position:absolute;top:9.65in;left:8.42in;width:0.30in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">0,00</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:9.38in;left:8.19in;width:0.53in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"><?=$importeSubTotal;?></span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <?php  if(trim($letraComprobante)==='A'){?>
        <div style="position:absolute;top:9.1in;left:8.19in;width:0.53in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"><?=$importeIva;?></span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <?php }?>

    <div style="position:absolute;top:9.93in;left:8.13in;width:0.59in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"><?=$importeTotal;?></span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:9.38in;left:6.73in;width:0.74in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Subtotal: $</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
<?php  if(trim($letraComprobante)==='A'){?>
    <div style="position:absolute;top:9.1in;left:6.73in;width:0.74in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">IVA 21: $</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
<?php }?>
    <div style="position:absolute;top:9.65in;left:5.80in;width:1.68in;line-height:0.16in;"><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Importe Otros Tributos: $</span><span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:9.93in;left:6.30in;width:1.18in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">Importe <?=$model->esExcento?"Exento":"Total";?>: $</span><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <img style="position:absolute;top:10.52in;left:1.74in;width:1.39in;height:0.35in" src="images/factura/ri_1.png" />
    
    <div style="position:absolute;top:10.37in;left:6.61in;width:1.88in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">CAE N°: </span></SPAN><br/></div>
    <div style="position:absolute;top:10.60in;left:5.58in;width:2.49in;line-height:0.18in;"><span style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">Fecha de Vto. de CAE: </span></SPAN><br/></div>
    <div style="position:absolute;top:11.00in;left:1.74in;width:1.67in;line-height:0.16in;"><span style="font-style:italic;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">Comprobante Autorizado</span><span style="font-style:italic;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:11.29in;left:1.74in;width:4.52in;line-height:0.11in;"><span style="font-style:italic;font-weight:bold;font-size:6pt;font-family:Helvetica;color:#000000">Esta Administración Federal no se responsabiliza por los datos ingresados en el detalle de la operación</span><span style="font-style:italic;font-weight:bold;font-size:6pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></div>
    <div style="position:absolute;top:10.60in;left:5.58in;width:2.49in;line-height:0.18in;"><DIV style="position:relative; left:1.69in;"><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"><?=$vtoCae;?></span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></DIV></div>
    <div style="position:absolute;top:10.37in;left:6.61in;width:1.88in;line-height:0.18in;"><DIV style="position:relative; left:0.66in;"><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"><?=$nroCae;?></span><span style="font-style:normal;font-weight:normal;font-size:10pt;font-family:Helvetica;color:#000000"> </span><br/></SPAN></DIV></div>

    <img style="position:absolute;top:10.36in;left:0.30in;width:1.21in;height:1.21in" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$linkQr;?>&choe=UTF-8" title="Link to Google.com" />

</div>
<style>
.tablaTitulo th{
    background-color:#E0E0E0;
    border:1px solid #000000;
    font-size:10pt;
    font-family:Helvetica;
    color:#000000;
    text-align:center;
    font-weight:bold;
    padding:2px;
}
</style>