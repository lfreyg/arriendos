<?php


require_once "../modelos/equipos.modelo.php";
session_start();

class TablaEquiposGuiaDespachoConPedido{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idCategoria;

	public function mostrarTablaEquiposParaArriendoGuiaPedido(){

	  
       	  $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = $this->idCategoria;    	    
       
      
  		$productos = ModeloEquipos::mdlMostrarEquiposGuiaDespachoTrasladoPedido($id, $filtro);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		   
		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

  			$equipo = $productos[$i]["descripcion"]." ".$productos[$i]["modelo"]." ".$productos[$i]["marca"];

		  			  	
		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarEquipoArriendo' idEquipoParaArriendo='".$productos[$i]["idEquipo"]."'>Agregar</button></div>"; 

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
  $activarProductosVentas = new TablaEquiposGuiaDespachoConPedido();
  $activarProductosVentas -> idCategoria = $_POST["idCategoria"];
  $activarProductosVentas -> mostrarTablaEquiposParaArriendoGuiaPedido();
}

