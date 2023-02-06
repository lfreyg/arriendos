<?php

require_once "../modelos/equipos.modelo.php";

   $datos = array("idEquipo"=>$_POST["idEquipo"],
                  "idUsuario"=>$_POST["idUsuario"],				 
                  "idEstado"=>$_POST["idEstado"],
                  "nuevoEstado"=>$_POST["nuevoEstado"],
                  "estadoTransitorio"=>$_POST["estadoTransitorio"],
                  "fechaCambio"=>$_POST["fechaCambio"],
                  "motivo"=>$_POST["motivo"],
                  "idGuiaDetalle"=>$_POST["idGuiaDetalle"]

                                                    
				 ); 

            


          $respuesta = ModeloEquipos::mdlCambiarEstadoEquipo($datos);
        
          return $respuesta

?>