<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  $datos = array("idRegistro"=>$_POST["idRegistro"]
);  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlQuitarValidarMaterialRecepcionado($datos);

          return $respuesta

?>