<?php

$_SESSION['idOrdenCompra'] = null;

class ControladorOrdenCompra{

	/*=============================================
	MOSTRAR 
	=============================================*/

	
	static public function ctrMostrarOC($id){	

		$respuesta = ModeloOrdenCompra::mdlMostrarOC($id);

		return $respuesta;

	}

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearOrdenCompra(){

		

		if(isset($_POST["nuevoNumeroOC"])){
			   	

			
				
				$datos = array("id_constructora" => $_POST["id_constructora_oc"],
							   "id_obra" => $_POST["id_obra_oc"],	
							   "id_eepp" => $_POST["id_eepp"],							   
							   "oc" => $_POST["nuevoNumeroOC"],
							   "fechaOC" => $_POST["nuevoFechaOC"], 							   
							   "usuario"=> $_POST["usuario_oc"]
							   );

               
                

				$respuesta = ModeloOrdenCompra::mdlIngresarOC($datos);

				if($respuesta != "error"){
                      
					$_SESSION['idOrdenCompra'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "orden-compra-detalle";

                                    
										

						</script>';

				}

				
		}	

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarOC(){

		if(isset($_POST["nuevoNumeroOCE"])){

				   		

			   
				$datos = array("oc" => $_POST["nuevoNumeroOCE"],
							   "fechaOC" => $_POST["nuevoFechaOCE"],
							   "id" => $_POST["idRegistro"] 
							   );
							   

				
				$respuesta = ModeloOrdenCompra::mdlEditarOC($datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
						  type: "success",
						  title: "Datos de la OC han sido modificados correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "obras-oc-detalle";

									}
								})

						</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR 
	=============================================*/
	static public function ctrEliminarOC(){

		if(isset($_GET["idOC"])){

			
			$idOC = $_GET["idOC"];

			
			$respuesta = ModeloOrdenCompra::mdlEliminarOC($idOC);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "OC ha sido Eliminado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "obras-oc-detalle";

								}
							})

				</script>';

			}		
		}


	}

}