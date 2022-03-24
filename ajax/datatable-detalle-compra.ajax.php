<?php

require_once "../controladores/tipoEquipos.controlador.php";
require_once "../modelos/tipoEquipos.modelo.php";

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";


class TablaEquiposFactura{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idMarca;

	public function mostrarTablaEquiposFactura(){

	   if($this->idMarca == ''){	
		$item = null;
    	$valor = null;
    	$orden = "id";
       }else{
       	$item = "id_marca";
    	$valor = $this->idMarca;
    	$orden = "id";
       }
      
  		$productos = ModeloTipoEquipos::mdlMostrarTipoEquiposActivos($item, $valor, $orden);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		    $idMarca = $productos[$i]["id_marca"];
            $marca = ModeloMarcas::mdlMostrarMarcas("marcas","id",$idMarca);

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["foto"]."' width='40px'>";

		  	

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarEquipoArriendo' idTipoEquipo='".$productos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$marca["descripcion"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$productos[$i]["modelo"].'",			     
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

if(isset($_POST["idMarca"])){
  $activarProductosVentas = new TablaEquiposFactura();
  $activarProductosVentas -> idMarca = $_POST["idMarca"];
  $activarProductosVentas -> mostrarTablaEquiposFactura();
}else{
  $activarProductosVentas = new TablaEquiposFactura();
  $activarProductosVentas -> idMarca = '';
  $activarProductosVentas -> mostrarTablaEquiposFactura();
}

