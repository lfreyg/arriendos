<?php


require_once "../modelos/cargaMasivaPrecios.modelo.php";

class AjaxCargaMasivaPrecios{

	public $eliminarConvenio;

	public function ajaxEliminarConvenio(){

		$valor = $this->eliminarConvenio;

		$respuesta = ModeloCargaMasivaPrecios::mdlEliminarPreciosObra($valor);

		echo json_encode($respuesta);
	}

	
}	

	
if(isset($_POST["eliminarConvenio"])){

	$eliminar = new AjaxCargaMasivaPrecios();
	$eliminar -> eliminarConvenio = $_POST["eliminarConvenio"];
	$eliminar -> ajaxEliminarConvenio();

}

   

