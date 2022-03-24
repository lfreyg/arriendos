<?php

require_once "../controladores/facturasCompra.controlador.php";
require_once "../modelos/facturasCompra.modelo.php";

class AjaxFacturasCompras{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idFactura;

	public function ajaxEditarFactura(){

		$item = "id";
		$valor = $this->idFactura;
		$orden = "id";

		$respuesta = ControladorFacturasCompra::ctrMostrarFacturasCompra($item, $valor);

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
if(isset($_POST["idFactura"])){

	$categoria = new AjaxFacturasCompras();
	$categoria -> idFactura = $_POST["idFactura"];
	$categoria -> ajaxEditarFactura();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarFactura"])){

	$validar = new AjaxFacturasCompras();
	$validar -> validarFactura = $_POST["validarFactura"];	
	$validar -> ajaxValidarFactura();
}
