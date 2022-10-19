<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


   $datos = array("idRegistro"=>$_POST["idRegistro"],
                  "idEquipo"=>$_POST["idEquipo"],
                  "idSucursal"=>$_POST["idSucursal"]

);  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlValidarEquipoRecepcionadoTraslado($datos);

          return $respuesta

?>