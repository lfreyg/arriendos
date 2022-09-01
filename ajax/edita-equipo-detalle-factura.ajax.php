<?php

require_once "../modelos/equipos.modelo.php";


   $datos = array("id"=>$_POST["idEquipo"],				 
                  "codigo"=>$_POST["codigo"],
                  "numero_serie"=>$_POST["numero_serie"],
                  "precio_compra"=>$_POST["precio_compra"],
                  "id_sucursal"=>$_POST["id_sucursal"]                  
				 );  

             $tabla = "equipos";

          $respuesta = ModeloEquipos::mdlEditarEquipos($tabla, $datos);

          return $respuesta

?>