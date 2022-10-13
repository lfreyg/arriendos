<?php

$_SESSION['idPedidoInterno'] = "";


class ControladorPedidoInterno{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarPedidoInterno($idSucursal){	

		$respuesta = ModeloPedidoInterno::mdlMostrarPedidoInterno($idSucursal);

		return $respuesta;

	}

	static public function ctrMostrarPedidoInternoDespacho($idSucursal){	

		$respuesta = ModeloPedidoInterno::mdlMostrarPedidoInternoDespacho($idSucursal);

		return $respuesta;

	}

	static public function ctrValidarPedidoNuevo($idSucursal){	

		$respuesta = ModeloPedidoInterno::mdlValidarPedidoNuevo($idSucursal);

		return $respuesta;

	}

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearPedidoInterno(){
  		
  		  
  		   		if(isset($_POST["sucursales"])){

				$datos = array("id_sucursal" => $_SESSION['idSucursalParaUsuario'],
							   "id_usuario"=>$_SESSION["id"]);

                
				$respuesta = ModeloPedidoInterno::mdlIngresarPedidoInterno($datos);

				if($respuesta != "error"){
                      
					$_SESSION['idPedidoInterno'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "pedido-interno-detalle";
										

						</script>';

				}

			}	
			

	}

	
	/*=============================================
	BORRAR 
	=============================================*/
	static public function ctrEliminarPedidoInterno(){

		if(isset($_GET["idPedido"])){

			$datos = $_GET["idPedido"];

			
			$respuesta = ModeloPedidoInterno::mdlEliminarPedidoInterno($datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedido-interno";

								}
							})

				</script>';

			}		
		}


	}

	

}