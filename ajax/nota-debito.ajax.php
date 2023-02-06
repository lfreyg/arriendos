<?php


require_once "../modelos/facturacionNCND.modelo.php";

class AjaxNotaDebito{

   /*=============================================
	ELIMINAR NOTA CREDITO
	=============================================*/	

	public $idND;
	
	public function ajaxEliminarND(){

		
		$idND = $this->idND;
				

		$respuesta = ModeloFacturacionNCND::mdlEliminarND($idND);

		echo json_encode($respuesta);

	}

	/*=============================================
	TIMBRE NOTA CREDITO
	=============================================*/	

	public $finalizaND;
	public $idEmpresa;

	public function ajaxTimbreND(){

		
		$finalizaND = $this->finalizaND;
		$idEmpresa = $this->idEmpresa;
		

		$respuesta = ModeloFacturacionNCND::mdlTimbreND($finalizaND,$idEmpresa);

	
		echo json_encode($respuesta);

	}


	public $idNDTotal;

	public function ajaxCalculaTotalND(){

		$idNDTotal = $this->idNDTotal;

		$respuesta = ModeloFacturacionNCND::mdlTotalND($idNDTotal);

		echo json_encode($respuesta);
	}

   
   	 /*=============================================
	QUITAR REGISTRO ND
	=============================================*/	

	public $idRegistroND;
	
	public function ajaxQuitarRegND(){

		
		$idRegistroND = $this->idRegistroND;
				

		$respuesta = ModeloFacturacionNCND::mdlQuitarRegistroND($idRegistroND);

		echo json_encode($respuesta);

	}


}


/*=============================================
ELIMINAR 
=============================================*/	
if(isset($_POST["idND"])){

	$eliminar = new AjaxNotaDebito();
	$eliminar -> idND = $_POST["idND"];		
	$eliminar -> ajaxEliminarND();
}


/*=============================================
FIRMAR NOTA CREDITO
=============================================*/	
if(isset($_POST["finalizaND"])){

	$timbre = new AjaxNotaDebito();
	$timbre -> finalizaND = $_POST["finalizaND"];
	$timbre -> idEmpresa = $_POST["idEmpresa"];
	$timbre -> ajaxTimbreND();
}

if(isset($_POST["idNDTotal"])){

	$total = new AjaxNotaDebito();
	$total -> idNDTotal = $_POST["idNDTotal"];
	$total -> ajaxCalculaTotalND();

}


/*=============================================
QUITAR REGISTRO ND
=============================================*/	
if(isset($_POST["idRegistroND"])){

	$quitar = new AjaxNotaDebito();
	$quitar -> idRegistroND = $_POST["idRegistroND"];	
	$quitar -> ajaxQuitarRegND();
}


