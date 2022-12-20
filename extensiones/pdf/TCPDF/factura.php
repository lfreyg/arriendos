<?php

require_once "../../../modelos/facturacion.modelo.php";



class imprimirFactura{

public $idFactura;

public function traerFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$idFactura = $this->idFactura;

$facturaRespuesta = ModeloFacturacionEEPP::obtenerDatosFactura($idFactura);


$iva = $facturaRespuesta["iva"];



//REQUERIMOS LA CLASE TCPDF


// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);





$pdf->startPageGroup();
$pdf->AddPage();



$bloque1 = <<<EOF

  <table>
     <tr>
      <td style="background-color:white; width:540px; text-align:center">       
        <h1>PREVISUALIZACIÓN DE FACTURA</h1>
      </td>
    </tr>
  </table>
  <br/>
  <br/>
  <br/>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


$bloque3 = <<<EOF

  <table style="font-size:8px; padding:5px 5px;">
    <tr>    
      <td style="border: 1px solid #666; background-color:white; width:60px; text-align:center"><strong>Código</strong></td>
      <td style="border: 1px solid #666; background-color:white; width:240px; text-align:center"><strong>Descripción</strong></td>
      <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Cantidad</strong></td>
      <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Precio</strong></td>
      <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Valor</strong></td>

    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$subtotalFactura = 0;

$productos = ModeloFacturacionEEPP::mdlPrevisualizarFactura($idFactura);

foreach ($productos as $key => $value) {

           $codigo = $value["codigo"];
           $descripcion = $value["descripcion"];
           $glosa =  $value["glosa"];
           $cantidad = $value["cantidad"];   
           
           $subTotal = $value["valor"];

           $subtotalFactura = $subtotalFactura + $subTotal;

           $precio = '$ '.number_format($value["precio"],0,'','.');
           $valor = '$ '.number_format($value["valor"],0,'','.');
           

$bloque4 = <<<EOF

  <table style="font-size:8px; padding:5px 10px;">

    <tr>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">$codigo</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:white; width:240px; text-align:left">$descripcion</td>     

      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$cantidad</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$precio</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:rigth">$valor</td>
    </tr>

    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:540px; text-align:left">$glosa</td>
    </tr>

  </table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

$iva_facturacion = ($subtotalFactura * $iva) / 100;
$total_facturacion = $subtotalFactura + $iva_facturacion;


$subtotalFactura = number_format($subtotalFactura,0,'','.');
$iva_facturacion = number_format($iva_facturacion,0,'','.');
$total_facturacion = number_format($total_facturacion,0,'','.');

$bloque5 = <<<EOF
  <br>
  <br>
  <table style="font-size:8px; padding:5px 10px;">

    <tr>
       <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">MONTO NETO</td>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$subtotalFactura</td>
    </tr>  

     <tr>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">I.V.A $iva %</td>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$iva_facturacion</td>
    </tr>

     <tr>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">TOTAL</td>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$total_facturacion</td>
    </tr>

  </table>
  

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 


$pdf->Output('factura-'.$idFactura.'.pdf');

}

}

$report = new imprimirFactura();
$report -> idFactura = $_GET["idFactura"];
$report -> traerFactura();

?>