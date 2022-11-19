<?php

require_once "../modelos/pedidoDetalles.modelo.php";
require_once "../modelos/guiaDespachoDetalles.modelo.php";
require_once "../modelos/materiales.modelo.php";

class AjaxMaterialesGuiaArriendos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idRegistroMaterialGuia;

	public function ajaxEditarMaterialGuiaArriendo(){

		$idRegistroMaterialGuia = $this->idRegistroMaterialGuia;

		$respuesta = ModeloGuiaDespachoDetalles::mdlEditarMaterialesGuia($idRegistroMaterialGuia);

		echo json_encode($respuesta);
	}

	
	public $idRegistroGuia;
	public $idMaterial;	
	public $numeroGuiaDespacho;
	

	public function ajaxEliminarMaterialGuiaArriendo(){

		$idRegistroGuia = $this->idRegistroGuia;
		$idMaterial = $this->idMaterial;
		$numeroGuiaDespacho = $this->numeroGuiaDespacho;

		$materiales = ModeloGuiaDespachoDetalles::mdlEditarMaterialesGuia($idRegistroGuia);


        $cantidadDescontar = $materiales["cantidad"];

      
		$respuesta = ModeloGuiaDespachoDetalles::mdlEliminarMaterialGuiaDespacho($idRegistroGuia,$idMaterial,$numeroGuiaDespacho,$cantidadDescontar);

		echo json_encode($respuesta);
	}

	

	public $idMaterialArriendo;

	public function ajaxSeleccionaMaterial(){

		$id = $this->idMaterialArriendo;

		$respuesta = ModeloMateriales::mdlSeleccionaMaterial($id);

		echo json_encode($respuesta);
	}



	
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idRegistroMaterialGuia"])){

	$editar = new AjaxMaterialesGuiaArriendos();
	$editar -> idRegistroMaterialGuia = $_POST["idRegistroMaterialGuia"];
	$editar -> ajaxEditarMaterialGuiaArriendo();

}


if(isset($_POST["idRegistroGuia"]) && isset($_POST["idMaterial"])){

	$eliminar = new AjaxMaterialesGuiaArriendos();
	$eliminar -> idRegistroGuia = $_POST["idRegistroGuia"];
	$eliminar -> idMaterial = $_POST["idMaterial"];	
	$eliminar -> numeroGuiaDespacho = $_POST["numeroGuiaDespacho"];		
	$eliminar -> ajaxEliminarMaterialGuiaArriendo();

}


if(isset($_POST["idMaterialArriendo"])){

	$arrendar = new AjaxMaterialesGuiaArriendos();
	$arrendar -> idMaterialArriendo = $_POST["idMaterialArriendo"];
	$arrendar -> ajaxSeleccionaMaterial();

}



   

