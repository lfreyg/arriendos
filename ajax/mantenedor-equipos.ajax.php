<?php


require_once "../modelos/equipos.modelo.php";

class AjaxMantenedorEquipos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idEquipo;

	public function ajaxEditarEquipos(){
		
		$valor = $this->idEquipo;

		$respuesta = ModeloEquipos::mdlMostrarEquiposMantenedorUno($valor);

		echo json_encode($respuesta);


	}

	
		
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idEquipo"])){

	$editar = new AjaxMantenedorEquipos();
	$editar -> idEquipo = $_POST["idEquipo"];
	$editar -> ajaxEditarEquipos();

}



   

