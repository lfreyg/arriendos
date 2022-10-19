<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  $datos = array("idRegistro"=>$_POST["idRegistro"],
                  "idEquipo"=>$_POST["idEquipo"],
                  "idSucursalOrigen"=>$_POST["idSucursalOrigen"]

);  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlQuitarValidarEquipoTraslado($datos);

          return $respuesta

?>