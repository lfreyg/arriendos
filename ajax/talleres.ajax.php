<?php

require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";

class AjaxTalleres{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idTaller;

	public function ajaxEditarTaller(){

		
		$idTaller = $this->idTaller;

		$respuesta = ControladorTalleres::ctrMostrarTalleres($idTaller);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR RUT CONSTRUCTORA
	=============================================*/	

	public $rut;

	public function ajaxValidarTaller(){

		
		$rut = $this->validartaller;

		$respuesta = ControladorTalleres::ctrMostrarTallerValidar($rut);

		echo json_encode($respuesta);

	}

	public $activarId;
	public $activar;


	public function ajaxActivar(){

		$tabla = "talleres";

		$item1 = "activo";
		$valor1 = $this->activar;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloTalleres::mdlActualizarActivo($tabla, $item1, $valor1, $item2, $valor2);

	}

}	



/*=============================================
EDITAR 
=============================================*/	
if(isset($_POST["idTaller"])){

	$editar = new AjaxTalleres();
	$editar -> idTaller = $_POST["idTaller"];
	$editar -> ajaxEditarTaller();
}

/*=============================================
VALIDAR 
=============================================*/	
if(isset($_POST["validartaller"])){
	$validar = new AjaxTalleres();
	$validar -> validartaller = $_POST["validartaller"];
	$validar -> ajaxValidarTaller();
}
/*=============================================
ACTIVAR
=============================================*/	

if(isset($_POST["activarEstado"])){

	$activar = new AjaxTalleres();
	$activar -> activar = $_POST["activarEstado"];
	$activar -> activarId = $_POST["activarId"];
	$activar -> ajaxActivar();

}
