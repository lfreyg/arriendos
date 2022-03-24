<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idProveedor;

	public function ajaxEditarProveedor(){

		$item = "id";
		$valor = $this->idProveedor;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR RUT PROVEEDOR
	=============================================*/	

	public $validarProveedor;

	public function ajaxValidarProveedor(){

		$item = "rut";
		$valor = $this->validarProveedor;

		$respuesta = ControladorProveedores::ctrMostrarProveedoresValidar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/	
if(isset($_POST["idProveedor"])){

	$editar = new AjaxProveedores();
	$editar -> idProveedor = $_POST["idProveedor"];
	$editar -> ajaxEditarProveedor();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarProveedor"])){

	$validar = new AjaxProveedores();
	$validar -> validarProveedor = $_POST["validarProveedor"];
	$validar -> ajaxValidarProveedor();
}
