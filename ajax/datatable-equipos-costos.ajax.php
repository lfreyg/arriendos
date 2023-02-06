<?php


require_once "../modelos/equipos.modelo.php";

class TablaEquiposReparacion{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idTipoEquipo;
  	public $idSucursal;
  	public $codigo;

	public function mostrarTablaEquiposReparacion(){

	   if($this->idTipoEquipo == ''){			     
		      $filtro = null;
       }else{       	
		      $filtro = $this->idTipoEquipo;    	    
       }

       $idSucursal = $this->idSucursal;
       $codigo = $this->codigo;
      
  		
     if($codigo == ''){
  		$productos = ModeloEquipos::mdlMostrarEquiposReparacion($filtro, $idSucursal);
  	}else{
      $productos = ModeloEquipos::mdlMostrarEquiposReparacionCodigo($idSucursal, $codigo);
  	}




 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		   $idEquipo =  $productos[$i]["idEquipo"];
		   $idEstado = $productos[$i]["idEstado"];
		   $estadoEquipo = $productos[$i]["estadoEquipo"];

		   $gasto = ModeloEquipos::mdlGastosPorEquipo($idEquipo);

		   if($gasto){
		   	$total = $gasto["neto"];  
		   }else{
		   	$total = 0;
		   }
		   


          		  	

  			$equipo = $productos[$i]["descripcion"]." ".$productos[$i]["modelo"]." ".$productos[$i]["marca"];

		  	
        
         $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEquipo' idEquipo='".$productos[$i]["idEquipo"]."'><i class='fa fa-refresh'></i></button></div>";

         $botones2 =  "<div class='btn-group'><button class='btn btn-primary btnHistoria' idEquipo='".$productos[$i]["idEquipo"]."'><i class='fa fa-map-marker'></i></button></div>";

		  	
		  	$datosJson .='[      
			      "'.$productos[$i]["codigo"].'",	
			      "'.$productos[$i]["serie"].'",			      
			      "'.$equipo.'",	
			      "'.'$ '.number_format($total,0,'','.').'",			     	     		     
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
  $activarProductosVentas = new TablaEquiposReparacion();
  $activarProductosVentas -> idTipoEquipo = $_POST["idTipoEquipo"];
  $activarProductosVentas -> idSucursal = $_POST["idSucursal"];
  $activarProductosVentas -> codigo = $_POST["codigo"];
  $activarProductosVentas -> mostrarTablaEquiposReparacion();
}else{
  $activarProductosVentas = new TablaEquiposReparacion();
  $activarProductosVentas -> idTipoEquipo = '';
  $activarProductosVentas -> idSucursal = $_POST["idSucursal"];
  $activarProductosVentas -> codigo = $_POST["codigo"];
  $activarProductosVentas -> mostrarTablaEquiposReparacion();
}

