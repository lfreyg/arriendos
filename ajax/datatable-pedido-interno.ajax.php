<?php

require_once "../controladores/pedidoInterno.controlador.php";
require_once "../modelos/pedidoInterno.modelo.php";
session_start();

class TablaPedidoInterno{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaPedidoInterno(){

		  		
  		$pedidoEquipos = ControladorPedidoInterno::ctrMostrarPedidoInterno($_SESSION['idSucursalParaUsuario']);	

  		if(count($pedidoEquipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidoEquipos); $i++){
		  	 		

		  			  			  	
		  	$dateReg = date_create($pedidoEquipos[$i]["fecha"]);
		  	$fechaReg = date_format($dateReg,"d-m-Y H:i:s");

		  	$disable = "";

		  	$estado = 'EN CONSTRUCCIÓN';

		  	if($pedidoEquipos[$i]["finalizado"] == true){
		  		$estado = "PEDIDO TERMINADO";
		  		$disable = 'disabled';
		  	}

		  			  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button ".$disable." class='btn btn-danger btnEliminarPedidoInterno' idPedido='".$pedidoEquipos[$i]["numero"]."'><i class='fa fa-times'></i></button><button class='btn btn-info btnDetallePedidoInterno' title='Detalle' idPedido='".$pedidoEquipos[$i]["numero"]."'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$pedidoEquipos[$i]["numero"].'",			      
			      "'.$fechaReg.'",
			      "'.$pedidoEquipos[$i]["usuario"].'",
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
ACTIVAR TABLA DE PEDIDOS
=============================================*/ 
$activarPedidoEquipos = new TablaPedidoInterno();
$activarPedidoEquipos -> mostrarTablaPedidoInterno();

