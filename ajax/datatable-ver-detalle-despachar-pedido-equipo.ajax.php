<?php

require_once "../controladores/pedidoEquipo.controlador.php";
require_once "../modelos/pedidoEquipo.modelo.php";
session_start();

class TablaVerDetalleDespacharPedidoEquipo{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaVerDetalleDespacharPedidoEquipos(){

		
  		$id = null;
  		$pedidoEquipos = ControladorPedidoEquipo::ctrMostrarVerDetallePedidoEquipo($_SESSION['idSucursalParaUsuario']);	

  		if(count($pedidoEquipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidoEquipos); $i++){		    			  		 	
		  	

		  	            	  	

		  	$fecha = $pedidoEquipos[$i]["fecha"];
		  	$dateReg = date_create($fecha);				
			$fecha = date_format($dateReg,"d-m-Y H:i:s");

  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-info btnDetallePedidoEquipo' title='Despachar'><i class='fa fa-th'></i></button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$pedidoEquipos[$i]["constructora"].'",			      
			      "'.$pedidoEquipos[$i]["obra"].'",
			      "'.$pedidoEquipos[$i]["comuna"].'",			      
			      "'.$pedidoEquipos[$i]["pedido"].'",	
			      "'.$pedidoEquipos[$i]["equipo"].'",	
			      "'.$fecha.'",	
			      "'.$pedidoEquipos[$i]["tipo"].'",     
			      "'.$pedidoEquipos[$i]["usuario"].'",   
			      "'.$pedidoEquipos[$i]["sucursal"].'"
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
$activarPedidoEquipos = new TablaVerDetalleDespacharPedidoEquipo();
$activarPedidoEquipos -> mostrarTablaVerDetalleDespacharPedidoEquipos();

