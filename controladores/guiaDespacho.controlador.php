<?php

$_SESSION['idGuiaDespachoArriendo'] = "";


class ControladorGuiaDespacho{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarGuiaDespacho($idSucursal){	

		$respuesta = ModeloGuiaDespacho::mdlMostrarGuiaDespacho($idSucursal);

		return $respuesta;

	}

	static public function ctrMostrarGuiaDespachoUnico($id){	

		$respuesta = ModeloGuiaDespacho::mdlMostrarGuiaDespachoUnico($id);

		return $respuesta;

	}

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearGuiaDespacho(){

		

		if(isset($_POST["nuevaGuiaConstructora"])){
			   	
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

		   $ruta = null;		

			
				$tabla = "guia_despacho";

				$datos = array("id_empresa" => $_POST["nuevaEmpresaOperativa"],
					           "fecha_guia" => $_POST["nuevoFechaGuia"],
					           "id_constructora" => $_POST["nuevaGuiaConstructora"],
							   "id_obra" => $_POST["comboObras"],
							   "id_sucursal" => $_SESSION['idSucursalParaUsuario'],
							   "adjunto" => $ruta,
							   "oc" => $_POST["nuevoGuiaOC"],
							   "creado_por"=>$_SESSION["nombre"]);

               
                

				$respuesta = ModeloGuiaDespacho::mdlIngresarGuiaDespacho($tabla, $datos);

				if($respuesta != "error"){
                      
					$_SESSION['idGuiaDespachoArriendo'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "guia-despacho-arriendos";
										

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