<?php

$_SESSION['idGuiaDespachoArriendo'] = "";


class ControladorGuiaDespacho{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function ctrMostrarGuiaDespacho($idSucursal){	

		$respuesta = ModeloGuiaDespacho::mdlMostrarGuiaDespacho($idSucursal);

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

			
				$tabla = "guia_despacho";

				$datos = array("id_empresa" => $_POST["nuevaEmpresaOperativa"],
					           "fecha_guia" => $_POST["nuevoFechaGuia"],
					           "id_constructora" => $_POST["nuevaGuiaConstructora"],
							   "id_obra" => $_POST["comboObras"],
							   "id_sucursal" => $_SESSION['idSucursalParaUsuario'],
							   "adjunto" => $ruta,
							   "oc" => $_POST["nuevoGuiaOC"],
							   "tipoGuia" => $_POST["tipoGuia"],
							   "creado_por"=>$_SESSION["nombre"]);

               
                

				$respuesta = ModeloGuiaDespacho::mdlIngresarGuiaDespacho($tabla, $datos);

				if($respuesta != "error"){
                      
					$_SESSION['idGuiaDespachoArriendo'] = $respuesta["id"];

					echo'<script>		
                                     window.location = "guia-despacho-arriendos";
										

						</script>';

				}

				
		}	

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function ctrEditarGuiaDespacho(){

		if(isset($_POST["editaGuiaConstructora"])){

				   		

			   	$ruta = $_POST['docAnteriorGuia'];	                 		

			if(isset($_FILES['editaGuiaDoc']) && $_FILES['editaGuiaDoc']['type']=='application/pdf'){
				  $ruta = 'vistas/img/GuiasDespacho/'.$_POST["idGuiaEdita"].".pdf";
	               move_uploaded_file ($_FILES['editaGuiaDoc']['tmp_name'] , $ruta);
              }


				$tabla = "guia_despacho";

				$datos = array("fecha_guia" => $_POST["editaFechaGuia"],
					           "id_constructora" => $_POST["editaGuiaConstructora"],
							   "id_obra" => $_POST["editaComboObras"],							   
							   "adjunto" => $ruta,
							   "oc" => $_POST["editaGuiaOC"],
				               "id" => $_POST["idGuiaEdita"]);
							  

				
				$respuesta = ModeloGuiaDespacho::mdlEditarGuiaDespacho($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
						  type: "success",
						  title: "Guía de Despacho ha sido modificada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "guia-despacho-arriendos";

									}
								})

						</script>';

				}


			
		}

	}

	/*=============================================
	BORRAR 
	=============================================*/
	static public function ctrEliminarGuiaDEspacho(){

		if(isset($_GET["idGuia"]) && isset($_GET["idEstado"])){

			
			$id = $_GET["idGuia"];
			$idEstado = $_GET["idEstado"];

	if($idEstado == 13)	{	
			$respuesta = ModeloGuiaDespacho::mdlAnularGuiaDespacho($id);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Guía de despacho ha sido ANULADA correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "guia-despacho-arriendos";

								}
							})

				</script>';

			}	

		}

		if($idEstado == 12)	{	
			$respuesta = ModeloGuiaDespacho::mdlEliminarGuiaDespacho($id);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Guía de despacho ha sido ELIMINADA correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "guia-despacho-arriendos";

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

								window.location = "guia-despacho-arriendos";

								}
							})

				</script>';
			}	
		}




		}


	}

	

}