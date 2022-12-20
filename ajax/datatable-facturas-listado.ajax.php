<?php

require_once "../modelos/facturacion.modelo.php";
session_start();

class TablaListadoFactura{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 

	public function mostrarTablaListadoFac(){

		  		
  		$facturas = ModeloFacturacionEEPP::mdlMostrarListadoFacturacion($_SESSION['idObraFacturar']);	


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
             
            $idFactura = $facturas[$i]["idFactura"];           
            $idObra = $facturas[$i]["idObra"];
            $empresa = $facturas[$i]["empresa"];
            $numFactura = $facturas[$i]["numFactura"];
            $fecha = $facturas[$i]["fecha"];
            $cliente = $facturas[$i]["cliente"];
            $estadoFac = $facturas[$i]["estado"];
            $orden = $facturas[$i]['orden_compra'];
            $neto = $facturas[$i]['orden_compra'];


            
		  		  			  			  	
		  	$dateReg = date_create($facturas[$i]["fecha"]);
		  	$fecha = date_format($dateReg,"d-m-Y");

		  	if($facturas[$i]["fecha_orden"] != null){
		  	  $dateReg = date_create($facturas[$i]["fecha_orden"]);
		  	  $fechaOrden = date_format($dateReg,"d-m-Y");
		  	}else{
		  	  $fechaOrden = '';	
		  	}


		  	if($numFactura == 0){
		  		$numFactura = '';
		  	}

		  	if($orden == null){
		  		$orden = '';
		  	}

		  	
		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";
            $disable_print = "";
            $estado = 'ACTIVO';
            $editable = 1;

		  	
  			

  				 $botones =  "<div class='btn-group'><button ".$disable_editar." class='btn btn-warning btnEditarFac' title='Editar' idFactura='".$idFactura."'><i class='fa fa-pencil'></i></button><button ".$disable_anular." class='btn btn-danger btnEliminarFac' title='Anular' idFactura='".$idFactura."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleFac' title='Detalle' idFactura='".$idFactura."'><i class='fa fa-th'></i></button></div>";

  				  	       
		 
		  	$datosJson .='[
			      "'.$empresa.'",	
			      "'.$numFactura.'",
			      "'.$orden.'",
			      "'.$fechaOrden.'",	
			      "'.number_format($neto,0,'','.').'",	      
			      "'.$fecha.'",
			      "'.$cliente.'",
			      "'.$estadoFac.'",			      		     
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
$activarReport = new TablaListadoFactura();
$activarReport -> mostrarTablaListadoFac();

