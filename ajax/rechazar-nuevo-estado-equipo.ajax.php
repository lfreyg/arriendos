<?php

require_once "../modelos/equipos.modelo.php";

   $datos = array("id"=>$_POST["id"],
                  "idEstado"=>$_POST["idEstado"],				 
                  "idEquipo"=>$_POST["idEquipo"]
                             
				 ); 

            
          $respuesta = ModeloEquipos::mdlRechazarAprobacionCambioEstadoEquipo($datos);
        
          return $respuesta

?>