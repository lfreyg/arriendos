<?php

require_once "../controladores/reportDevolucion.controlador.php";
require_once "../modelos/reportDevolucion.modelo.php";
session_start();

class TablaReportValidacionDevolucion{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 

	public function mostrarTablaReportValidacionDevolucion(){

		  		
  		$report = ControladorReportDevolucion::ctrMostrarReportValidacionDevolucion($_SESSION['idSucursalParaUsuario']);	


  		if(count($report) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($report); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ADJUNTO
  			=============================================*/ 

		  	if(!empty($report[$i]["documento"])){
		  	    $adjunto = "<a href='".$report[$i]["documento"]."' target='_blank'>Descargar</a>";
		    }else{
		  	    $adjunto = "";
		    }

		  			  			  	
		  	$dateReg = date_create($report[$i]["creado"]);
		  	$fechaReg = date_format($dateReg,"d-m-Y H:i:s");

		         	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-info btnDetalleValidacionReport' title='Detalle' idReport='".$report[$i]["idReport"]."'><i class='fa fa-th'></i></button><button class='btn btn-primary btnImprimeReport' title='Imprimir' idReport='".$report[$i]["idReport"]."'><i class='fa fa-print'></i></button></div>";

  				  	       
		 
		  	$datosJson .='[
			      "'.$report[$i]["idReport"].'",	
			      "'.$fechaReg.'",		      
			      "'.$report[$i]["constructora"].'",
			      "'.$report[$i]["obra"].'",	
			      "'.$adjunto.'",			      	
			      "'.$report[$i]["usuario"].'",			     
			      "'.$botones.'"
			    ],';

		  }


		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA REPORT DEVOLUCION
=============================================*/ 
$activarReport = new TablaReportValidacionDevolucion();
$activarReport -> mostrarTablaReportValidacionDevolucion();

