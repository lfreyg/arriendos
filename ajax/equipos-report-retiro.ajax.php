<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";
require_once "../modelos/guiaDespachoDetalles.modelo.php";
require_once "../modelos/equipos.modelo.php";

class AjaxEquiposReportRetiro{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idArriendo;

	public function ajaxEditarEquiposRetiro(){

		$idArriendo = $this->idArriendo;

		$respuesta = ModeloReportDevolucionDetalles::mdlEquipoRetiradoPorId($idArriendo);

		echo json_encode($respuesta);
	}

	
	public $idRegistroDetalle;
	public $idEquipoDetalle;

	public function ajaxEliminarEquiposRetiro(){

		$idRegistroDetalle = $this->idRegistroDetalle;
		$idEquipoDetalle = $this->idEquipoDetalle;

		$respuesta = ModeloReportDevolucionDetalles::mdlEliminarEquipoRetiro($idRegistroDetalle,$idEquipoDetalle);

		echo json_encode($respuesta);
	}



	public $idReport;	

	public function ajaxFinalizaReportRetiro(){

		$idReport = $this->idReport;
		

		$respuesta = ModeloReportDevolucionDetalles::mdlFinalizarReport($idReport);

		echo json_encode($respuesta);
	}

	public $idRegistroTermino;
	public $idRegistroCambio;
	public $contrato;	

	public function ajaxRealizaCambioEquipo(){

		$idRegistroTermino = $this->idRegistroTermino;
		$idRegistroCambio = $this->idRegistroCambio;
		$contrato = $this->contrato;

		$respuesta = ModeloReportDevolucionDetalles::mdlHaceMatchCambioEquipo($idRegistroTermino,$idRegistroCambio,$contrato);

		echo json_encode($respuesta);
	}

	public function ajaxQuitarCambioEquipo(){

		$idRegistroTermino2 = $this->idRegistroTermino2;		
		

		$respuesta = ModeloReportDevolucionDetalles::mdlQuitarCambioEquipo($idRegistroTermino2);

		echo json_encode($respuesta);
	}

	
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idArriendo"])){

	$editar = new AjaxEquiposReportRetiro();
	$editar -> idArriendo = $_POST["idArriendo"];
	$editar -> ajaxEditarEquiposRetiro();

}


if(isset($_POST["idRegistroDetalle"]) && isset($_POST["idEquipoDetalle"])){

	$eliminar = new AjaxEquiposReportRetiro();
	$eliminar -> idRegistroDetalle = $_POST["idRegistroDetalle"];
	$eliminar -> idEquipoDetalle = $_POST["idEquipoDetalle"];
	$eliminar -> ajaxEliminarEquiposRetiro();

}

if(isset($_POST["idReport"])){

	$finalizar = new AjaxEquiposReportRetiro();
	$finalizar -> idReport = $_POST["idReport"];	
	$finalizar -> ajaxFinalizaReportRetiro();

}

if(isset($_POST["idRegistroTermino"]) && isset($_POST["idRegistroCambio"]) && isset($_POST["contrato"])){

	$cambia = new AjaxEquiposReportRetiro();
	$cambia -> idRegistroTermino = $_POST["idRegistroTermino"];
	$cambia -> idRegistroCambio = $_POST["idRegistroCambio"];
	$cambia -> contrato = $_POST["contrato"];
	$cambia -> ajaxRealizaCambioEquipo();

}

if(isset($_POST["idRegistroTermino2"])){

	$quitar = new AjaxEquiposReportRetiro();
	$quitar -> idRegistroTermino2 = $_POST["idRegistroTermino2"];		
	$quitar -> ajaxQuitarCambioEquipo();

}



   

