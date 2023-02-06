<?php

class ControladorTalleres{

	/*=============================================
	CREAR 
	=============================================*/

	static public function ctrCrearTaller(){

		if(isset($_POST["nombreTaller"])){

				
					$datos = array("rut"=>$_POST["rutTaller"],
					           "nombre"=>$_POST["nombreTaller"],
                               "direccion"=>$_POST["direccionTaller"],
                               "telefono"=>$_POST["telefonoTaller"],
                               "correo"=>$_POST["correoTaller"],
                               "contacto"=>$_POST["contactoTaller"],
                               "comuna"=>$_POST["comunaTaller"],
                               "ciudad"=>$_POST["ciudadTaller"]                              
					           );

				$respuesta = ModeloTalleres::mdlIngresarTaller($datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Taller ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "talleres";

									}
								})

					</script>';

				}


			
		}

	}


	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarTalleres($id){		

	
		$respuesta = ModeloTalleres::mdlMostrarTalleres($id);

		return $respuesta;
	
	}

	static public function ctrMostrarTalleresActivos(){		

		

		$respuesta = ModeloTalleres::mdlMostrarTalleresActivos();

		return $respuesta;
	
	}

	static public function ctrMostrarTallerValidar($rut){		

		$validador = ControladorTalleres::validarut($rut);

		if($validador == false){
            $error = "error";
			return $error;
		}

		

		$respuesta = ModeloTalleres::mdlTallerExiste($rut);

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

	static public function ctrEditarTaller(){

		if(isset($_POST["nombreTallerE"])){			

				$tabla = "constructoras";

				$datos = array("id"=>$_POST["idTallerTxt"],
					           "nombre"=>$_POST["nombreTallerE"],
                               "direccion"=>$_POST["direccionTallerE"],
                               "telefono"=>$_POST["telefonoTallerE"],
                               "correo"=>$_POST["correoTallerE"],
                               "contacto"=>$_POST["contactoTallerE"],
                               "comuna"=>$_POST["comunaTallerE"],
                               "ciudad"=>$_POST["ciudadTallerE"]                              
					           );

				$respuesta = ModeloTalleres::mdlEditarTaller($datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Taller Externo ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "talleres";

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

		if(isset($_GET["idTaller"])){
              
             
			
			
				$datos = $_GET["idTaller"];

				$respuesta = "ok";

				$respuesta = ModeloTalleres::mdlBorrarTaller($datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Taller ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "talleres";

										}
									})

						</script>';
				}
			

			}



		}
		
		
	}

