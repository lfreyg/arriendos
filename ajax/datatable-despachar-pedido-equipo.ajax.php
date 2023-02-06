<?php

require_once "../controladores/pedidoEquipo.controlador.php";
require_once "../modelos/pedidoEquipo.modelo.php";
session_start();

class TablaDespacharPedidoEquipo{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaDespacharPedidoEquipos(){

		
  		$id = null;
  		$pedidoEquipos = ControladorPedidoEquipo::ctrMostrarDespacharPedidoEquipo($_SESSION['idSucursalParaUsuario']);	

  		if(count($pedidoEquipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidoEquipos); $i++){		    			  		 	
		  	
                 $idConstructora = $pedidoEquipos[$i]["idConstructora"];
                 $idObra = $pedidoEquipos[$i]["idObra"];
		  	            	  	

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-info btnDetalleDespachoPedidoEquipo' idConstructora='".$idConstructora."', idObra='".$idObra."' title='Despachar'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$pedidoEquipos[$i]["constructora"].'",			      
			      "'.$pedidoEquipos[$i]["obra"].'",
			      "'.$pedidoEquipos[$i]["comuna"].'",			      
			      "'.$pedidoEquipos[$i]["pendiente"].'",
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
$activarPedidoEquipos = new TablaDespacharPedidoEquipo();
$activarPedidoEquipos -> mostrarTablaDespacharPedidoEquipos();

