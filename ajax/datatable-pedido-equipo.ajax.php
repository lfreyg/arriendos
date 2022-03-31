<?php

require_once "../controladores/pedidoEquipo.controlador.php";
require_once "../modelos/pedidoEquipo.modelo.php";
session_start();

class TablaPedidoEquipo{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaPedidoEquipos(){

		
  		$id = null;
  		$pedidoEquipos = ControladorPedidoEquipo::ctrMostrarPedidoEquipo($_SESSION['id']);	

  		if(count($pedidoEquipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidoEquipos); $i++){

		  	/*=============================================
 	 		TRAEMOS EL ADJUNTO
  			=============================================*/ 

		  	if(!empty($pedidoEquipos[$i]["documento"])){
		  	    $adjunto = "<a href='".$pedidoEquipos[$i]["documento"]."' target='_blank'>Descargar</a>";
		    }else{
		  	    $adjunto = "";
		    }

		  			  			  	
		  	$dateReg = date_create($pedidoEquipos[$i]["creado"]);
		  	$fechaReg = date_format($dateReg,"d-M-Y H:i:s");

		  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarPedidoEquipo' idPedido='".$pedidoEquipos[$i]["numero"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarPedidoEquipo' idPedido='".$pedidoEquipos[$i]["numero"]."'><i class='fa fa-times'></i></button><button class='btn btn-info btnDetallePedidoEquipo' title='Detalle' idPedido='".$pedidoEquipos[$i]["numero"]."'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$pedidoEquipos[$i]["numero"].'",			      
			      "'.$pedidoEquipos[$i]["constructora"].'",
			      "'.$pedidoEquipos[$i]["obra"].'",			      
			      "'.$pedidoEquipos[$i]["sucursal"].'",	
			      "'.$pedidoEquipos[$i]["oc"].'",	
			      "'.$adjunto.'",
			      "'.$fechaReg.'",	
			      "'.$pedidoEquipos[$i]["estado"].'",			     
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
ACTIVAR TABLA DE PEDIDOS
=============================================*/ 
$activarPedidoEquipos = new TablaPedidoEquipo();
$activarPedidoEquipos -> mostrarTablaPedidoEquipos();

