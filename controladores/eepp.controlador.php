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

	static public function ctrNombreMeses($mes){

		switch ($mes) {
		    case 1:
		        return 'ENERO';
		        break;
		    case 2:
		         return 'FEBRERO';
		        break;
		    case 3:
		        return 'MARZO';
		        break;
		    case 4:
		        return 'ABRIL';
		        break;
		    case 5:
		        return 'MAYO';
		        break; 
		    case 6:
		        return 'JUNIO';
		        break;  
		    case 7:
		        return 'JULIO';
		        break;       
		    case 8:
		        return 'AGOSTO';
		        break; 
		    case 9:
		        return 'SEPTIEMBRE';
		        break;
		    case 10:
		        return 'OCTUBRE';
		        break;  
		    case 11:
		        return 'NOVIEMBRE';
		        break; 
		    case 12:
		        return 'DICIEMBRE';
		        break;                      
        }

	
	}


    static public function ctrMostrarEEPPGenerados($mes, $anno){		

				$respuesta = ModeloEEPP::mdlMostrarEEPPGenerados($mes, $anno);

		       return $respuesta;
	
	}
	
		
	
	
		
	}

