<?php

require_once "../modelos/equipos.modelo.php";

   $datos = array("idEquipo"=>$_POST["idEquipo"],
                  "codigoEquipo"=>$_POST["codigoEquipo"],				 
                  "serieEquipo"=>$_POST["serieEquipo"],
                  "precioCompra"=>$_POST["precioCompra"],
                  "sucursal"=>$_POST["sucursal"],
                  "idUsuario"=>$_POST["idUsuario"]                                   
				 ); 

            


          $respuesta = ModeloEquipos::mdlEditarEquiposMantenedor($datos);
        
          return $respuesta

?>