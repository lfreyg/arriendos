<?php

class ControladorTipoEquipos{

	

	/*=============================================
	REGISTRO DE TIPO EQUIPOS
	=============================================*/

	static public function ctrCrearTipoEquipo(){

		if(isset($_POST["nuevoNombre"])){					   					

				$tabla = "nombre_equipos";				

				$datos = array("idCategoria" =>$_POST["nuevoCategoriaEquipo"],
					           "marca"=>$_POST["nuevoMarcaEquipo"],
					           "modelo" => $_POST["nuevoModelo"],	
					           "descripcion" => $_POST["nuevoNombre"],
					           "garantia" => $_POST["nuevogarantia"],	
					           "vida" => $_POST["nuevoVida"],	
				               "precio" => $_POST["nuevoPrecio"]);
					           

				$item1 = "id_categoria";
				$item2 = "id_marca";
				$item3 = "descripcion";
				$item4 = "modelo";

				$valor1 = $_POST["nuevoCategoriaEquipo"];
				$valor2 = $_POST["nuevoMarcaEquipo"];
				$valor3 = strtoupper($_POST["nuevoNombre"]);
				$valor4 = strtoupper($_POST["nuevoModelo"]);

				$validar = ModeloTipoEquipos::mdlValidarTipoEquipos($item1, $valor1,$item2,$valor2,$item3,$valor3,$item4,$valor4);

				
				if($validar){
					echo '<script>

					swal({

						type: "success",
						title: "¡Este tipo de equipo, su descripción y modelo, ya existen",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){						
							window.location = "tipo-equipos";

						}

					});
				

					</script>';
					die;
				}


				$respuesta = ModeloTipoEquipos::mdlIngresarTipoEquipo($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Tipo de equipo ha sido guardado correctamente!, ahora agregue fotografia",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tipo-equipos";

						}

					});
				

					</script>';


				}				


		}


	}

	/*=============================================
	MOSTRAR TIPO EQUIPOS
	=============================================*/

	
	static public function ctrMostrarTipoEquipo($item, $valor){

		$tabla = "nombre_equipos";

		$respuesta = ModeloTipoEquipos::mdlMostrarTipoEquipos($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarTipoEquipoConMarca(){

		
		$respuesta = ModeloTipoEquipos::mdlMostrarTipoEquiposConMarca();

		return $respuesta;
	}

	

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarTipoEquipo(){

		if(isset($_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["idTipo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["idTipo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["idTipo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "nombre_equipos";				

				$datos = array("descripcion" => $_POST["editarNombre"],
					           "marca" => $_POST["editarMarcaEquipo"],
				               "modelo" => $_POST["editarModelo"],			              	
				               "precio" => $_POST["editarPrecio"],		   
							   "garantia" => $_POST["editarGarantia"],
							   "vida" => $_POST["editarVida"],
							   "foto" => $ruta,
							   "id" => $_POST['idTipo']
							  );

				$respuesta = ModeloTipoEquipos::mdlEditarTipoEquipos($tabla, $datos);

				if($respuesta == "ok"){                   
					
					echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de equipo ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "tipo-equipos";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function ctrBorrarTipoEquipo(){

	if(isset($_GET["idTipoEquipo"])){

			$tabla ="nombre_equipos";
			$datos = $_GET["idTipoEquipo"];

		$valida = ModeloTipoEquipos::mdlValidarTipoEquipoEnCompras($datos);
		
		if(!$valida){	

			if($_GET["fotoEquipo"] != ""){

				unlink($_GET["fotoEquipo"]);
				rmdir('vistas/img/productos/'.$_GET["idTipoEquipo"]);

			}

			$respuesta = ModeloTipoEquipos::mdlBorrarTipoEquipos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Tipo de equipo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "tipo-equipos";

								}
							})

				</script>';

			}

		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: " No se puede eliminar porque tiene equipos vinculados",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-equipos";

									}
								})

					</script>';	
		}		

		}

	} 
	

}
	


