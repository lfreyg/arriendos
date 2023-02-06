<?php

$_SESSION['idGuiaDespachoTaller'] = "";


class ControladorGuiaDespachoTaller{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarGuiaDespacho($idSucursal){	

		$respuesta = ModeloGuiaDespachoTaller::mdlMostrarGuiaDespacho($idSucursal);

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

		          
                  $item = $_POST["nuevaTransporte"];
                 

                  $transporte = ModeloTransporteGuia::mdlMostrarTrasporteGuia($item);

                  
                  $rut_transportista = $transporte["rut"];
                  $nombre_transportista = $transporte["nombre"];
                  $patente_transportista = $transporte["patente"];
                  $empresa_transportista = $transporte["rut_empresa_transporte"];

			
				$tabla = "guia_despacho";

				$datos = array("id_empresa" => $_POST["nuevaEmpresaOperativa"],
					           "fecha_guia" => $_POST["nuevoFechaGuia"],
					           "id_constructora" => $_POST["nuevaGuiaConstructora"],							  
							   "id_sucursal" => $_SESSION['idSucursalParaUsuario'],							   							  
							   "id_transporte_guia" => $_POST["nuevaTransporte"],
							   "rut_empresa_transporte" => $empresa_transportista,
							   "rut_transportista"  => $rut_transportista,
							   "nombre_transportista"  => $nombre_transportista,
							   "patente_transportista"  => $patente_transportista,
							   "tipoGuia" => $_POST["tipoGuia"],
							   "creado_por"=>$_SESSION["nombre"]);

               
                

				$respuesta = ModeloGuiaDespachoTaller::mdlIngresarGuiaDespacho($tabla, $datos);

				if($respuesta != "error"){
                      
					$_SESSION['idGuiaDespachoTaller'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "guia-despacho-taller-detalle";
										

						</script>';

				}

				
		}	

	}


	static public function ctrCrearGuiaDespachoTraslado(){

		

		if(isset($_POST["nuevaTransporte"])){
			   	
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

		   $ruta = null;		

		          
                  $item = $_POST["nuevaTransporte"];
                 

                  $transporte = ModeloTransporteGuia::mdlMostrarTrasporteGuia($item);

                  
                  $rut_transportista = $transporte["rut"];
                  $nombre_transportista = $transporte["nombre"];
                  $patente_transportista = $transporte["patente"];
                  $empresa_transportista = $transporte["rut_empresa_transporte"];
                  $tipoGuia = 'T';

			
				$tabla = "guia_despacho";

				$datos = array("id_empresa" => $_POST["nuevaEmpresaOperativa"],
					           "fecha_guia" => $_POST["nuevoFechaGuia"],
					           "id_constructora" => null,
							   "id_obra" => null,
							   "id_sucursal" => $_SESSION['idSucursalParaUsuario'],
							   "adjunto" => $ruta,
							   "oc" => null,
							   "fecha_termino" => null,
							   "id_transporte_guia" => $_POST["nuevaTransporte"],
							   "rut_empresa_transporte" => $empresa_transportista,
							   "rut_transportista"  => $rut_transportista,
							   "nombre_transportista"  => $nombre_transportista,
							   "patente_transportista"  => $patente_transportista,
							   "tipoGuia" => $tipoGuia,
							   "creado_por"=>$_SESSION["nombre"],
							   "sucursalDestino"=>$_POST["idSucursaltxt"],
							   "idPedidoGenerado"=>$_POST["idPedidoGenerado"]);

               
                

				$respuesta = ModeloGuiaDespacho::mdlIngresarGuiaDespachoTraslado($tabla, $datos);

				if($respuesta != "error"){
                      
					$_SESSION['idGuiaDespachoTraslado'] = $respuesta["id"];

					echo'<script>		
                       window.location = "pedido-interno-despacho-detalle";
										

						</script>';

				}

				
		}	

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarGuiaDespachoTaller(){

		if(isset($_POST["editaGuiaConstructora"])){

				   		

			                 		

		             $item = $_POST["editaTransporte"];
                 

                  $transporte = ModeloTransporteGuia::mdlMostrarTrasporteGuia($item);

                  
                  $rut_transportista = $transporte["rut"];
                  $nombre_transportista = $transporte["nombre"];
                  $patente_transportista = $transporte["patente"];
                  $empresa_transportista = $transporte["rut_empresa_transporte"];


				$tabla = "guia_despacho";

				$datos = array("fecha_guia" => $_POST["editaFechaGuia"],
					           "id_constructora" => $_POST["editaGuiaConstructora"],							  
							   "id_transporte_guia" => $_POST["editaTransporte"],
							   "rut_empresa_transporte" => $empresa_transportista,
							   "rut_transportista"  => $rut_transportista,
							   "nombre_transportista"  => $nombre_transportista,
							   "patente_transportista"  => $patente_transportista,							  
				         "id" => $_POST["idGuiaEdita"]);
							  

				
				$respuesta = ModeloGuiaDespachoTaller::mdlEditarGuiaDespachoTaller($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
						  type: "success",
						  title: "Datos actualizados correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "guia-despacho-taller";

									}
								})

						</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR 
	=============================================*/
	static public function ctrEliminarGuiaDEspachoTaller(){

		if(isset($_GET["idGuia"]) && isset($_GET["idEstado"])){

			
			$id = $_GET["idGuia"];
			$idEstado = $_GET["idEstado"];
			$idUsuario = $_SESSION["id"];

	if($idEstado == 13)	{	
			$respuesta = ModeloGuiaDespachoTaller::mdlAnularGuiaDespachoTaller($id, $idUsuario);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Guía de despacho ha sido ANULADA correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "guia-despacho-taller";

								}
							})

				</script>';

			}	

		}

		if($idEstado == 12)	{	
			$respuesta = ModeloGuiaDespachoTaller::mdlEliminarGuiaDespachoTaller($id);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Guía de despacho ha sido ELIMINADA correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "guia-despacho-taller";

								}
							})

				</script>';

			}else{
				echo'<script>

				swal({
					  type: "error",
					  title: "Ocurrio un error al eliminar",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "guia-despacho-taller";

								}
							})

				</script>';
			}	
		}




		}


	}

	

}