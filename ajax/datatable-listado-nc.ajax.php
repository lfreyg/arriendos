<?php

require_once "../modelos/facturacionNCND.modelo.php";
session_start();

class TablaListadoNC{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 

	public function mostrarTablaListadoNC(){

		  		
  		$facturas = ModeloFacturacionNCND::mdlListadoNC($_SESSION['idFacturaNC']);	

  		
  		if(count($facturas) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($facturas); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ADJUNTO
  			=============================================*/ 
             
            $idNC = $facturas[$i]["idNC"];  
            $empresa = $facturas[$i]["empresa"];
            $numero_nc = $facturas[$i]["numero_nc"];
            $fecha_nota = $facturas[$i]["fecha_nota"];
            $neto = $facturas[$i]["neto"];
            $tipoNC = $facturas[$i]["tipoNC"];           
            $constructora = $facturas[$i]['constructora'];
            $obra = $facturas[$i]['obra'];
            $estadoNC = $facturas[$i]['estadoNC'];
            $idEstadoNC = $facturas[$i]['estado_nota'];


            
		  		  			  			  	
		  	$dateReg = date_create($facturas[$i]["fecha_nota"]);
		  	$fecha_nota = date_format($dateReg,"d-m-Y");

		  	

		  	if($numero_nc == 0){
		  		$numero_nc = '';
		  	}

		  			  	
		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";
            
            
            //FACTURA ENVIADA A SII
            if($idEstadoNC == 13){
            	$disable_editar = 'disabled';
            	$disable_anular = 'disabled';
            	$disable_detalle = 'disabled';
            }
            
  				 $botones =  "<div class='btn-group'><button ".$disable_anular." class='btn btn-danger btnEliminarNC' title='Anular' idNC='".$idNC."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleNC' title='Detalle' idNC='".$idNC."'><i class='fa fa-th'></i></button></div>";

  				  	       
		 
		  	$datosJson .='[
			      "'.$empresa.'",	
			      "'.$numero_nc.'",	
			      "'.$fecha_nota.'",			     	
			      "'.'$ '.number_format($neto,0,'','.').'",	      
			      "'.$tipoNC.'",
			      "'.$constructora.'",
			      "'.$obra.'",
			      "'.$estadoNC.'",			      		     
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
$activarReport = new TablaListadoNC();
$activarReport -> mostrarTablaListadoNC();

