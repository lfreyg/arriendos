<?php

require_once "../../../modelos/equipos.modelo.php";



class imprimirComprobante{

public $idSolicitud;

public function traerComprobante(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$idSolicitud = $this->id;

//TRAEMOS LA INFORMACIÓN DEL CLIENTE
$cabecera = ModeloEquipos::mdlTraerSolicitudEstadoPorID($idSolicitud);


$codigoEquipo = $cabecera["codigo"];
$equipo = $cabecera["descripcion"].' '.$cabecera["modelo"].' '.$cabecera["marca"];
$sucursal = $cabecera["sucursal"];
$solicitante = $cabecera["usuario"];
$idEstadoAnterior = $cabecera["id_estado_anterior"];
$estadoAnterior = $cabecera["estadoAnterior"];
$estadoSolicitado = $cabecera["estadoSolicitado"];
$motivo = $cabecera["motivo"];
$fechaSolicitud = $cabecera["fecha_real"];
$fecha_aprueba = $cabecera["fecha_aprueba"];
$aprobador = $cabecera["aprobador"];

$dateReg = date_create($fechaSolicitud);
$fechaSolicitud = date_format($dateReg,"d-m-Y H:i:s");

$dateReg = date_create($fecha_aprueba);
$fecha_aprueba = date_format($dateReg,"d-m-Y H:i:s");


if($idEstadoAnterior == 2){
	$guiaDespacho = $cabecera["numero_guia"];
	$constructora = $cabecera["constructora"];
	$obra = $cabecera["obra"];
	$fecha_arriendo = $cabecera["fecha_arriendo"];
	$fecha_devolucion_real = $cabecera["fecha_devolucion_real"];
	$idRegistroRevisar = $cabecera["idRegistroRevisar"];
	$ultimo_cobro = $cabecera["fecha_ultimo_cobro"];

	$dateReg = date_create($fecha_arriendo);
    $fecha_arriendo = date_format($dateReg,"d-m-Y");

    $dateReg = date_create($fecha_devolucion_real);
    $fecha_devolucion_real = date_format($dateReg,"d-m-Y");

    $dateReg = date_create($ultimo_cobro);
    $ultimo_cobro = date_format($dateReg,"d-m-Y");
}





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
				<h1>COMPROBANTE CAMBIO ESTADO EQUIPO</h1>
			</td>
		</tr>
		<tr>				
			<td style="background-color:white; width:540px; text-align:center; color:red">				
				<h3>COMPROBANTE FOLIO N° $idSolicitud</h3>
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
			<td style="border: 1px solid #666; background-color:ccc; width:540px; text-align:center">				
				INFORMACIÓN DEL EQUIPO
			</td>
		</tr>
	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				CÓDIGO EQUIPO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$codigoEquipo
			</td>
	   </tr>
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				DESCRIPCIÓN EQUIPO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$equipo
			</td>
	   </tr>
	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				SUCURSAL EQUIPO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$sucursal
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

	<table style="font-size:10px; padding:5px 10px;">	
	   <tr>				
			<td style="border: 1px solid #666; background-color:ccc; width:540px; text-align:center">				
				INFORMACIÓN DEL ESTADO SOLICITADO
			</td>
		</tr>
	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px; color:red">
				ESTADO ANTERIOR
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px; color:red">
				$estadoAnterior
			</td>
	   </tr>
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px; color:blue">
				ESTADO APROBADO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px; color:blue">
				$estadoSolicitado
			</td>
	   </tr>	   
	  <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				FECHA Y HORA SOLICITUD
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$fechaSolicitud
			</td>
	   </tr>
	    <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				MOTIVO SOLICITUD
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$motivo
			</td>
	   </tr>

	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				SOLICITANTE
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$solicitante
			</td>
	   </tr>

	     <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				FECHA Y HORA APROBACIÓN
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$fecha_aprueba
			</td>
	   </tr>

	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				APROBADOR
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$aprobador
			</td>
	   </tr>

	</table>


EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------


if($idEstadoAnterior == 2){
$bloque5 = <<<EOF
     
      <table style="font-size:10px; padding:5px 10px;">	
	     <tr>				
			<td style="border: 1px solid #666; background-color:yellow; width:540px; text-align:center">				
				EL EQUIPO SE ENCONTRABA ARRENDADO
			</td>
		</tr>	  
	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				GUÍA DESPACHO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$guiaDespacho
			</td>
	   </tr>
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				FECHA ARRIENDO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$fecha_arriendo
			</td>
	   </tr>	   
	  <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				FECHA TERMINO GENERADA
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$fecha_devolucion_real
			</td>
	   </tr>
	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				ÚLTIMO COBRO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$ultimo_cobro
			</td>
	   </tr>

	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				CONSTRUCTORA
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$constructora
			</td>
	   </tr>

	     <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				OBRA
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$obra
			</td>
	   </tr>

	   <tr>		
			<td style="border: 1px solid #666; background-color:white; width:170px">
				ID INTERNO
			</td>
			<td style="border: 1px solid #666; background-color:white; width:370px">
				$idRegistroRevisar
			</td>
	   </tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');
}


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 


$pdf->Output('comprobante-nuevo-estado-'.$idSolicitud.'.pdf');

}

}

$comprobante = new imprimirComprobante();
$comprobante -> id = $_GET["id"];
$comprobante -> traerComprobante();

?>