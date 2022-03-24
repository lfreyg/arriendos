<?php

require_once "../controladores/constructoras.controlador.php";
require_once "../modelos/constructoras.modelo.php";

class AjaxConstructoras{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idConstructora;

	public function ajaxEditarConstructora(){

		$item = "id";
		$valor = $this->idConstructora;

		$respuesta = ControladorConstructoras::ctrMostrarConstructoras($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR RUT CONSTRUCTORA
	=============================================*/	

	public $validarConstructora;

	public function ajaxValidarConstructora(){

		$item = "rut";
		$valor = $this->validarConstructora;

		$respuesta = ControladorConstructoras::ctrMostrarConstructorasValidar($item, $valor);

		echo json_encode($respuesta);

	}

	public $activarId;
	public $activar;


	public function ajaxActivar(){

		$tabla = "constructoras";

		$item1 = "estado";
		$valor1 = $this->activar;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloConstructoras::mdlActualizar($tabla, $item1, $valor1, $item2, $valor2);

	}

}	



/*=============================================
EDITAR 
=============================================*/	
if(isset($_POST["idConstructora"])){

	$editar = new AjaxConstructoras();
	$editar -> idConstructora = $_POST["idConstructora"];
	$editar -> ajaxEditarConstructora();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validarConstructora"])){
	$validar = new AjaxConstructoras();
	$validar -> validarConstructora = $_POST["validarConstructora"];
	$validar -> ajaxValidarConstructora();
}
/*=============================================
ACTIVAR
=============================================*/	

if(isset($_POST["activarEstado"])){

	$activar = new AjaxConstructoras();
	$activar -> activar = $_POST["activarEstado"];
	$activar -> activarId = $_POST["activarId"];
	$activar -> ajaxActivar();

}
