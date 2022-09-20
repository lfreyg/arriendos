<?php


require_once "../modelos/equipos.modelo.php";

class TablaMantenedorEquipos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idTipoEquipo;

	public function mostrarTablaEquiposMantenedor(){

	   if($this->idTipoEquipo == ''){			     
		      $filtro = null;
       }else{       	
		      $filtro = $this->idTipoEquipo;    	    
       }
      
  		$productos = ModeloEquipos::mdlMostrarEquiposMantenedor($filtro);
 		
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

		  	
        
         $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEquipo' idEquipo='".$productos[$i]["idEquipo"]."'><i class='fa fa-pencil'></i></button></div>";

         $botones2 =  "<div class='btn-group'><button class='btn btn-primary btnHistoria' idEquipo='".$productos[$i]["idEquipo"]."'><i class='fa fa-times'></i></button></div>";

		  	
		  	$datosJson .='[      
			      "'.$productos[$i]["codigo"].'",	
			      "'.$productos[$i]["serie"].'",			      
			      "'.$equipo.'",	
			      "'.'$ '.number_format($productos[$i]["precio"],0,"",".").'",
			      "'.$productos[$i]["sucursal"].'",			     		     
			      "'.$botones.'",
			      "'.$botones2.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
      
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 

if(isset($_POST["idTipoEquipo"])){
  $activarProductosVentas = new TablaMantenedorEquipos();
  $activarProductosVentas -> idTipoEquipo = $_POST["idTipoEquipo"];
  $activarProductosVentas -> mostrarTablaEquiposMantenedor();
}else{
  $activarProductosVentas = new TablaMantenedorEquipos();
  $activarProductosVentas -> idTipoEquipo = '';
  $activarProductosVentas -> mostrarTablaEquiposMantenedor();
}

