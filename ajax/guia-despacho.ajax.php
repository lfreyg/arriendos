<?php

require_once "../controladores/guiaDespacho.controlador.php";
require_once "../modelos/guiaDespacho.modelo.php";

class AjaxGuiaDespacho{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idGuia;

	public function ajaxEditarguiaDespacho(){

		
		$valor = $this->idGuia;
		

		$respuesta = ControladorGuiaDespacho::ctrMostrarGuiaDespachoUnico($valor);

		echo json_encode($respuesta);

	}

	
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idGuia"])){

	$categoria = new AjaxguiaDespacho();
	$categoria -> idGuia = $_POST["idGuia"];
	$categoria -> ajaxEditarguiaDespacho();
}

