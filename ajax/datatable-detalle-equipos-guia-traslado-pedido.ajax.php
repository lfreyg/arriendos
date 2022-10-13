<?php


require_once "../modelos/equipos.modelo.php";
require_once "../modelos/pedidoInternoDetalles.modelo.php";
session_start();

class TablaEquiposGuiaDespachoTrasladoPedido{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idCategoria;
  	public $idPedidoInterno;

	public function mostrarTablaEquiposParaTrasladoPedido(){

	   if($this->idCategoria == ''){	
		      $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = 0;
		      $idPedidoInterno = 0;
       }else{
       	  $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = $this->idCategoria;
		      $idPedidoInterno = $this->idPedidoInterno;    	    
       }
      
  		$productos = ModeloEquipos::mdlMostrarEquiposGuiaDespachoTrasladoPedido($id, $filtro);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		   
		       $disable = '';

           $categoriaPedida = ModeloPedidoInternoDetalles::mdlPedidoInternoUnicoPorId($idPedidoInterno);

           $cantidad = $categoriaPedida["cantidad"];

           $despachado = ModeloPedidoInternoDetalles::mdlEquipoPedidoInternoDespachado($idPedidoInterno);
           $cantidadDespacha = $despachado['despachado'];

           $porDespachar = $cantidad - $cantidadDespacha;

           if($porDespachar == 0){
           	 $disable = 'disabled';
           }

  			$equipo = $productos[$i]["descripcion"]." ".$productos[$i]["modelo"]." ".$productos[$i]["marca"];

		  			  	
		  	$botones =  "<div class='btn-group'><button ".$disable." class='btn btn-primary agregarEquipoTraslado' idEquipoParaTraslado='".$productos[$i]["idEquipo"]."'>Agregar</button></div>"; 

		  	$datosJson .='[      
			      "'.$productos[$i]["codigo"].'",			      
			      "'.$equipo.'",			     		     
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
       // var_dump($datosJson);

		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 

if(isset($_POST["idCategoria"])){
  $activarProductosVentas = new TablaEquiposGuiaDespachoTrasladoPedido();
  $activarProductosVentas -> idCategoria = $_POST["idCategoria"];
  $activarProductosVentas -> idPedidoInterno = $_POST["idPedidoInterno"];
  $activarProductosVentas -> mostrarTablaEquiposParaTrasladoPedido();
}else{
  $activarProductosVentas = new TablaEquiposGuiaDespachoTrasladoPedido();
  $activarProductosVentas -> idCategoria = '';
  $activarProductosVentas -> idPedidoInterno = '';
  $activarProductosVentas -> mostrarTablaEquiposParaTrasladoPedido();
}

