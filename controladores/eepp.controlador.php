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
		
	
	
		
	}

