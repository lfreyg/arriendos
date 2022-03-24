<?php

$_SESSION['idFactura'] = "";


class ControladorFacturasCompra{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarFacturasCompra($item, $valor){

		$tabla = "facturas_compra_equipos";

		$respuesta = ModeloFacturasCompra::mdlMostrarFacturasCompra($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearFacturasCompra(){

		

		if(isset($_POST["nuevoNumeroFacturaCompra"])){
			   	
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

		   $ruta = null;		

			if(isset($_FILES['nuevoArchivoPdf']) && $_FILES['nuevoArchivoPdf']['type']=='application/pdf'){
				  $ruta = 'vistas/img/facturaCompra/'.$_POST["nuevaProveFac"]."-".$_POST["nuevoNumeroFacturaCompra"].".pdf";
	               move_uploaded_file ($_FILES['nuevoArchivoPdf']['tmp_name'] ,$ruta);
              }
		   		



				$tabla = "facturas_compra_equipos";

				$datos = array("id_proveedor" => $_POST["nuevaProveFac"],
							   "numero_factura" => $_POST["nuevoNumeroFacturaCompra"],
							   "fecha_factura" => $_POST["nuevoFechaFacturaCompra"],	
							   "imagen" => $ruta,							   
							   "usuario"=>$_SESSION["nombre"]);

                $valida = ModeloFacturasCompra::mdlValidaExisteFacturaCompra($tabla, $datos);

                if($valida){
                	echo'<script>

					swal({
						  type: "error",
						  title: "¡Factura ya se encuentra ingresada para este roveedor!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							

							}
						})

			  	</script>';	
			  	return;		  	
                }


				$respuesta = ModeloFacturasCompra::mdlIngresarFacturasCompra($tabla, $datos);

				if($respuesta != "error" && !$valida){
                      
					$_SESSION['idFactura'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "factura-detalles";
										

						</script>';

				}

				
		}	

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarFacturaCompra(){

		if(isset($_POST["editarNumeroFacturaCompra"])){

				   		

			   	$ruta = $_POST['imagenAnteriorFactura'];	                 		

			if(isset($_FILES['editarArchivoPdf']) && $_FILES['editarArchivoPdf']['type']=='application/pdf'){
				  $ruta = 'vistas/img/facturaCompra/'.$_POST["editarProveFac"]."-".$_POST["editarNumeroFacturaCompra"].".pdf";
	               move_uploaded_file ($_FILES['editarArchivoPdf']['tmp_name'] , $ruta);
              }


				$tabla = "facturas_compra_equipos";

				$datos = array("id_proveedor" => $_POST["editarProveFac"],
							   "numero_factura" => $_POST["editarNumeroFacturaCompra"],
							   "fecha_factura" => $_POST["editarFechaFacturaCompra"],		
							   "imagen" => $ruta,
							   "id" => $_POST["idFacturaCompraEdita"]);

				$respuesta = ModeloFacturasCompra::mdlEditarFacturasCompra($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
						  type: "success",
						  title: "Factura de compra ha sido modificada correctamente",
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