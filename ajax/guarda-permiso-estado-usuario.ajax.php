<?php

require_once "../modelos/estados.modelo.php";


   $datos = array("idEstado"=>$_POST["idEstado"],
                  "idUsuario"=>$_POST["idUsuario"]  
				 );  



          $respuesta = ModeloEstados::mdlAgregaPermiso($datos);

          return $respuesta

?>