<?php

require_once "../../../modelos/transportista.modelo.php";
require_once "../../../controladores/transportista.controlador.php";



class imprimirHojaRuta{

public $id;

public function traerHojaRuta(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

        $idChofer = $this->id;

        $item = "id";
		$valor = $this->id;

		

//TRAEMOS LA INFORMACIÓN DEL CHOFER
$respuesta = ControladorTransportistas::ctrMostrarTransportista($item, $valor);


$rut = $respuesta["rut"];
$nombre = $respuesta["nombre"];
date_default_timezone_set('America/Santiago');
$hoy = date('d-m-Y H:i:s');



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
			<td style="width:80px; text-align:left"><img src="images/fyb_logo2.png"></td>						
		</tr>	

		<tr>	
			
			<td style="background-color:white; width:540px; text-align:center">				
				<h1>HOJA DE RUTA</h1>
			</td>
		</tr>
		<tr>				
			<td style="background-color:white; width:540px; text-align:center; color:blue">				
				<h3>$nombre</h3>
			</td>
		</tr>
		<tr>				
			<td style="background-color:white; width:540px; text-align:center; color:blue">				
				<h3>$hoy</h3>
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
			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center"><strong>Constructora</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center"><strong>Obra</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:140px; text-align:center"><strong>Comuna</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Guía</strong></td>			

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$productos = ModeloTransportista::mdlHojaRutaChofer($idChofer);

foreach ($productos as $key => $value) {

	       $constructora = $value["constructora"];
           $obra = $value["obra"];
           $comuna = $value["comuna"];
           $guia = $value["numero_guia"];       
          


$bloque4 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">

		<tr>

		    <td style="border: 1px solid #666; color:#333; background-color:white; width:160px; text-align:left">$constructora</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:160px; text-align:left">$obra</td>			

			<td style="border: 1px solid #666; color:#333; background-color:white; width:140px; text-align:left">$comuna</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$guia</td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 


$pdf->Output('hojaRuta-'.$rut.'.pdf');

}

}

$report = new imprimirHojaRuta();
$report -> id = $_GET["id"];
$report -> traerHojaRuta();

?>