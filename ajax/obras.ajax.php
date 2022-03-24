<?php

require_once "../controladores/obras.controlador.php";
require_once "../modelos/obras.modelo.php";

class AjaxObras{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idObra;

	public function ajaxEditarObra(){
	
		$item = "id";
		$valor = $this->idObra;

		$respuesta = ControladorObras::ctrMostrarObras($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR NOMBRE OBRA
	=============================================*/	

	public $validarObra;
	

	public function ajaxValidarObra(){

		$item = "nombre";
		$valor = $this->validarObra;
		

		$respuesta = ControladorObras::ctrMostrarObras($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	TRAER CONSTRUCTORAS 
	=============================================*/	

	public $idConstructora;

	public function ajaxTraerObra(){
	
		$item = "id_constructoras";
		$valor = $this->idConstructora;

		$respuesta = ControladorObras::ctrMostrarObras($item, $valor);

		echo json_encode($respuesta);

	}

	public $activarId;
	public $activar;


	public function ajaxActivar(){

		$tabla = "obras";

		$item1 = "estado";
		$valor1 = $this->activar;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloObras::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);

	}


	
}

/*=============================================
EDITAR 
=============================================*/	
if(isset($_POST["idObra"])){

	$editar = new AjaxObras();
	$editar -> idObra = $_POST["idObra"];
	$editar -> ajaxEditarObra();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarObra"])){

	$validar = new AjaxObras();
	$validar -> validarObra = $_POST["validarObra"];	
	$validar -> ajaxValidarObra();
}

/*=============================================
TRAER 
=============================================*/	
if(isset($_POST["validarObra"])){

	$validar = new AjaxObras();
	$validar -> validarObra = $_POST["validarObra"];	
	$validar -> ajaxValidarObra();
}

/*=============================================
ACTIVAR
=============================================*/	

if(isset($_POST["activarEstado"])){

	$activar = new AjaxObras();
	$activar -> activar = $_POST["activarEstado"];
	$activar -> activarId = $_POST["activarId"];
	$activar -> ajaxActivar();

}