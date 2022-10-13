<?php

require_once "../modelos/pedidoInternoDetalles.modelo.php";

class AjaxEquiposPedidosInterno{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idEquipo;

	public function ajaxEditarEquiposPedidoInterno(){

		$valor = $this->idEquipo;

		$respuesta = ModeloPedidoInternoDetalles::mdlMiEquipoPorId($valor);

		echo json_encode($respuesta);
	}

	
	public $eliminarEquipo;

	public function ajaxEliminarEquiposPedidoInterno(){

		$valor = $this->eliminarEquipo;

		$respuesta = ModeloPedidoInternoDetalles::mdlEliminarEquipoPedidoInterno($valor);

		echo json_encode($respuesta);
	}

	public $finalizaPedido;

	public function ajaxFinalizaPedidoInterno(){

		$valor = $this->finalizaPedido;

		$respuesta = ModeloPedidoInternoDetalles::mdlFinalizaPedidoInterno($valor);

		echo json_encode($respuesta);
	}

	
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idEquipo"])){

	$editar = new AjaxEquiposPedidosInterno();
	$editar -> idEquipo = $_POST["idEquipo"];
	$editar -> ajaxEditarEquiposPedidoInterno();

}


if(isset($_POST["eliminarEquipo"])){

	$eliminar = new AjaxEquiposPedidosInterno();
	$eliminar -> eliminarEquipo = $_POST["eliminarEquipo"];
	$eliminar -> ajaxEliminarEquiposPedidoInterno();

}

if(isset($_POST["finalizaPedido"])){

	$eliminar = new AjaxEquiposPedidosInterno();
	$eliminar -> finalizaPedido = $_POST["finalizaPedido"];
	$eliminar -> ajaxFinalizaPedidoInterno();

}

   

