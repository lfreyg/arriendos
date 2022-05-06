<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  

   $datos = array("idGuia"=>$_POST["idGuia"],
				      "idEquipo"=>$_POST["idEquipo"],
                  "precio"=>$_POST["precio"],
                  "fechaArriendo"=>$_POST["fechaArriendo"],
                  "detalle"=>$_POST["detalle"],
                  "fechaDevolucion"=>$_POST["fechaDevolucion"],
                  "contrato"=>$_POST["contrato"],
                  "movimiento"=>$_POST["movimiento"],
                  "idEmpresa"=>$_POST["idEmpresa"]                                   
				 );

          $tabla = "guia_despacho_detalle";

          $respuesta = ModeloGuiaDespachoDetalles::mdlIngresarGuiaDespachoDetalle($tabla, $datos);

          return $respuesta

?>