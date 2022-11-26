<?php

require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
session_start();

class EEPPGenerados{

 	/*=============================================
 	 MOSTRAR LA TABLA 
  	=============================================*/ 

  		
	public $mes;
	public $anno;

	public function mostrarEEPPGenerados(){

		$mes = $this->mes;	
		$anno = $this->anno;
		
			        
  		$eepp = ControladorEEPP::ctrMostrarEEPPGenerados($mes,$anno);
 		
  		if(count($eepp) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($eepp); $i++){

		  	$dateReg = date_create($eepp[$i]["fecha_corte"]);				
				$fechaCorte = date_format($dateReg,"d-m-Y");

				$dateReg = date_create($eepp[$i]["fecha_eepp"]);				
				$fechaEEPP = date_format($dateReg,"d-m-Y");


		  	$editar =  "<div class='btn-group'><button class='btn btn-primary seleccionaEEPP' idEEPP='".$eepp[$i]["idEEPP"]."', idObra='".$eepp[$i]["idObra"]."', fechaEEPP='".$eepp[$i]["fecha_corte"]."'>Editar</button></div>"; 

		  	$pdf =  "<div class='btn-group'><button class='btn btn-warning verEEPP' idEEPP='".$eepp[$i]["idEEPP"]."', idObra='".$eepp[$i]["idObra"]."'>Ver</button></div>"; 

		  	$datosJson .='[	
		  	      "'.strtoupper($eepp[$i]["constructora"]).'",
		  	      "'.strtoupper($eepp[$i]["obra"]).'",
		  	      "'.strtoupper($fechaCorte).'",
		  	      "'.strtoupper($fechaEEPP).'",
			        "'.$editar.'",
			        "'.$pdf.'"
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

if(isset($_POST["mes"])){
  $eepp = new EEPPGenerados();
  $eepp -> mes = $_POST["mes"];   
  $eepp -> anno = $_POST["anno"];   
  $eepp -> mostrarEEPPGenerados();
}

	



