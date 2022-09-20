<?php

class ControladorTransportistas{

	/*=============================================
	CREAR REGISTRO
	=============================================*/

	static public function ctrCrearTransportista(){

		if(isset($_POST["nuevaRutChofer"])){

		

				$tabla = "transporte_guia";

					$datos = array("rut"=>$_POST["nuevaRutChofer"],
					               "nombre"=>$_POST["nuevaNombreChofer"],
					               "patente"=>$_POST["nuevaPatenteChofer"],
					               "empresa"=>$_POST["nuevaEmpresa"]);

				$respuesta = ModeloTransportista::mdlIngresarTransportista($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Transportista ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "transportista";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	MOSTRAR REGISTROS
	=============================================*/

	static public function ctrMostrarTransportista($item, $valor){

		$tabla = "transporte_guia";

		$respuesta = ModeloTransportista::mdlMostrarTransportistas($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function ctrEditarTransportista(){

		if(isset($_POST["idTransportista"])){

				$tabla = "transporte_guia";

				$datos = array("patente"=>$_POST["editarPatente"],
					           "empresa"=>$_POST["editarEmpresa"],
							   "id"=>$_POST["idTransportista"]);

				$respuesta = ModeloTransportista::mdlEditarTransportista($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Transportista ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "transportista";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	BORRAR CHOFER
	=============================================*/

	static public function ctrBorrarTransportista(){

		if(isset($_GET["idTransportista"])){

			$respuesta = ModeloTransportista::mdlValidarEliminar($_GET["idTransportista"]);
		
			if(!$respuesta){

				$tabla ="transporte_guia";
				$datos = $_GET["idTransportista"];

				$respuesta = ModeloTransportista::mdlBorrarTransportista($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Transportista ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "transportista";

										}
									})

						</script>';
				}

			}else{

				$tabla ="transporte_guia";
				$datos = $_GET["idTransportista"];

				$respuesta = ModeloTransportista::mdlEstadoEliminaTransportista($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Transportista ha sido borrado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "transportista";

										}
									})

						</script>';
				}

			}
		}
		
	}


  static public function ctrMostrarTransportistaValidar($item, $valor){

		$validador = ControladorTransportistas::validarutChofer($valor);

		if($validador == false){
            $error = "error";
			return $error;
		}

		$tabla = "transporte_guia";
        $valor = str_replace(".","",trim($valor));
		$respuesta = ModeloTransportista::mdlMostrarTransportistas($tabla, $item, $valor);

		return $respuesta;
	
	}

  
  static public function ctrValidarEmpresaTransporte($rut){

		$validador = ControladorTransportistas::validarutChofer($rut);

		if($validador == false){
            $error = "error";
			return $error;
		}
	}


	 static public function validarutChofer($rut)
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



}
