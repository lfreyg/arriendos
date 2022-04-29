<?php

require_once "../controladores/guiaDespacho.controlador.php";
require_once "../modelos/guiaDespacho.modelo.php";
session_start();

class TablaGuiaDespacho{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaGuiaDespacho(){

		
  		$id = $_SESSION['idSucursalParaUsuario'];
  		$guiaDespacho = ControladorGuiaDespacho::ctrMostrarGuiaDespacho($id);	

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

		  	if(!empty($guiaDespacho[$i]["adjunto"])){
		  	    $adjunto = "<a href='".$guiaDespacho[$i]["adjunto"]."' target='_blank'>Descargar</a>";
		    }else{
		  	    $adjunto = "";
		    }

		  			  			  	
		  	$dateReg = date_create($guiaDespacho[$i]["fecha"]);
		  	$fechaReg = date_format($dateReg,"d-m-Y");

		  	$disable_editar = "";
            $disable_anular = "";
            $disable_detalle = "";

		  	    //ESTADO GUIA 12 = NO ENVIADA, 13 = ENVIADA A SII, 14 = NULA 
		  		if($guiaDespacho[$i]["idestado"] == 14){
                   $disable_editar = 'disabled';
                   $disable_anular = 'disabled';
                   $disable_detalle = 'disabled';
		  		}

		  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button ".$disable_editar." class='btn btn-warning btnEditarGuiaDespacho' idGuia='".$guiaDespacho[$i]["id"]."'><i class='fa fa-pencil'></i></button><button ".$disable_anular." class='btn btn-success btnEliminarGuiaDespacho' idEstado ='".$guiaDespacho[$i]["idestado"]."' idGuia='".$guiaDespacho[$i]["id"]."'><i class='fa fa-times'></i></button><button ".$disable_detalle." class='btn btn-info btnDetalleGuiaDespacho' title='Detalle' idGuia='".$guiaDespacho[$i]["id"]."'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$guiaDespacho[$i]["empresa"].'",			      
			      "'.$guiaDespacho[$i]["guia"].'",
			      "'.$fechaReg.'",			      
			      "'.$guiaDespacho[$i]["constructora"].'",	
			      "'.$guiaDespacho[$i]["obra"].'",	
			      "'.$guiaDespacho[$i]["oc"].'",
			      "'.$adjunto.'",
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
$activarGuiaDespacho = new TablaGuiaDespacho();
$activarGuiaDespacho -> mostrarTablaGuiaDespacho();

