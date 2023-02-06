<?php

require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/facturacionOC.modelo.php";

class AjaxFacturacionDetalle{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idFactura;

	public function ajaxEditarFactura(){

		
		$idFactura = $this->idFactura;
		

		$respuesta = ModeloFacturacionEEPP::obtenerDatosFactura($idFactura);

		echo json_encode($respuesta);

	}

	/*=============================================
	ELIMINAR EEPP SELECCIONADO
	=============================================*/	

	public $idRegistro;
	public $idEEPPElimina;
	public $idFacturaQuitar;

	public function ajaxEliminarEEPPFactura(){

		
		$idRegistro = $this->idRegistro;
		$idEEPPElimina = $this->idEEPPElimina;
		$idFacturaQuitar = $this->idFacturaQuitar;
		

		$respuesta = ModeloFacturacionEEPP::mdlEliminarEEPPSeleccionado($idRegistro, $idEEPPElimina, $idFacturaQuitar);

		echo json_encode($respuesta);

	}


	/*=============================================
	EDITAR ITEM FACTURA 
	=============================================*/	

	public $idRegistroSII;

	public function ajaxEditarRegistroSII(){

		
		$idRegistroSII = $this->idRegistroSII;
		

		$respuesta = ModeloFacturacionEEPP::mdlTraerRegistroFacturaSII($idRegistroSII);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR ITEM FACTURA 
	=============================================*/	

	public $idFacturaObtener;

	public function ajaxTotalFactura(){

		
		$idFacturaObtener = $this->idFacturaObtener;
		

		$respuesta = ModeloFacturacionEEPP::mdlObtenerTotalFactura($idFacturaObtener);

		$total = $respuesta["totalFactura"];

		ModeloFacturacionEEPP::mdlActualizaTotalNeto($idFacturaObtener, $total);

	
		echo json_encode($respuesta);

	}

	/*=============================================
	ELIMINAR FACTURA COMPLETA SIN OC
	=============================================*/	

	public $idFacturaEliminar;

	public function ajaxEliminarFacturaTotal(){

		
		$idFacturaEliminar = $this->idFacturaEliminar;
		

		$respuesta = ModeloFacturacionEEPPOC::mdlEliminaFacturacion($idFacturaEliminar);

	
		echo json_encode($respuesta);

	}

	/*=============================================
	ELIMINAR FACTURA COMPLETA OC
	=============================================*/	

	public $idFacturaEliminarOC;

	public function ajaxEliminarFacturaTotalOC(){

		
		$idFacturaEliminarOC = $this->idFacturaEliminarOC;
		

		$respuesta = ModeloFacturacionEEPPOC::mdlEliminaFacturacionOC($idFacturaEliminarOC);

	
		echo json_encode($respuesta);

	}

	/*=============================================
	TIMBRE FACTURA OC
	=============================================*/	

	public $finalizaFactura;
	public $idEmpresa;

	public function ajaxTimbreFactura(){

		
		$finalizaFactura = $this->finalizaFactura;
		$idEmpresa = $this->idEmpresa;
		

		$respuesta = ModeloFacturacionEEPP::mdlFinalizaFactura($finalizaFactura,$idEmpresa);

	
		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR
=============================================*/	
if(isset($_POST["idFactura"])){

	$categoria = new AjaxFacturacionDetalle();
	$categoria -> idFactura = $_POST["idFactura"];
	$categoria -> ajaxEditarFactura();
}

/*=============================================
ELIMINAR 
=============================================*/	
if(isset($_POST["idRegistro"])){

	$eliminar = new AjaxFacturacionDetalle();
	$eliminar -> idRegistro = $_POST["idRegistro"];	
	$eliminar -> idEEPPElimina = $_POST["idEEPPElimina"];
	$eliminar -> idFacturaQuitar = $_POST["idFacturaQuitar"];
	$eliminar -> ajaxEliminarEEPPFactura();
}

/*=============================================
EDITAR REGISTRO TABLA FACTURA SII
=============================================*/	
if(isset($_POST["idRegistroSII"])){

	$categoria = new AjaxFacturacionDetalle();
	$categoria -> idRegistroSII = $_POST["idRegistroSII"];
	$categoria -> ajaxEditarRegistroSII();
}

/*=============================================
TRAE TOTAL EEPP Y TOTAL FACTURADO
=============================================*/	
if(isset($_POST["idFacturaObtener"])){

	$categoria = new AjaxFacturacionDetalle();
	$categoria -> idFacturaObtener = $_POST["idFacturaObtener"];
	$categoria -> ajaxTotalFactura();
}
/*=============================================
ELIMINAR FACTURA
=============================================*/	
if(isset($_POST["idFacturaEliminar"])){

	$eliminar = new AjaxFacturacionDetalle();
	$eliminar -> idFacturaEliminar = $_POST["idFacturaEliminar"];
	$eliminar -> ajaxEliminarFacturaTotal();
}

/*=============================================
ELIMINAR FACTURA ORDEN COMPRA
=============================================*/	
if(isset($_POST["idFacturaEliminarOC"])){

	$eliminar = new AjaxFacturacionDetalle();
	$eliminar -> idFacturaEliminarOC = $_POST["idFacturaEliminarOC"];
	$eliminar -> ajaxEliminarFacturaTotalOC();
}
/*=============================================
FIRMAR FACTURA
=============================================*/	
if(isset($_POST["finalizaFactura"])){

	$timbre = new AjaxFacturacionDetalle();
	$timbre -> finalizaFactura = $_POST["finalizaFactura"];
	$timbre -> idEmpresa = $_POST["idEmpresa"];
	$timbre -> ajaxTimbreFactura();
}