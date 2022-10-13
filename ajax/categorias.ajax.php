<?php

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
session_start();

class AjaxCategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR NOMBRE OBRA
	=============================================*/	

	public $validarCategoria;
	

	public function ajaxValidarCategoria(){

		$item = "categoria";
		$valor = $this->validarCategoria;
		

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	public $categoriaStock;	
	public $idSucursal;

	public function ajaxCategoriaStock(){

		
		$idCategoria = $this->categoriaStock;		
		$idSucursal = $this->idSucursal;

		$respuesta = ControladorCategorias::ctrMostrarStockCategorias($idCategoria,$idSucursal);

		
		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarCategoria"])){

	$validar = new AjaxCategorias();
	$validar -> validarCategoria = $_POST["validarCategoria"];	
	$validar -> ajaxValidarCategoria();
}

/*=============================================
OBTIENE STOCK 
=============================================*/	
if(isset($_POST["categoriaStock"])){

	$validar = new AjaxCategorias();
	$validar -> categoriaStock = $_POST["categoriaStock"];	
	$validar -> idSucursal = $_POST["idSucursal"];
	$validar -> ajaxCategoriaStock();
}
