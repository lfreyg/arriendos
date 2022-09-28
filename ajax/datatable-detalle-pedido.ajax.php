<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";



class TablaEquiposPedido{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idCategoria;

	public function mostrarTablaEquiposPedido(){

	   if($this->idCategoria == ''){					
			   	$categoria = null;			   
       }else{		      
		    	$categoria = $this->idCategoria;		    	
       }
      
  		$productos = ModeloEquipos::mdlMostrarEquiposPedidos($categoria);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		    		  	

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarEquipoArriendo' idTipoEquipo='".$productos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[			     
			      "'.$botones.'",			     
			      "'.$productos[$i]["categoria"].'",
			      "'.$productos[$i]["marca"].'",
			      "'.$productos[$i]["equipo"].'",
			      "'.$productos[$i]["modelo"].'"
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
  $activarProductosVentas = new TablaEquiposPedido();
  $activarProductosVentas -> idCategoria = $_POST["idCategoria"];
  $activarProductosVentas -> mostrarTablaEquiposPedido();
}else{
  $activarProductosVentas = new TablaEquiposPedido();
  $activarProductosVentas -> idCategoria = '';
  $activarProductosVentas -> mostrarTablaEquiposPedido();
}

