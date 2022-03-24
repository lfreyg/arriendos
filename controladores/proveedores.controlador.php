<?php

class ControladorProveedores{

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearProveedor(){

		if(isset($_POST["nombreNuevaProveedor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreNuevaProveedor"])){

				$tabla = "proveedores";

					$datos = array("rut"=>$_POST["rutNuevaProveedor"],
					           "nombre"=>$_POST["nombreNuevaProveedor"],
					           "contacto"=>$_POST["contactoNuevaProveedor"],
					           "direccion"=>$_POST["direccionNuevaProveedor"],
					           "telefono"=>$_POST["telefonoNuevaProveedor"],
					           "correo"=>$_POST["correoNuevaProveedor"]);

				$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La razón social no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarProveedores($item, $valor){

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarProveedoresValidar($item, $valor){

		$validador = ControladorProveedores::validarut($valor);

		if($validador == false){
            $error = "error";
			return $error;
		}

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	
	}

	 static public function validarut($rut)
  {

  	
    
    		
	if(strpos($rut,"-")==false){
	 $RUT[0] = substr($rut,0, -1);
	 $RUT[1] = substr($rut, -1);
	 }
	 else
	 {
	  $RUT = explode("-", trim($rut));
	//  $RUT[0] = substr($rut,0, -1);
	//  $RUT[1] = substr($rut, -1);
	}
		
	//$rut2 = str_replace("-","",$RUT[0]);
	$elRut = str_replace(".","",trim($RUT[0]));
	
	if(!is_numeric($elRut)){
		return false;
		exit;
	}
	
	$factor = 2;
	
	$suma = 0;	
	for($i = strlen($elRut)-1; $i >= 0; $i--)
	{	
	  $factor = $factor > 7 ? 2 : $factor;
	  $suma += $elRut{$i}*$factor++;
	   
	}
	
	$resto = $suma % 11;
	$dv = 11 - $resto;
	
	if($dv == 11){
	 $dv = 0;
	}else if($dv == 10){
	  $dv = "k";
	}else{
	 $dv = $dv;
	}
	
	if($dv == trim(strtolower($RUT[1]))){
	    return true;
		
	}else{
	   return false;
	   
	}   	   
	  
  }

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarProveedor(){

		if(isset($_POST["nombreEditarProveedor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreEditarProveedor"])){

				$tabla = "proveedores";

				$datos = array("nombre"=>$_POST["nombreEditarProveedor"],
					           "contacto"=>$_POST["contactoEditarProveedor"],
					           "direccion"=>$_POST["direccionEditarProveedor"],
					           "telefono"=>$_POST["telefonoEditarProveedor"],
					           "correo"=>$_POST["correoEditarProveedor"],
					           "id"=>$_POST["idProveedores"]);

				$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Proveedor ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Razón Social no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "proveedores";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function ctrBorrarProveedor(){

		if(isset($_GET["idProveedor"])){

			
				$tabla ="proveedores";
				$datos = $_GET["idProveedor"];

				$respuesta = "ok";

				$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Proveedor ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "proveedores";

										}
									})

						</script>';
				}

			}
		}
		
	
	
		
	}

