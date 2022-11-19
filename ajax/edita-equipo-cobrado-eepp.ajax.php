<?php

require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/obras.modelo.php";


   $idEEPP = $_POST["idEEPP"];

               

          $respuesta = ModeloEEPP::mdlMostrarEquiposProcesados($idEEPP);

          return $respuesta

?>