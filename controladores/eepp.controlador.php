<?php

class ControladorEEPP{

	/*=============================================
	CREAR 
	=============================================*/

	

		static public function ctrMostrarConstructoraEEPP($fecha){		

				$respuesta = ModeloEEPP::mdlMostrarConstructoraEEPP($fecha);

		       return $respuesta;
	
	}

	 static public function ctrMostrarObrasEEPP($idConstructora, $fecha){

		
		$respuesta = ModeloObras::mdlMostrarObrasSoloConEquiposActivos($idConstructora);

		return $respuesta;
	
	}

	static public function ctrMostrarEquiposParaCobro($idObra, $fecha){

		
		$respuesta = ModeloEEPP::mdlMostrarEquiposParaCobro($idObra,$fecha);

		return $respuesta;
	
	}

	static public function ctrEquiposCambiadosEEPP($match){

		
		$respuesta = ModeloEEPP::mdlEquiposCambiadosEEPP($match);

		return $respuesta;
	
	}

	static public function ctrMostrarMaterialesParaCobro($idObra, $fecha){

		
		$respuesta = ModeloEEPP::mdlMostrarMaterialesParaCobro($idObra, $fecha);

		return $respuesta;
	
	}

	static public function ctrMostrarEquiposProcesados($idEEPP){

		
		$respuesta = ModeloEEPP::mdlMostrarEquiposProcesados($idEEPP);

		return $respuesta;
	
	}



	
		
	
	
		
	}

