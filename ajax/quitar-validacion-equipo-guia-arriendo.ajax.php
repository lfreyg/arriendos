<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  $datos = array("idRegistro"=>$_POST["idRegistro"],
                  "idEquipo"=>$_POST["idEquipo"]
);  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlQuitarValidarEquipoRecepcionado($datos);

          return $respuesta

?>