<?php


require_once "../modelos/materiales.modelo.php";
session_start();

class TablaMaterialesGuiaDespacho{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  	public $idTipoEquipo;

	public function mostrarTablaMaterialesParaArriendoGuia(){

	   if($this->idTipoEquipo == ''){	
		      $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = null;
       }else{
       	  $id = $_SESSION['idSucursalParaUsuario'];
		      $filtro = $this->idTipoEquipo;    	    
       }
      
  		$materiales = ModeloMateriales::mdlMostrarMaterialesGuiaDespacho($id);
 		
  		if(count($materiales) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($materiales); $i++){

		   
		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

  			$id = $materiales[$i]["id"];
  			$codigo = $materiales[$i]["codigo"];
  			$descripcion = $materiales[$i]["descripcion"];
  			$detalle = $materiales[$i]["detalle"];
  			$stock = $materiales[$i]["stock"];

		  			  	
		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarMaterial' idMaterial='".$id."'>".$stock."</button></div>"; 

		  	$datosJson .='[      
			      "'.$codigo.'",			      
			      "'.$descripcion.'",			     		     
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

if(isset($_POST["idTipoEquipo"])){
  $activarProductosVentas = new TablaMaterialesGuiaDespacho();
  $activarProductosVentas -> idTipoEquipo = $_POST["idTipoEquipo"];
  $activarProductosVentas -> mostrarTablaMaterialesParaArriendoGuia();
}else{
  $activarProductosVentas = new TablaMaterialesGuiaDespacho();
  $activarProductosVentas -> idTipoEquipo = '';
  $activarProductosVentas -> mostrarTablaMaterialesParaArriendoGuia();
}

