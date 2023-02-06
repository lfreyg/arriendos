<?php

require_once "../modelos/equipos.modelo.php";
session_start();

    $datos = array("id"=>$_POST["id"],
                  "idEstado"=>$_POST["idEstado"],            
                  "idEquipo"=>$_POST["idEquipo"],                
                  "idAprueba"=>$_SESSION["id"],
                  "idEstadoAnterior"=>$_POST["idEstadoAnterior"]
                             
             ); 

      
            
          $respuesta = ModeloEquipos::mdlValidaAprobacionCambioEstadoEquipo($datos);
        
          return $respuesta

?>