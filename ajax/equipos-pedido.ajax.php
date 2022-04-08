<?php

require_once "../modelos/pedidoDetalles.modelo.php";

class AjaxEquiposPedidos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idEquipo;

	public function ajaxEditarEquiposPedido(){

		$valor = $this->idEquipo;

		$respuesta = ModeloPedidoDetalles::mdlEquipoPorId($valor);

		echo json_encode($respuesta);
	}

	
	public $eliminarEquipo;

	public function ajaxEliminarEquiposPedido(){

		$valor = $this->eliminarEquipo;

		$respuesta = ModeloPedidoDetalles::mdlEliminarEquipoPedido($valor);

		echo json_encode($respuesta);
	}

	public $finalizaPedido;

	public function ajaxFinalizaPedido(){

		$valor = $this->finalizaPedido;

		$respuesta = ModeloPedidoDetalles::mdlFinalizaPedido($valor);

		echo json_encode($respuesta);
	}

	
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idEquipo"])){

	$editar = new AjaxEquiposPedidos();
	$editar -> idEquipo = $_POST["idEquipo"];
	$editar -> ajaxEditarEquiposPedido();

}


if(isset($_POST["eliminarEquipo"])){

	$eliminar = new AjaxEquiposPedidos();
	$eliminar -> eliminarEquipo = $_POST["eliminarEquipo"];
	$eliminar -> ajaxEliminarEquiposPedido();

}

if(isset($_POST["finalizaPedido"])){

	$eliminar = new AjaxEquiposPedidos();
	$eliminar -> finalizaPedido = $_POST["finalizaPedido"];
	$eliminar -> ajaxFinalizaPedido();

}

   

