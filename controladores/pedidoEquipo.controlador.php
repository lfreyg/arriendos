<?php

$_SESSION['idPedidoEquipo'] = "";


class ControladorPedidoEquipo{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarPedidoEquipo($idUsuario){	

		$respuesta = ModeloPedidoEquipo::mdlMostrarPedidoEquipo($idUsuario);

		return $respuesta;

	}

	static public function ctrMostrarPedidoEquipoUnico($id){	

		$respuesta = ModeloPedidoEquipo::mdlMostrarPedidoEquipoUnico($id);

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
                                     window.location = "pedido-equipos";
										

						</script>';

				}

				
		}	

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarPedidoEquipo(){

		if(isset($_POST["editaPedidoConstructora"])){

				   		

			   	$ruta = $_POST['docAnteriorPedido'];	                 		

			if(isset($_FILES['editaPedidoDoc']) && $_FILES['editaPedidoDoc']['type']=='application/pdf'){
				  $ruta = 'vistas/img/PedidoEquipos/'.$_POST["idPedidoEquipoEdita"].".pdf";
	               move_uploaded_file ($_FILES['editaPedidoDoc']['tmp_name'] , $ruta);
              }


				$tabla = "pedido_equipo";

				$datos = array("id_constructora" => $_POST["editaPedidoConstructora"],
							   "id_obra" => $_POST["editaComboObras"],
							   "id_sucursal" => $_POST["editaSucursalPedido"],
							   "documento" => $ruta,
							   "oc" => $_POST["editaPedidoOC"],
							   "id" => $_POST["idPedidoEquipoEdita"]);
							   

				
				$respuesta = ModeloPedidoEquipo::mdlEditarPedidoEquipo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
						  type: "success",
						  title: "Pedido de equipos ha sido modificada correctamente",
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

	/*=============================================
	BORRAR 
	=============================================*/
	static public function ctrEliminarFacturaCompra(){

		if(isset($_GET["idFactura"])){

			$tabla ="facturas_compra_equipos";
			$datos = $_GET["idFactura"];

			
			$respuesta = ModeloFacturasCompra::mdlEliminarFacturasCompra($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Factura de compra ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "facturas-compra-equipos";

								}
							})

				</script>';

			}		
		}


	}

	

}