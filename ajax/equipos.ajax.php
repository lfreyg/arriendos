<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class AjaxEquipos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idEquipo;

	public function ajaxEditarEquipos(){

		$item = "id";
		$valor = $this->idEquipo;

		$respuesta = ControladorEquipos::ctrMostrarEquipo($item, $valor);

		echo json_encode($respuesta);
	}

	public $codigo;

	public function ajaxValidarEquipos(){

		$valor = $this->codigo;

		$respuesta = ControladorEquipos::ctrValidarEquipos($valor);

		echo json_encode($respuesta);
	}

	public $eliminarEquipo;

	public function ajaxEliminarEquipos(){

		$valor = $this->eliminarEquipo;

		$respuesta = ModeloEquipos::mdlBorrarEquipos($valor);

		echo json_encode($respuesta);
	}

	
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idEquipo"])){

	$editar = new AjaxEquipos();
	$editar -> idEquipo = $_POST["idEquipo"];
	$editar -> ajaxEditarEquipos();

}

if(isset($_POST["validarCodigo"])){

	$editar = new AjaxEquipos();
	$editar -> codigo = $_POST["validarCodigo"];
	$editar -> ajaxValidarEquipos();

}

if(isset($_POST["eliminarEquipo"])){

	$eliminar = new AjaxEquipos();
	$eliminar -> eliminarEquipo = $_POST["eliminarEquipo"];
	$eliminar -> ajaxEliminarEquipos();

}

   

