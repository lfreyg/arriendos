<?php


require_once "../modelos/facturacionNCND.modelo.php";

class AjaxNotaCredito{

   /*=============================================
	ELIMINAR NOTA CREDITO
	=============================================*/	

	public $idNC;
	
	public function ajaxEliminarNC(){

		
		$idNC = $this->idNC;
				

		$respuesta = ModeloFacturacionNCND::mdlEliminarNC($idNC);

		echo json_encode($respuesta);

	}

	/*=============================================
	TIMBRE NOTA CREDITO
	=============================================*/	

	public $finalizaNC;
	public $idEmpresa;

	public function ajaxTimbreNC(){

		
		$finalizaNC = $this->finalizaNC;
		$idEmpresa = $this->idEmpresa;
		

		$respuesta = ModeloFacturacionNCND::mdlTimbreNC($finalizaNC,$idEmpresa);

	
		echo json_encode($respuesta);

	}

	 /*=============================================
	QUITAR REGISTRO NC
	=============================================*/	

	public $idRegistroNC;
	
	public function ajaxQuitarRegNC(){

		
		$idRegistroNC = $this->idRegistroNC;
				

		$respuesta = ModeloFacturacionNCND::mdlQuitarRegistroNC($idRegistroNC);

		echo json_encode($respuesta);

	}

   
   public $idNCTotal;

	public function ajaxCalculaTotalNC(){

		$idNCTotal = $this->idNCTotal;

		$respuesta = ModeloFacturacionNCND::mdlTotalNC($idNCTotal);

		echo json_encode($respuesta);
	}

}


/*=============================================
ELIMINAR 
=============================================*/	
if(isset($_POST["idNC"])){

	$eliminar = new AjaxNotaCredito();
	$eliminar -> idNC = $_POST["idNC"];		
	$eliminar -> ajaxEliminarNC();
}


/*=============================================
FIRMAR NOTA CREDITO
=============================================*/	
if(isset($_POST["finalizaNC"])){

	$timbre = new AjaxNotaCredito();
	$timbre -> finalizaNC = $_POST["finalizaNC"];
	$timbre -> idEmpresa = $_POST["idEmpresa"];
	$timbre -> ajaxTimbreNC();
}

/*=============================================
QUITAR REGISTRO NC
=============================================*/	
if(isset($_POST["idRegistroNC"])){

	$quitar = new AjaxNotaCredito();
	$quitar -> idRegistroNC = $_POST["idRegistroNC"];	
	$quitar -> ajaxQuitarRegNC();
}

if(isset($_POST["idNCTotal"])){

	$total = new AjaxNotaCredito();
	$total -> idNCTotal = $_POST["idNCTotal"];
	$total -> ajaxCalculaTotalNC();

}

