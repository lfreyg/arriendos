<?php

class ControladorObras{

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearObra(){

		if(isset($_POST["nombreNuevaObra"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreNuevaObra"])){

				$tabla = "obras";

					$datos = array("idConstructora"=>$_POST["nuevaConstructoraId"],
					           "nombre"=>$_POST["nombreNuevaObra"],
					           "contacto"=>$_POST["contactoNuevaObra"],
					           "direccion"=>$_POST["direccionNuevaObra"],
					           "telefono"=>$_POST["telefonoNuevaObra"],
					           "email"=>$_POST["correoNuevaObra"],
					           "tipo_cobro_id"=>$_POST["formaCobroNuevaObra"]);

				$respuesta = ModeloObras::mdlIngresarObra($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Obra ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "obras";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Nombre de obra no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "obras";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarObras($item, $valor){

		$tabla = "obras";

		$respuesta = ModeloObras::mdlMostrarObras($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarObrasActivas($item, $valor){

		$tabla = "obras";

		$respuesta = ModeloObras::mdlMostrarObrasActivas($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarObrasSeleccion($valor){

		
		$respuesta = ModeloObras::mdlMostrarObrasSeleccion($valor);

		return $respuesta;
	
	}

	static public function ctrMostrarObrasIdConstructoras($item, $valor){

		$tabla = "obras";

		$respuesta = ModeloObras::mdlMostrarObrasIdConstructoras($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarObra(){

		if(isset($_POST["nombreEditarObra"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreEditarObra"])){

				$tabla = "obras";

				$datos = array(
					           "nombre"=>$_POST["nombreEditarObra"],
					           "contacto"=>$_POST["contactoEditarObra"],
					           "direccion"=>$_POST["direccionEditarObra"],
					           "telefono"=>$_POST["telefonoEditarObra"],
					           "correo"=>$_POST["correoEditarObra"],
					           "cobro"=>$_POST["formaCobroEditarObra"],
					           "id"=>$_POST["idObras"]);

				$respuesta = ModeloObras::mdlEditarObra($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Obra ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "obras";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Nombre Obra no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "obras";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function ctrBorrarObra(){

		if(isset($_GET["idObra"])){

			
				$tabla ="obras";
				$datos = $_GET["idObra"];

				$respuesta = "ok";

				$respuesta = ModeloObras::mdlBorrarObra($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Obra ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "obras";

										}
									})

						</script>';
				}

			}
		}
		
	   static public function ctrMostrarObrasSoloConEquiposActivos($idConstructora){

		
		$respuesta = ModeloObras::mdlMostrarObrasSoloConEquiposActivos($idConstructora);

		return $respuesta;
	
	}

	 static public function ctrMostrarObrasPorId($idObra){

		
		$respuesta = ModeloObras::mdlMostrarObrasPorId($idObra);

		return $respuesta;
	
	}
	
		
	}

