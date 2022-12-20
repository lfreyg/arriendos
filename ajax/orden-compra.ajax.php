<?php

require_once "../controladores/ordenCompra.controlador.php";
require_once "../modelos/ordenCompra.modelo.php";

class AjaxOrdenCompra{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idOC;

	public function ajaxEditarOC(){

		
		$idOC = $this->idOC;
		

		$respuesta = ControladorOrdenCompra::ctrMostrarOC($idOC);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR NOMBRE OBRA
	=============================================*/	

	public $idRegistro;
	

	public function ajaxEliminarEquipoOC(){

		
		$idRegistro = $this->idRegistro;
		

		$respuesta = ModeloOrdenCompra::mdlEliminarDetalleOC($idRegistro);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR
=============================================*/	
if(isset($_POST["idOC"])){

	$categoria = new AjaxOrdenCompra();
	$categoria -> idOC = $_POST["idOC"];
	$categoria -> ajaxEditarOC();
}

/*=============================================
ELIMINAR 
=============================================*/	
if(isset($_POST["idRegistro"])){

	$eliminar = new AjaxOrdenCompra();
	$eliminar -> idRegistro = $_POST["idRegistro"];	
	$eliminar -> ajaxEliminarEquipoOC();
}
