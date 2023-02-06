<?php

require_once "../controladores/guiaDespachoTaller.controlador.php";
require_once "../modelos/guiaDespachoTaller.modelo.php";
session_start();

class TablaGuiaDespachoTaller{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaGuiaDespachoTaller(){

		
  		$id = $_SESSION['idSucursalParaUsuario'];
  		$guiaDespacho = ControladorGuiaDespachoTaller::ctrMostrarGuiaDespacho($id);	

  		if(count($guiaDespacho) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($guiaDespacho); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ADJUNTO
  			=============================================*/ 

		  	
		  			  			  	
		  	$dateReg = date_create($guiaDespacho[$i]["fecha"]);
		  	$fechaReg = date_format($dateReg,"d-m-Y");

		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";

                if($guiaDespacho[$i]["idestado"] == 13){
                   $disable_editar = 'disabled';                  
		  		}

		  	    //ESTADO GUIA 12 = NO ENVIADA, 13 = ENVIADA A SII, 14 = NULA 
		  		if($guiaDespacho[$i]["idestado"] == 14){
                   $disable_editar = 'disabled';
                   $disable_anular = 'disabled';
                   $disable_detalle = 'disabled';
		  		}

		  		
		  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button ".$disable_editar." class='btn btn-warning btnEditarGuiaDespacho' idGuia='".$guiaDespacho[$i]["id"]."'><i class='fa fa-pencil'></i></button><button ".$disable_anular." class='btn btn-danger btnEliminarGuiaDespacho' idEstado ='".$guiaDespacho[$i]["idestado"]."' idGuia='".$guiaDespacho[$i]["id"]."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleGuiaDespacho' title='Detalle' idGuia='".$guiaDespacho[$i]["id"]."'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$guiaDespacho[$i]["empresa"].'",			      
			      "'.$guiaDespacho[$i]["guia"].'",
			      "'.$fechaReg.'",			      
			      "'.$guiaDespacho[$i]["taller"].'",				     
			      "'.$guiaDespacho[$i]["chofer"].'",			     
			      "'.$guiaDespacho[$i]["estado"].'",			     
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
ACTIVAR TABLA GD
=============================================*/ 
$activarGuiaDespacho = new TablaGuiaDespachoTaller();
$activarGuiaDespacho -> mostrarTablaGuiaDespachoTaller();

