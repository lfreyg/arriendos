<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
require_once "../modelos/pedidoInternoDetalles.modelo.php";



class TablaEquiposPedidoInterno{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  		public $id_pedido;

	public function mostrarTablaEquiposPedidoInterno(){

		$id_pedido = $this->id_pedido;	

	        
  		$productos = ControladorCategorias::ctrMostrarCategorias(null,null);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

        $disable = ''; 
		  	$equipo = ModeloPedidoInternoDetalles::mdlValidaEquipoPorId($productos[$i]["id"], $id_pedido);
        
     
       if($equipo){ 
        if(count($equipo) > 0){
        	$disable = "disabled='disabled'";
        }
      }
		  			

		  	$botones =  "<div class='btn-group'><button ".$disable."class='btn btn-primary agregarEquipoPedido' idCategoria='".$productos[$i]["id"]."'>Agregar</button></div>"; 

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


  $pedidoInterno = new TablaEquiposPedidoInterno();  
  $pedidoInterno -> id_pedido = $_POST["id_pedido"];
  $pedidoInterno -> mostrarTablaEquiposPedidoInterno();


