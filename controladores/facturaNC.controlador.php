<?php

class ControladorFacturaNC{

	

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearNC(){

		

		if(isset($_POST["idEmpresa"])){
			   	

			
				
				$datos = array("empresa"=> $_POST['idEmpresa'],
					           "id_constructora" => $_POST["idConstructora"],
							   "id_obra" => $_POST["idObra"],
							   "fecha" => $_POST["fechaNC"], 
							   "iva" => VALOR_IVA,							   
							   "tipo_nota"=> $_POST["tipoNC"],
							   "id_factura"=> $_POST["idFactura"]
							   );

               
                

				$respuesta = ModeloFacturacionNCND::mdlIngresarNC($datos);

				if($respuesta != "error"){
                      
					$_SESSION['idNC'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "factura-nc-detalle";

                                    
										

						</script>';

				}

				
		}	

	}


	static public function ctrEditarFacturaEEPP(){

		

		if(isset($_POST["fechaFacEdita"])){
			   	

			
				
				$datos = array(
					     "id"=> $_POST["idRegistro"],
					     "fecha"=> $_POST['fechaFacEdita']

				 );

               
                

				$respuesta = ModeloFacturacionEEPP::mdlEditarFactura($datos);

				if($respuesta == "ok"){
                      
					echo'<script>		
                                     window.location = "obras-factura-detalle";		

						</script>';

				}

				
		}	

	}
	

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearFacturaEEPPDesdeOC(){

		

		if(isset($_POST["EmpresaOperativa_Fac"])){
			   	

			
				
				$datos = array("empresa"=> $_POST['EmpresaOperativa_Fac'],
					           "id_constructora" => $_POST["id_constructora_fac"],
							   "id_obra" => $_POST["id_obra_fac"],
							   "fecha" => $_POST["fechaFactura"], 
							   "iva" => VALOR_IVA,							   
							   "tipo"=> 'A',
							   "como"=> 'OC'
							   );

               
              

				$respuesta = ModeloFacturacionEEPPOC::mdlIngresarFacturaOC($datos);

				if($respuesta != "error"){
                      
					     $idFactura = $respuesta["id"];

					     $datosFac = array("idEEPP"=>$_POST["id_eeppFactxt"],
						              "idFactura"=>$idFactura
				         );

					ModeloFacturacionEEPPOC::mdlIngresarFacturaEEPPOC($datosFac);

					   $_SESSION["idObraFacturar"] = $_POST["id_obra_fac"];
					   $_SESSION["idFacturaArriendo"] = $idFactura;




                  
					echo'<script>		
                                     window.location = "EEPPFacturarSeleccionOC";

                                    
										

						</script>';
						

				}

				
		}	

	}
	
		
		
	
	
		
	}

