<?php

class ControladorFacturacion{

	/*=============================================
	CREAR 
	=============================================*/

	

		static public function ctrMostrarConstructoraFactura(){		

				$respuesta = ModeloFacturacionEEPP::mdlMostrarConstructoraFactura();

		       return $respuesta;
	
	}

	 static public function ctrMostrarObrasFactura($idConstructora){

		
		$respuesta = ModeloFacturacionEEPP::mdlMostrarObrasFactura($idConstructora);

		return $respuesta;
	
	}

	static public function ctrMostrarEEPPFacturacionPrevia($idObra){

		
		$respuesta = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPrevia($idObra);

		return $respuesta;
	
	}

	static public function ctrMostrarEEPPFacturacionSeleccion($idFactura){

		
		$respuesta = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionSeleccion($idFactura);

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


	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearFacturaEEPP(){

		

		if(isset($_POST["EmpresaOperativa_Fac"])){
			   	

			
				
				$datos = array("empresa"=> $_POST['EmpresaOperativa_Fac'],
					           "id_constructora" => $_POST["id_constructora_fac"],
							   "id_obra" => $_POST["id_obra_fac"],
							   "fecha" => $_POST["fechaFactura"], 
							   "iva" => VALOR_IVA,							   
							   "tipo"=> 'A'
							   );

               
                

				$respuesta = ModeloFacturacionEEPP::mdlIngresarFactura($datos);

				if($respuesta != "error"){
                      
					$_SESSION['idFacturaArriendo'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "EEPPFacturar";

                                    
										

						</script>';

				}

				
		}	

	}
	
		
	
	
		
	}

