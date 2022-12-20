<?php


require_once "../modelos/constructoras.modelo.php";
session_start();

class constructoraOC{

 	/*=============================================
 	 MOSTRAR LA TABLA
  	=============================================*/ 
		
	public function mostrarConstructorasOC(){

				        
  		$constructora = ModeloConstructoras::mdlMostrarConstructoraSoloConArriendosActivos();
 		
  		if(count($constructora) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($constructora); $i++){


		  	$botones =  "<div class='btn-group'><button class='btn btn-primary seleccionarConstructoraOC' idConstructora='".$constructora[$i]["id"]."'>Seleccionar</button></div>"; 

		  	$datosJson .='[	
		  	      "'.strtoupper($constructora[$i]["rut"]).'",
		  	      "'.strtoupper($constructora[$i]["nombre"]).'",
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


  $eepp = new constructoraOC();      
  $eepp -> mostrarConstructorasOC();


	



