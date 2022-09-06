<?php

require_once "../controladores/transportista.controlador.php";
require_once "../modelos/transportista.modelo.php";

class AjaxTransportista{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idtransportista;

	public function ajaxEditarTransportista(){

		$item = "id";
		$valor = $this->idtransportista;

		$respuesta = ControladorTransportistas::ctrMostrarTransportista($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR RUT CHOFER
	=============================================*/	

	public $validarTransportista;

	public function ajaxValidarTransportista(){

		$item = "rut";
		$valor = $this->validarTransportista;

		$respuesta = ControladorTransportistas::ctrMostrarTransportistaValidar($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR RUT EMPRESA
	=============================================*/	

	public $validarEmpresa;

	public function ajaxValidarEmpresa(){

		
		$rut = $this->validarEmpresa;

		$respuesta = ControladorTransportistas::ctrValidarEmpresaTransporte($rut);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/	
if(isset($_POST["idtransportista"])){

	$editar = new AjaxTransportista();
	$editar -> idtransportista = $_POST["idtransportista"];
	$editar -> ajaxEditarTransportista();
}

/*=============================================
VALIDAR RUT TRANSPORTISTA
=============================================*/	
if(isset($_POST["validarTransportista"])){

	$validar = new AjaxTransportista();
	$validar -> validarTransportista = $_POST["validarTransportista"];
	$validar -> ajaxValidarTransportista();
}

/*=============================================
VALIDAR EMPRESA
=============================================*/	
if(isset($_POST["validarEmpresa"])){

	$validar = new AjaxTransportista();
	$validar -> validarEmpresa = $_POST["validarEmpresa"];
	$validar -> ajaxValidarEmpresa();
}
