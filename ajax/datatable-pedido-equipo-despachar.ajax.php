<?php

require_once "../controladores/pedidoEquipo.controlador.php";
require_once "../modelos/pedidoEquipo.modelo.php";
session_start();

class TablaDespacharPedidoEquipoGD{

    public $idObra;

	public function mostrarTablaPedidoEquiposDespachar(){

		
  		$idObra = $this->idObra;	
  		$pedidoEquipos = ModeloPedidoEquipo::mdlEquiposPedidoParaGD($idObra);	

  		if(count($pedidoEquipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidoEquipos); $i++){		    			  		 	
		  	
		  	  			

  				 $botones =  "<div class='btn-group'><button class='btn btn-info btnCategoriaSel' idPedido='".$pedidoEquipos[$i]["idPedido"]."', idCategoria='".$pedidoEquipos[$i]["idCategoria"]."'  >Seleccionar</button></div>";

  				  			           
		 
		  	$datosJson .='[
			      "'.$botones.'",			      
			      "'.$pedidoEquipos[$i]["categoria"].'",
			      "'.$pedidoEquipos[$i]["descripcion"].'"	 
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
if(isset($_POST["idObra"])){
$activarPedidoEquipos = new TablaDespacharPedidoEquipoGD();
$activarPedidoEquipos -> idObra = $_POST["idObra"]; 
$activarPedidoEquipos -> mostrarTablaPedidoEquiposDespachar();
}

