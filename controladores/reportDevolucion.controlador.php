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

	static public function ctrCrearPedidoEquipo(){

		

		if(isset($_POST["nuevaPedidoConstructora"])){
			   	
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

		   $ruta = null;		

			
				$tabla = "pedido_equipo";

				$datos = array("id_constructora" => $_POST["nuevaPedidoConstructora"],
							   "id_obra" => $_POST["comboObras"],
							   "id_sucursal" => $_POST["nuevaSucursalPedido"],
							   "documento" => $ruta,
							   "oc" => $_POST["nuevoPedidoOC"],
							   "id_usuario"=>$_SESSION["id"]);

               
                

				$respuesta = ModeloPedidoEquipo::mdlIngresarPedidoEquipo($tabla, $datos);

				if($respuesta != "error"){
                      
					$_SESSION['idPedidoEquipo'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "pedido-equipos-detalle";
										

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
	static public function ctrEliminarPedidoEquipo(){

		if(isset($_GET["idPedido"])){

			$tabla ="pedido_equipo";
			$datos = $_GET["idPedido"];

			
			$respuesta = ModeloPedidoEquipo::mdlEliminarPedidoEquipo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedido-equipos";

								}
							})

				</script>';

			}		
		}


	}

	

}