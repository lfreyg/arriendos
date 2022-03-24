<?php

require_once "../controladores/sucursales.controlador.php";
require_once "../modelos/sucursales.modelo.php";

class AjaxSucursales{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idSucursal;

	public function ajaxEditarSucursal(){

		$item = "id";
		$valor = $this->idSucursal;

		$respuesta = ControladorSucursales::ctrMostrarSucursales($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/	
if(isset($_POST["idSucursal"])){

	$editar = new AjaxSucursales();
	$editar -> idSucursal = $_POST["idSucursal"];
	$editar -> ajaxEditarSucursal();
}
