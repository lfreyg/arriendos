<?php

class ControladorConstructoras{

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearConstructora(){

		if(isset($_POST["nombreNuevaConstructora"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreNuevaConstructora"])){

				$tabla = "constructoras";

					$datos = array("rut"=>$_POST["rutNuevaConstructora"],
					           "nombre"=>$_POST["nombreNuevaConstructora"],
                               "direccion"=>$_POST["direccionNuevaConstructora"],
                               "telefono"=>$_POST["telefonoNuevaConstructora"],
                               "contacto"=>$_POST["contactoNuevaConstructora"],
                               "telefonoCobra"=>$_POST["cobraTeleNuevaConstructora"],
                               "mailCobra"=>$_POST["cobraMailNuevaConstructora"],
                               "formaPago"=>$_POST["formaPagoNuevaConstructora"],
                               "banco"=>$_POST["bancoNuevaConstructora"]
					           );

				$respuesta = ModeloConstructoras::mdlIngresarConstructora($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Constructora ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "constructoras";

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

							window.location = "constructoras";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarConstructoras($item, $valor){		

		$tabla = "constructoras";

		$respuesta = ModeloConstructoras::mdlMostrarConstructoras($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarConstructorasActivas(){		

		

		$respuesta = ModeloConstructoras::mdlMostrarConstructorasActivas();

		return $respuesta;
	
	}

	static public function ctrMostrarConstructorasValidar($item, $valor){		

		$validador = ControladorConstructoras::validarut($valor);

		if($validador == false){
            $error = "error";
			return $error;
		}

		$tabla = "constructoras";

		$respuesta = ModeloConstructoras::mdlMostrarConstructoras($tabla, $item, $valor);

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

	static public function ctrEditarConstructora(){

		if(isset($_POST["nombreEditarConstructora"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreEditarConstructora"])){

				$tabla = "constructoras";

				$datos = array("nombre"=>$_POST["nombreEditarConstructora"],					           
					           "id"=>$_POST["idConstructoras"],
					           "direccion"=>$_POST["direccionEditarConstructora"],
                               "telefono"=>$_POST["telefonoEditarConstructora"],
                               "contacto"=>$_POST["contactoEditarConstructora"],
                               "telefonoCobra"=>$_POST["cobraTeleEditarConstructora"],
                               "mailCobra"=>$_POST["cobraMailEditarConstructora"],
                               "formaPago"=>$_POST["formaPagoEditarConstructora"],
                               "banco"=>$_POST["bancoEditarConstructora"]);

				$respuesta = ModeloConstructoras::mdlEditarConstructora($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Constructora ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "constructoras";

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

							window.location = "constructoras";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function ctrBorrarConstructora(){

		if(isset($_GET["idConstructora"])){
              
              $respuestaObra = ModeloObras::mdlMostrarObras("obras", "id_constructoras", $_GET["idConstructora"], "ASC");

            if(!$respuestaObra) { 
			
				$tabla ="constructoras";
				$datos = $_GET["idConstructora"];

				$respuesta = "ok";

				$respuesta = ModeloConstructoras::mdlBorrarConstructora($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Constructora ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "constructoras";

										}
									})

						</script>';
				}
			}else{
                echo'<script>

					swal({
						  type: "error",
						  title: "La Constructora no se puede eliminar porque tiene procesos anteriores",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "constructoras";

									}
								})

					</script>';	


			}

			}



		}
		
	
	
		
	}

