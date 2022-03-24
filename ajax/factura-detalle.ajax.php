<?php

require_once "../controladores/detalle-factura.controlador.php";
require_once "../modelos/facturasDetalles.modelo.php";


class ajaxDetalleFactura{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idMarca;

	public function ajaxDetalleFactura(){

		$item = "id";
		$valor = $this->idMarca;

		$respuesta = ControladorDetalleFacturas::ctrMostrarDetalleCodigo($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarCodigo;
	

	public function ajaxValidarCodigo(){

		$item = "codigo";
		$valor = $this->validarCodigo;
		

		$respuesta = ControladorDetalleFacturas::ctrMostrarDetalleCodigo($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR
=============================================*/	
if(isset($_POST["idMarca"])){

	$Marca = new ajaxDetalleFactura();
	$Marca -> idMarca = $_POST["idMarca"];
	$Marca -> ajaxEditarMarca();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarCodigo"])){

	$validar = new ajaxDetalleFactura();
	$validar -> validarCodigo = $_POST["validarCodigo"];	
	$validar -> ajaxValidarCodigo();
}
