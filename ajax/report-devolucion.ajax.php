<?php

require_once "../controladores/reportDevolucion.controlador.php";
require_once "../modelos/reportDevolucion.modelo.php";

class AjaxReportDevolucion{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idReport;

	public function ajaxEditarReport(){

		
		$idReport = $this->idReport;
		

		$respuesta = ControladorReportDevolucion::ctrMostrarReportDevolucionUnico($idReport);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idReport"])){

	$categoria = new AjaxReportDevolucion();
	$categoria -> idReport = $_POST["idReport"];
	$categoria -> ajaxEditarReport();
}

