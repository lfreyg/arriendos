<?php

require_once "../modelos/ordenCompra.modelo.php";
require_once "../modelos/facturacionOC.modelo.php";
session_start();

class TablaListadoOC{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 

	public function mostrarTablaListadoOC(){

		$idObra = $_SESSION["idObraEEPP"];
		$idEEPP = $_SESSION["idEEPP"];

		  		
  		$ordenCompra = ModeloOrdenCompra::mdlMostrarListadoOC($idObra, $idEEPP);	

  		
  		if(count($ordenCompra) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($ordenCompra); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ADJUNTO
  			=============================================*/ 
             
            $idRegistro = $ordenCompra[$i]["idRegistro"];
            $idConstructora = $ordenCompra[$i]["constructora"];
            $idObra = $ordenCompra[$i]["obra"];
            $oc = $ordenCompra[$i]["oc"];
            $fechaOC = $ordenCompra[$i]["fechaOC"];
            $fechaCrea = $ordenCompra[$i]["fechaCrea"];
            $usuario = $ordenCompra[$i]["usuario"];
            $id_factura = $ordenCompra[$i]["id_factura"];
            $numeroFactura = $ordenCompra[$i]["numero_factura"];
            $neto = $ordenCompra[$i]["neto"];
		  		  			  			  	
		  	$dateReg = date_create($ordenCompra[$i]["fechaOC"]);
		  	$fechaOC = date_format($dateReg,"d-m-Y");

		  	$dateReg = date_create($ordenCompra[$i]["fechaCrea"]);
		  	$fechaCrea = date_format($dateReg,"d-m-Y H:i:s");

		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";
            $disable_print = "";
            $estado = 'ACTIVO';
            $editable = 1;

            if($id_factura != null){
            	$disable_anular = "disabled";
            	$facturacion = ModeloFacturacionEEPPOC::obtenerDatosFactura($id_factura);
                $estadoFactura = $facturacion["estado_factura"];
                  if($estadoFactura == 13){
            	   $disable_editar = "disabled";
                  }
            }

            if($numeroFactura == 0){
            	$numeroFactura = '';
            	$neto = 0;
            }

            $neto = '$ '.number_format($neto,0,'','.');

		  	
  			

  				 $botones =  "<div class='btn-group'><button ".$disable_editar." class='btn btn-warning btnEditarOC' idOC='".$idRegistro."'><i class='fa fa-pencil'></i></button><button ".$disable_anular." class='btn btn-danger btnEliminarOC' idOC='".$idRegistro."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleOC' title='Detalle' idOC='".$idRegistro."'><i class='fa fa-th'></i></button></div>";

  				 $link = "<a href='extensiones/pdf/TCPDF/factura.php?idFactura=".$id_factura."' target='_blank'>".$numeroFactura."</a>";

  				  	       
		 
		  	$datosJson .='[
			      "'.$oc.'",	
			      "'.$fechaOC.'",		      
			      "'.$fechaCrea.'",
			      "'.$link.'",			
			      "'.$neto.'",      		     
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
$activarReport = new TablaListadoOC();
$activarReport -> mostrarTablaListadoOC();

