<?php

require_once "../controladores/pedidoInterno.controlador.php";
require_once "../modelos/pedidoInterno.modelo.php";
session_start();

class TablaPedidoInternoDespacho{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaPedidoInternoDespacho(){

		  		
  		$pedidoEquipos = ControladorPedidoInterno::ctrMostrarPedidoInternoDespacho($_SESSION['idSucursalParaUsuario']);	

  		if(count($pedidoEquipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidoEquipos); $i++){
		  	 		

		  			  			  	
		  	$dateReg = date_create($pedidoEquipos[$i]["fecha"]);
		  	$fechaReg = date_format($dateReg,"d-m-Y H:i:s");

		  	
		  			  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'></button><button class='btn btn-info btnDetallePedidoInternoDespacho' title='Despachar' idPedido='".$pedidoEquipos[$i]["numero"]."'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$pedidoEquipos[$i]["numero"].'",			      
			      "'.$fechaReg.'",
			      "'.$pedidoEquipos[$i]["usuario"].'",
			      "'.$pedidoEquipos[$i]["sucursal"].'",
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
$activarPedidoEquipos = new TablaPedidoInternoDespacho();
$activarPedidoEquipos -> mostrarTablaPedidoInternoDespacho();

