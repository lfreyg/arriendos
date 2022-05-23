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

	public $finalizaGuia;
	public $idEmpresa;

	public function ajaxFinalizaGuiaArriendo(){

		$idGuia = $this->finalizaGuia;
		$idEmpresa = $this->idEmpresa;

		$respuesta = ModeloGuiaDespachoDetalles::mdlFinalizaGuia($idGuia,$idEmpresa);

		echo json_encode($respuesta);
	}


	public $idEquipoParaArriendo;

	public function ajaxSeleccionaEquipo(){

		$valor = $this->idEquipoParaArriendo;

		$respuesta = ModeloEquipos::mdlSeleccionarEquiposGuiaDespacho($valor);

		echo json_encode($respuesta);
	}


	public $idTipoEquipo;
	public $idObra;

	public function ajaxBuscaPrecioConvenio(){

		$idTipoEquipo = $this->idTipoEquipo;
		$idObra = $this->idObra;

		$respuesta = ModeloEquipos::mdlBuscaPrecioConvenio($idTipoEquipo,$idObra);

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

if(isset($_POST["finalizaGuia"]) && isset($_POST["idEmpresa"])){

	$finalizar = new AjaxEquiposReportRetiro();
	$finalizar -> finalizaGuia = $_POST["finalizaGuia"];
	$finalizar -> idEmpresa = $_POST["idEmpresa"];
	$finalizar -> ajaxFinalizaGuiaArriendo();

}

if(isset($_POST["idEquipoParaArriendo"])){

	$arrendar = new AjaxEquiposReportRetiro();
	$arrendar -> idEquipoParaArriendo = $_POST["idEquipoParaArriendo"];
	$arrendar -> ajaxSeleccionaEquipo();

}

if(isset($_POST["idTipoEquipo"]) && isset($_POST['idObra'])){

	$precio = new AjaxEquiposReportRetiro();
	$precio -> idTipoEquipo = $_POST["idTipoEquipo"];
	$precio -> idObra = $_POST["idObra"];
	$precio -> ajaxBuscaPrecioConvenio();

}

   

