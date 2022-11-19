<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


   $datos = array("idRegistro"=>$_POST["idRegistro"]
);  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlValidarMaterialRecepcionado($datos);

          return $respuesta

?>