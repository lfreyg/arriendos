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

		  	
		  		$disable = '';
		  	

		  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarPedidoEquipo' idPedido='".$guiaDespacho[$i]["id"]."'><i class='fa fa-pencil'></i></button><button ".$disable." class='btn btn-danger btnEliminarPedidoEquipo' idPedido='".$guiaDespacho[$i]["id"]."'><i class='fa fa-times'></i></button><button class='btn btn-info btnDetallePedidoEquipo' title='Detalle' idPedido='".$guiaDespacho[$i]["id"]."'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$guiaDespacho[$i]["empresa"].'",			      
			      "'.$guiaDespacho[$i]["guia"].'",
			      "'.$fechaReg.'",			      
			      "'.$guiaDespacho[$i]["constructora"].'",	
			      "'.$guiaDespacho[$i]["obra"].'",	
			      "'.$guiaDespacho[$i]["oc"].'",
			      "'.$adjunto.'",			     
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

