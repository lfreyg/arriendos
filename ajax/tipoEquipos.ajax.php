<?php

require_once "../controladores/tipoEquipos.controlador.php";
require_once "../modelos/tipoEquipos.modelo.php";

class AjaxTipoEquipos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idTipoEquipo;

	public function ajaxEditarTipoEquipos(){

		$item = "id";
		$valor = $this->idTipoEquipo;

		$respuesta = ControladorTipoEquipos::ctrMostrarTipoEquipo($item, $valor);

		echo json_encode($respuesta);
	}

	public $activarId;
	public $activarTipo;


	public function ajaxActivarTipo(){

		$tabla = "nombre_equipos";

		$item1 = "estado";
		$valor1 = $this->activarTipo;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloTipoEquipos::mdlActualizarTipo($tabla, $item1, $valor1, $item2, $valor2);

	}

}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idTipoEquipo"])){

	$editar = new AjaxTipoEquipos();
	$editar -> idTipoEquipo = $_POST["idTipoEquipo"];
	$editar -> ajaxEditarTipoEquipos();

}

/*=============================================
ACTIVAR
=============================================*/	

if(isset($_POST["activarTipo"])){

	$activar = new AjaxTipoEquipos();
	$activar -> activarTipo = $_POST["activarTipo"];
	$activar -> activarId = $_POST["activarId"];
	$activar -> ajaxActivarTipo();

}

    

