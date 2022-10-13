<?php

require_once "../controladores/pedidoInterno.controlador.php";
require_once "../modelos/pedidoInterno.modelo.php";
session_start();

class AjaxPedidoInterno{

	

	/*=============================================
	VALIDAR QUE NO EXISTA PEDIDOS ABIERTOS
	=============================================*/	

	public $validarNuevo;
	

	public function ajaxValidarNuevo(){

		$idSucursal = $_SESSION['idSucursalParaUsuario'];
		

		$respuesta = ControladorPedidoInterno::ctrValidarPedidoNuevo($idSucursal);

		echo json_encode($respuesta);

	}
}


/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarNuevo"])){

	$validar = new AjaxPedidoInterno();
	$validar -> validarNuevo = $_POST["validarNuevo"];	
	$validar -> ajaxValidarNuevo();
}
