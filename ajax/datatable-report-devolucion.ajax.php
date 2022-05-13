<?php

require_once "../controladores/reportDevolucion.controlador.php";
require_once "../modelos/reportDevolucion.modelo.php";
session_start();

class TablaReportDevolucion{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 

	public function mostrarTablaReportDevolucion(){

		  		
  		$report = ControladorReportDevolucion::ctrMostrarReportDevolucion($_SESSION['id']);	


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

		  	$valida = ModeloReportDevolucion::mdlValidaEquipoReportEliminar($report[$i]["idReport"]);
		  	$validaEditar = ModeloReportDevolucion::mdlValidaEquipoReportEditar($report[$i]["idReport"]);

		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";
            $estado = 'ACTIVO';
            $editable = 1;

		  	if($valida == true){
		  		$disable_anular = 'disabled';
		  	} 	

		  	if($validaEditar == true){
		  		$disable_editar = "";
		  		$editable = 0;
		  	} 

		     //ESTADO 1 = ACTIVO , 0 = ANULADO
		    if($report[$i]["estado"] != 1){
                   $estado = 'ANULADO';
                   $disable_editar = 'disabled';
                   $disable_anular = 'disabled';
                   $disable_detalle = 'disabled';
		  	 }

		  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button ".$disable_editar." class='btn btn-warning btnEditarReport' editable='".$editable."', idReport='".$report[$i]["idReport"]."'><i class='fa fa-pencil'></i></button><button ".$disable_anular." class='btn btn-success btnEliminarReport' idReport='".$report[$i]["idReport"]."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleReport' title='Detalle' idReport='".$report[$i]["idReport"]."'><i class='fa fa-th'></i></button></div>";

  				  	       
		 
		  	$datosJson .='[
			      "'.$report[$i]["idReport"].'",	
			      "'.$fechaReg.'",		      
			      "'.$report[$i]["constructora"].'",
			      "'.$report[$i]["obra"].'",	
			      "'.$adjunto.'",			      	
			      "'.$estado.'",			     
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
$activarReport = new TablaReportDevolucion();
$activarReport -> mostrarTablaReportDevolucion();

