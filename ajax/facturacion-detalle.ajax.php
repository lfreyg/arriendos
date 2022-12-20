<?php

require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";

class AjaxFacturacionDetalle{

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
	public $idEEPPElimina;

	public function ajaxEliminarEEPPFactura(){

		
		$idRegistro = $this->idRegistro;
		$idEEPPElimina = $this->idEEPPElimina;
		

		$respuesta = ModeloFacturacionEEPP::mdlEliminarEEPPSeleccionado($idRegistro,$idEEPPElimina);

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

	
		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR
=============================================*/	
if(isset($_POST["idOC"])){

	$categoria = new AjaxFacturacionDetalle();
	$categoria -> idOC = $_POST["idOC"];
	$categoria -> ajaxEditarOC();
}

/*=============================================
ELIMINAR 
=============================================*/	
if(isset($_POST["idRegistro"])){

	$eliminar = new AjaxFacturacionDetalle();
	$eliminar -> idRegistro = $_POST["idRegistro"];	
	$eliminar -> idEEPPElimina = $_POST["idEEPPElimina"];
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