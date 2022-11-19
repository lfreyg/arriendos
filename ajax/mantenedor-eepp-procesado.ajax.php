<?php


require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/obras.modelo.php";

class AjaxMantenedorEEPPProcesado{

	/*=============================================
	EDITAR EQUIPOS EEPP
	=============================================*/	

	public $idRegistro;

	public function ajaxEditarEquiposProcesado(){
		
		$idRegistro = $this->idRegistro;

		$respuesta = ModeloEEPP::mdlMostrarEquiposProcesadoEdita($idRegistro);

		echo json_encode($respuesta);


	}
    
    /*=============================================
	ELIMINAR EQUIPO EEPP
	=============================================*/	

	public $idRegistroElimina;
	public $idEEPPElimina;
	public $idGuiaDetalleElimina;
	public $ultimoElimina;

	public function ajaxEliminaEquiposProcesado(){
		
		$idRegistroElimina = $this->idRegistroElimina;
		$idEEPPElimina = $this->idEEPPElimina;
		$idGuiaDetalleElimina = $this->idGuiaDetalleElimina;
		$ultimoElimina = $this->ultimoElimina;

		$respuesta = ModeloEEPP::mdlEliminaEquiposEEPPProcesado($idRegistroElimina,$idEEPPElimina,$idGuiaDetalleElimina,$ultimoElimina);

		echo json_encode($respuesta);


	}
    
    /*=============================================
	ELIMINAR EXTRAS EEPP
	=============================================*/	

	public $idRegistroExtra;
	
	public function ajaxEliminaExtrasProcesado(){
		
		$idRegistroExtra = $this->idRegistroExtra;
		

		$respuesta = ModeloEEPP::mdlEliminaRegistrosExtra($idRegistroExtra);

		echo json_encode($respuesta);


	}

	/*=============================================
	EDITAR MATERIALES EEPP
	=============================================*/	

	public $idEEPPMaterial;

	public function ajaxEditarMaterialProcesado(){
		
		$idEEPPMaterial = $this->idEEPPMaterial;

		$respuesta = ModeloEEPP::mdlMostrarMaterialesProcesadoEdita($idEEPPMaterial);

	
		echo json_encode($respuesta);


	}


	 /*=============================================
	ELIMINAR MATERIAL EEPP
	=============================================*/	

	public $idRegistroEliMaterial;
	public $idGuiaEliMaterial;	

	public function ajaxEliminaMaterialProcesado(){
		
		$idRegistroEliMaterial = $this->idRegistroEliMaterial;
		$idGuiaEliMaterial = $this->idGuiaEliMaterial;
		
		$respuesta = ModeloEEPP::mdlEliminaMaterialEEPPProcesado($idRegistroEliMaterial,$idGuiaEliMaterial);

		echo json_encode($respuesta);


	}


	/*=============================================
	ELIMINAR DIA DESCUENTO
	=============================================*/	

	public $idDiaDescuento;
	
	public function ajaxEliminaDiaDescuento(){
		
		$idDiaDescuento = $this->idDiaDescuento;
		

		$respuesta = ModeloEEPP::mdlEliminaDiaDescuento($idDiaDescuento);

		echo json_encode($respuesta);


	}

	
		
}	

	

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idRegistro"])){

	$editar = new AjaxMantenedorEEPPProcesado();
	$editar -> idRegistro = $_POST["idRegistro"];
	$editar -> ajaxEditarEquiposProcesado();

}

if(isset($_POST["idRegistroElimina"])){

	$elimina = new AjaxMantenedorEEPPProcesado();
	$elimina -> idRegistroElimina = $_POST["idRegistroElimina"];
	$elimina -> idEEPPElimina = $_POST["idEEPPElimina"];
	$elimina -> idGuiaDetalleElimina = $_POST["idGuiaDetalleElimina"];
	$elimina -> ultimoElimina = $_POST["ultimoElimina"];
	$elimina -> ajaxEliminaEquiposProcesado();

}

if(isset($_POST["idRegistroExtra"])){

	$eliminaExtra = new AjaxMantenedorEEPPProcesado();
	$eliminaExtra -> idRegistroExtra = $_POST["idRegistroExtra"];
	$eliminaExtra -> ajaxEliminaExtrasProcesado();

}

if(isset($_POST["idEEPPMaterial"])){

	$editarMaterial = new AjaxMantenedorEEPPProcesado();
	$editarMaterial -> idEEPPMaterial = $_POST["idEEPPMaterial"];
	$editarMaterial -> ajaxEditarMaterialProcesado();

}

if(isset($_POST["idRegistroEliMaterial"])){

	$eliminaMat = new AjaxMantenedorEEPPProcesado();
	$eliminaMat -> idRegistroEliMaterial = $_POST["idRegistroEliMaterial"];
	$eliminaMat -> idGuiaEliMaterial = $_POST["idGuiaEliMaterial"];	
	$eliminaMat -> ajaxEliminaMaterialProcesado();

}

if(isset($_POST["idDiaDescuento"])){

	$eliminaDia = new AjaxMantenedorEEPPProcesado();
	$eliminaDia -> idDiaDescuento = $_POST["idDiaDescuento"];	
	$eliminaDia -> ajaxEliminaDiaDescuento();

}



   

