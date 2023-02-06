<?php

class ControladorFacturaND{

	

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearND(){

		

		if(isset($_POST["idEmpresa"])){
			   	

			
				
				$datos = array("empresa"=> $_POST['idEmpresa'],
					           "id_constructora" => $_POST["idConstructora"],
							   "id_obra" => $_POST["idObra"],
							   "fecha" => $_POST["fechaND"], 
							   "iva" => VALOR_IVA,							   
							   "tipo_nota"=> $_POST["tipoND"],
							   "id_factura"=> $_POST["idFactura"]
							   );

               
                

				$respuesta = ModeloFacturacionNCND::mdlIngresarND($datos);

				if($respuesta != "error"){
                      
					$_SESSION['idND'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "factura-nd-detalle";

                                    
										

						</script>';

				}

				
		}	

	}


		
	}

