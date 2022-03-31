<?php

require_once "../controladores/pedidoEquipo.controlador.php";
require_once "../modelos/pedidoEquipo.modelo.php";

class AjaxPedidoEquipo{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idPedido;

	public function ajaxEditarPedidoEquipo(){

		
		$valor = $this->idPedido;
		

		$respuesta = ControladorPedidoEquipo::ctrMostrarPedidoEquipoUnico($valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR NOMBRE OBRA
	=============================================*/	

	public $validarFactura;
	

	public function ajaxValidarFactura(){

		$item = "categoria";
		$valor = $this->validarCategoria;
		

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idPedido"])){

	$categoria = new AjaxPedidoEquipo();
	$categoria -> idPedido = $_POST["idPedido"];
	$categoria -> ajaxEditarPedidoEquipo();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarFactura"])){

	$validar = new AjaxFacturasCompras();
	$validar -> validarFactura = $_POST["validarFactura"];	
	$validar -> ajaxValidarFactura();
}
