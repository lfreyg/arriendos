<?php

require_once "../modelos/estados.modelo.php";


   $datos = array("idRegistro"=>$_POST["idRegistro"]
				 );  



          $respuesta = ModeloEstados::mdlQuitarPermiso($datos);

          return $respuesta

?>