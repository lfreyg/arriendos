<?php

require_once "../modelos/pedidoInternoDetalles.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";



class TablaEquiposDespachoPedidoInterno{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

  		public $id_pedido;

	public function mostrarTablaEquiposDespachoPedidoInterno(){

		$id_pedido = $this->id_pedido;	

	     $productos = ModeloPedidoInternoDetalles::mdlPedidoInternoPorId($id_pedido);   
  	
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		 foreach ($productos as $key => $value){

           $disable = '';

           $idPedidoDetalle = $value["id"];

           $despachado = ModeloPedidoInternoDetalles::mdlEquipoPedidoInternoDespachado($idPedidoDetalle);  
            
           $cantidadDespacha = $despachado['despachado'];

           $idCategoria = $value["idCategoria"];
           $equipo = $value["categoria"];
           $cantidad = $value["cantidad"];
           $detalle = $value["detalle"];
           $stock = $value["stock"];
           $repara = $value["revision"];
           $tengo = $value["tengo"];
           
           $porDespachar = $cantidad - $cantidadDespacha;

           if($porDespachar == 0){
           	 $disable = 'disabled';
           }


		  	$datosJson .='[		
			      "'.strtoupper($equipo).'",
			       "'.$stock.'",
			      "'.$cantidad.'",
			      "'.$porDespachar.'"
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


  $pedidoInterno = new TablaEquiposDespachoPedidoInterno();  
  $pedidoInterno -> id_pedido = $_POST["id_pedido"];
  $pedidoInterno -> mostrarTablaEquiposDespachoPedidoInterno();


