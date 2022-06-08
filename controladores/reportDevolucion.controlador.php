<?php

$_SESSION['idReportDevolucion'] = "";


class ControladorReportDevolucion{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarReportDevolucion($idUsuario){	

		$respuesta = ModeloReportDevolucion::mdlMostrarReportDevolucion($idUsuario);

		return $respuesta;

	}

	static public function ctrMostrarReportDevolucionUnico($id){	

		$respuesta = ModeloReportDevolucion::mdlMostrarReportDevolucionUnico($id);

		return $respuesta;

	}

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearReportDevolucion(){

		

		if(isset($_POST["nuevaConstructoraReport"])){
			   	
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

		   $ruta = null;		

			
				$tabla = "report_devolucion";

				$datos = array("id_constructora" => $_POST["nuevaConstructoraReport"],
							   "id_obra" => $_POST["comboObras"],							   
							   "documento" => $ruta,							   
							   "id_usuario"=>$_SESSION["id"]);

               
                

				$respuesta = ModeloReportDevolucion::mdlIngresarReportDevolucion($tabla, $datos);

				if($respuesta != "error"){
                      
					$_SESSION['idReportDevolucion'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "devolucion-equipos-arriendos-detalle";
										

						</script>';

				}

				
		}	

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarReportDevolucion(){

		if(isset($_POST["editaConstructoraReport"])){

				   		

			   	$ruta = $_POST['docAnteriorReport'];	                 		

			if(isset($_FILES['editaReportDoc']) && $_FILES['editaReportDoc']['type']=='application/pdf'){
				  $ruta = 'vistas/img/Report/'.$_POST["idReport"].".pdf";
	               move_uploaded_file ($_FILES['editaReportDoc']['tmp_name'] , $ruta);
              }


				$tabla = "report_devolucion";

				$datos = array("id_constructora" => $_POST["editaConstructoraReport"],
							   "id_obra" => $_POST["editaComboObras"],
							   "documento" => $ruta,							   
							   "id" => $_POST["idReport"]);
							   

				
				$respuesta = ModeloReportDevolucion::mdlEditarReportDevolucion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
						  type: "success",
						  title: "Datos del report han sido modificada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "devolucion-equipos-arriendos";

									}
								})

						</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR 
	=============================================*/
	static public function ctrEliminarReportDevolucion(){

		if(isset($_GET["idReport"])){

			
			$idReport = $_GET["idReport"];

			
			$respuesta = ModeloReportDevolucion::mdlEliminarReportDevolucion($idReport);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Report ha sido Anulado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "devolucion-equipos-arriendos";

								}
							})

				</script>';

			}		
		}


	}

	

}