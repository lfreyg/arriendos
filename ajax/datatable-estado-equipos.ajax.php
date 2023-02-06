<?php


require_once "../modelos/equipos.modelo.php";

class TablaEstadosEquipos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idTipoEquipo;
  	public $idSucursal;
  	public $codigo;

	public function mostrarTablaEquiposEstados(){

	   if($this->idTipoEquipo == ''){			     
		      $filtro = null;
       }else{       	
		      $filtro = $this->idTipoEquipo;    	    
       }

       $idSucursal = $this->idSucursal;
       $codigo = $this->codigo;
      
  		
     if($codigo == ''){
  		$productos = ModeloEquipos::mdlMostrarEquiposEstados($filtro, $idSucursal);
  	}else{
      $productos = ModeloEquipos::mdlMostrarEquiposEstadosCodigo($idSucursal, $codigo);
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
       
       $idGuiaDetalle = 0;

      if($idEstado == 2){
		   $gd = ModeloEquipos::mdlTraeDatosArriendoCambioEstado($idEquipo);
      
      if($gd){
		   $estadoEquipo .= ' ('.$gd["constructora"].' / '.$gd['obra'].')';
		   $idGuiaDetalle = $gd["idGuiaDetalle"];
		  }
		  } 


		  	

  			$equipo = $productos[$i]["descripcion"]." ".$productos[$i]["modelo"]." ".$productos[$i]["marca"];

		  	
        
         $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEquipo' idEquipo='".$productos[$i]["idEquipo"]."', idGuiaDetalle = '".$idGuiaDetalle."'><i class='fa fa-refresh'></i></button></div>";

         $botones2 =  "<div class='btn-group'><button class='btn btn-primary btnHistoria' idEquipo='".$productos[$i]["idEquipo"]."'><i class='fa fa-map-marker'></i></button></div>";

		  	
		  	$datosJson .='[      
			      "'.$productos[$i]["codigo"].'",	
			      "'.$productos[$i]["serie"].'",			      
			      "'.$equipo.'",	
			      "'.$estadoEquipo.'",			     	     		     
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
  $activarProductosVentas = new TablaEstadosEquipos();
  $activarProductosVentas -> idTipoEquipo = $_POST["idTipoEquipo"];
  $activarProductosVentas -> idSucursal = $_POST["idSucursal"];
  $activarProductosVentas -> codigo = $_POST["codigo"];
  $activarProductosVentas -> mostrarTablaEquiposEstados();
}else{
  $activarProductosVentas = new TablaEstadosEquipos();
  $activarProductosVentas -> idTipoEquipo = '';
  $activarProductosVentas -> idSucursal = $_POST["idSucursal"];
  $activarProductosVentas -> codigo = $_POST["codigo"];
  $activarProductosVentas -> mostrarTablaEquiposEstados();
}

