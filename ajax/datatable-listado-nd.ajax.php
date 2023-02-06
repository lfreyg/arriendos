<?php

require_once "../modelos/facturacionNCND.modelo.php";
session_start();

class TablaListadoND{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 

	public function mostrarTablaListadoND(){

		  		
  		$facturas = ModeloFacturacionNCND::mdlListadoND($_SESSION['idFacturaND']);	

  		
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
             
            $idND = $facturas[$i]["idND"];  
            $empresa = $facturas[$i]["empresa"];
            $numero_nd = $facturas[$i]["numero_nd"];
            $fecha_nota = $facturas[$i]["fecha_nota"];
            $neto = $facturas[$i]["neto"];
            $tipoND = $facturas[$i]["tipoND"];           
            $constructora = $facturas[$i]['constructora'];
            $obra = $facturas[$i]['obra'];
            $estadoND = $facturas[$i]['estadoND'];
            $idEstadoND = $facturas[$i]['estado_nota'];


            
		  		  			  			  	
		  	$dateReg = date_create($facturas[$i]["fecha_nota"]);
		  	$fecha_nota = date_format($dateReg,"d-m-Y");

		  	

		  			  			  	
		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";
            
            
            //FACTURA ENVIADA A SII
            if($idEstadoND == 13){
            	$disable_editar = 'disabled';
            	$disable_anular = 'disabled';
            	$disable_detalle = 'disabled';
            }
            
  				 $botones =  "<div class='btn-group'><button ".$disable_anular." class='btn btn-danger btnEliminarND' title='Anular' idND='".$idND."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleND' title='Detalle' idND='".$idND."'><i class='fa fa-th'></i></button></div>";

  				  	       
		 
		  	$datosJson .='[
			      "'.$empresa.'",	
			      "'.$numero_nd.'",	
			      "'.$fecha_nota.'",			     	
			      "'.'$ '.number_format($neto,0,'','.').'",	      
			      "'.$tipoND.'",
			      "'.$constructora.'",
			      "'.$obra.'",
			      "'.$estadoND.'",			      		     
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
$activarReport = new TablaListadoND();
$activarReport -> mostrarTablaListadoND();

