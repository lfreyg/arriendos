<?php

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";


class AjaxMarcas{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idMarca;

	public function ajaxEditarMarca(){

		$item = "id";
		$valor = $this->idMarca;

		$respuesta = ControladorMarcas::ctrMostrarMarcas($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarMarca;
	

	public function ajaxValidarMarca(){

		$item = "descripcion";
		$valor = $this->validarMarca;
		

		$respuesta = ControladorMarcas::ctrMostrarMarcas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR
=============================================*/	
if(isset($_POST["idMarca"])){

	$Marca = new AjaxMarcas();
	$Marca -> idMarca = $_POST["idMarca"];
	$Marca -> ajaxEditarMarca();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarMarca"])){

	$validar = new AjaxMarcas();
	$validar -> validarMarca = $_POST["validarMarca"];	
	$validar -> ajaxValidarMarca();
}
