<?php

require_once "../modelos/pedidoDetalles.modelo.php";
require_once "../modelos/guiaDespachoDetalles.modelo.php";
require_once "../modelos/equipos.modelo.php";

class AjaxEquiposGuiaArriendos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idEquipo;

	public function ajaxEditarEquiposGuiaArriendo(){

		$valor = $this->idEquipo;

		$respuesta = ModeloPedidoDetalles::mdlEquipoPorId($valor);

		echo json_encode($respuesta);
	}

	
	public $idRegistroDetalle;
	public $idEquipoDetalle;

	public function ajaxEliminarEquiposGuiaArriendo(){

		$idRegistroDetalle = $this->idRegistroDetalle;
		$idEquipoDetalle = $this->idEquipoDetalle;

		$respuesta = ModeloGuiaDespachoDetalles::mdlEliminarEquipoGuiaDespacho($idRegistroDetalle,$idEquipoDetalle);

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
if(isset($_POST["idEquipo"])){

	$editar = new AjaxEquiposGuiaArriendos();
	$editar -> idEquipo = $_POST["idEquipo"];
	$editar -> ajaxEditarEquiposGuiaArriendo();

}


if(isset($_POST["idRegistroDetalle"]) && isset($_POST["idEquipoDetalle"])){

	$eliminar = new AjaxEquiposGuiaArriendos();
	$eliminar -> idRegistroDetalle = $_POST["idRegistroDetalle"];
	$eliminar -> idEquipoDetalle = $_POST["idEquipoDetalle"];
	$eliminar -> ajaxEliminarEquiposGuiaArriendo();

}

if(isset($_POST["finalizaGuia"]) && isset($_POST["idEmpresa"])){

	$finalizar = new AjaxEquiposGuiaArriendos();
	$finalizar -> finalizaGuia = $_POST["finalizaGuia"];
	$finalizar -> idEmpresa = $_POST["idEmpresa"];
	$finalizar -> ajaxFinalizaGuiaArriendo();

}

if(isset($_POST["idEquipoParaArriendo"])){

	$arrendar = new AjaxEquiposGuiaArriendos();
	$arrendar -> idEquipoParaArriendo = $_POST["idEquipoParaArriendo"];
	$arrendar -> ajaxSeleccionaEquipo();

}

if(isset($_POST["idTipoEquipo"]) && isset($_POST['idObra'])){

	$precio = new AjaxEquiposGuiaArriendos();
	$precio -> idTipoEquipo = $_POST["idTipoEquipo"];
	$precio -> idObra = $_POST["idObra"];
	$precio -> ajaxBuscaPrecioConvenio();

}

   

