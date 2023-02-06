<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";



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
      
  	//	$productos = ModeloEquipos::mdlMostrarEquiposPedidos($categoria);

  		$productos = ControladorCategorias::ctrMostrarCategorias(null,null);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){



		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarEquipoArriendo' idCategoria='".$productos[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[			     
			      "'.$botones.'",			     
			      "'.strtoupper($productos[$i]["categoria"]).'"			     
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


  $activarProductosVentas = new TablaEquiposPedido();  
  $activarProductosVentas -> mostrarTablaEquiposPedido();


