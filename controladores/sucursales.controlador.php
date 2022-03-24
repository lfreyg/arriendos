<?php

class ControladorSucursales{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearSucursal(){

		if(isset($_POST["nuevaSucursal"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaSucursal"])){

				$tabla = "sucursales";

					$datos = array("nombre"=>$_POST["nuevaSucursal"],
					               "direccion"=>$_POST["nuevaDireccion"],
					               "contacto"=>$_POST["nuevaContacto"],
					               "telefono"=>$_POST["nuevaTelefono"],
					               "correo"=>$_POST["nuevaCorreo"]);

				$respuesta = ModeloSucursales::mdlIngresarSucursal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La sucursal ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sucursales";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La sucursal no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sucursales";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR SUCURSALES
	=============================================*/

	static public function ctrMostrarSucursales($item, $valor){

		$tabla = "sucursales";

		$respuesta = ModeloSucursales::mdlMostrarSucursales($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR SUCURSAL
	=============================================*/

	static public function ctrEditarSucursal(){

		if(isset($_POST["editarSucursal"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSucursal"])){

				$tabla = "sucursales";

				$datos = array("nombre"=>$_POST["editarSucursal"],
					           "direccion"=>$_POST["editarDireccion"],
							   "id"=>$_POST["idSucursal"],
							   "contacto"=>$_POST["editarContacto"],
								"telefono"=>$_POST["editarTelefono"],
								"correo"=>$_POST["editarCorreo"]);

				$respuesta = ModeloSucursales::mdlEditarSucursal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La sucursal ha sido modificada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sucursales";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La sucursal no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "sucursales";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR SUCURSAL
	=============================================*/

	static public function ctrBorrarSucursal(){

		if(isset($_GET["idSucursal"])){

			$respuesta = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id_sucursal", $_GET["idSucursal"], "ASC");
		
			if(!$respuesta){

				$tabla ="sucursales";
				$datos = $_GET["idSucursal"];

				$respuesta = ModeloSucursales::mdlBorrarSucursal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "La sucursal ha sido borrada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "sucursales";

										}
									})

						</script>';
				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "La sucursal no se puede eliminar porque tiene procesos anteriores",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sucursales";

									}
								})

					</script>';	

			}
		}
		
	}
}
