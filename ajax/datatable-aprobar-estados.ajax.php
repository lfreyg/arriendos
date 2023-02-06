<?php


require_once "../modelos/equipos.modelo.php";

class TablaApruebaEstados{

 	
  	
	public function mostrarTablaAprueba(){

	  
       $idEstado = 32;
            
  		
     $estados = ModeloEquipos::mdlEstadosAprobar($idEstado);


 		
  		if(count($estados) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($x = 0; $x < count($estados); $x++){

		         $idLog = $estados[$x]["idLog"]; 
             $idEquipo = $estados[$x]["idEquipo"]; 
             $idEstadoAnterior = $estados[$x]["id_estado_anterior"]; 
             $idEstadoSolicitado = $estados[$x]["id_nuevo_estado"];   

             $codigo = $estados[$x]["codigo"];         
             $descripcion = $estados[$x]["descripcion"].' '.$estados[$x]["modelo"].' '.$estados[$x]["marca"];
             $estadoActual = $estados[$x]["estadoAnterior"];
             $estadoSolicitado = $estados[$x]["estadoSolicitado"];
             $motivo = $estados[$x]["motivo"];
             $solicitante = $estados[$x]["usuario"];
             $fechaCambio = $estados[$x]["fecha_cambio"];
             $fechaReal = $estados[$x]["fecha_real"];

             $dateReg = date_create($fechaReal);				
				     $fechaReal = date_format($dateReg,"d-m-Y H:i:s");

		  	
        
         $botones =  "<div class='btn-group'><button class='btn btn-success btnAprobar' id='".$estados[$x]["idLog"]."', idEstado='".$idEstadoSolicitado."', idEquipo='".$idEquipo."', idEstadoAnterior='".$idEstadoAnterior."'><i class='fa fa-thumbs-o-up'></i></button></div>";

         $botones2 =  "<div class='btn-group'><button class='btn btn-danger btnRechazar' id='".$estados[$x]["idLog"]."', idEstado='".$idEstadoAnterior."', idEquipo='".$idEquipo."'><i class='fa fa-times'></i></button></div>";

		  	
		  	$datosJson .='[      
			      "'.$codigo.'",	
			      "'.$descripcion.'",			      
			      "'.$estadoActual.'",	
			      "'.$estadoSolicitado.'",		
			      "'.$fechaReal.'",	
			      "'.$motivo.'",
			      "'.$solicitante.'",	     	     		     
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


  $activarProductosVentas = new TablaApruebaEstados();    
  $activarProductosVentas -> mostrarTablaAprueba();


