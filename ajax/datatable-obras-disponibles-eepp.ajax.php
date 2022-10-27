<?php

require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
session_start();

class obrasDisponiblesEEPP{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  		
	public $fecha;

	public function mostrarObras(){

		$fecha = $this->fecha;	
			
  		$eepp = ControladorEEPP::ctrMostrarConstructoraEEPP($fecha);
 		
  		if(count($eepp) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($eepp); $i++){


		  	$botones =  "<div class='btn-group'><button class='btn btn-primary seleccionarCliente' idConstructora='".$eepp[$i]["id"]."'>Seleccionar</button></div>"; 

		  	$datosJson .='[	
		  	      "'.strtoupper($eepp[$i]["rut"]).'",
		  	      "'.strtoupper($eepp[$i]["nombre"]).'",
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

if(isset($_POST["fecha"])){
  $eepp = new obrasDisponiblesEEPP();
  $eepp -> fecha = $_POST["fecha"];    
  $eepp -> mostrarObras();
}

	



