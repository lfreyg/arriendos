<?php

require_once "../../../modelos/ReportDevolucionDetalles.modelo.php";
require_once "../../../modelos/reportDevolucion.modelo.php";



class imprimirReport{

public $id;

public function traerReport(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$idReport = $this->id;

//TRAEMOS LA INFORMACIÓN DEL CLIENTE
$cabecera = ModeloReportDevolucion::mdlMostrarCabeceraReportParaImprimir($idReport);


$numeroReport = $cabecera["report"];
$constructora = $cabecera["constructora"];
$obra = $cabecera["obra"];
$retira = $cabecera["retira"];
$dateReg = date_create($cabecera["fechaReport"]);
$fechaReport = date_format($dateReg,"d-m-Y H:i:s");
$bodeguero = $cabecera["bodeguero"];


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
				<h1>DOCUMENTO RETIRO DE EQUIPOS</h1>
			</td>
		</tr>
		<tr>				
			<td style="background-color:white; width:540px; text-align:center; color:red">				
				<h3>DOCUMENTO FOLIO N° $idReport</h3>
			</td>
		</tr>

	</table>
	<br/>
	<br/>
	<br/>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


// ---------------------------------------------------------

$bloque2 = <<<EOF
	
	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:270px">
				$constructora
			</td>
			<td style="border: 1px solid #666; background-color:white; width:270px">
				Obra: $obra
			</td>
	   </tr>
	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:270px">
				Retirado Por: $retira
			</td>

			<td style="border: 1px solid #666; background-color:white; width:270px">			
				Fecha Doc.: $fechaReport
			</td>
		</tr>	

		<tr>		
		  <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 5px;">
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:60px; text-align:center"><strong>Código</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:240px; text-align:center"><strong>Equipo Retirado</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Fecha Retiro</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Fecha Término</strong></td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Movimiento</strong></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$productos = ModeloReportDevolucionDetalles::mdlRetiroPorId($idReport);

foreach ($productos as $key => $value) {

	       $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"];                
           $movimiento = $value["movimiento"];

           $dateRetiro = date_create($value["fechaRetiroObra"]);
           $fechaRetiroObra = date_format($dateRetiro,"d-m-Y H:i:s");

           $dateCobro = date_create($value["fecha"]);
           $fechaCobro = date_format($dateCobro,"d-m-Y");



           $arriendo = $equipo." ".$modelo." ".$marca;



$bloque4 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">

		<tr>

		    <td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">$codigo</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:240px; text-align:left">$arriendo</td>			

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$fechaRetiroObra</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">$fechaCobro</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:left">$movimiento</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF
    <br/>
    <br/>
    <br/>
	<table style="font-size:10px; padding:5px 50px;">	
		
		<tr>
			<td style="solid #666; color:#333; background-color:white; width:540px; text-align:center; color:red">NOMBRE ENCARGADO DE BODEGA
			</td>			
		</tr>
		<tr>
			<td style="solid #666; color:#333; background-color:white; width:540px; text-align:center; color:red"><strong>$bodeguero</strong>
			</td>			
		</tr>
		<tr>			
			<td style="width:540px; text-align:center"><img src="../../../vistas/img/firmaReport/firma_$idReport.png" width="120" height="120"></td>	
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 


$pdf->Output('report-'.$numeroReport.'.pdf');

}

}

$report = new imprimirReport();
$report -> id = $_GET["id"];
$report -> traerReport();

?>