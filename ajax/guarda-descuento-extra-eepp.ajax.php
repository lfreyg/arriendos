<?php

require_once "../modelos/eepp.modelo.php";
session_start();

   $datos = array("motivo"=>$_POST["motivo"],
				      "monto"=>$_POST["monto"],
                  "id"=>$_POST["id"],
                  "tipo"=>$_POST["tipo"],
                  "usuario"=>$_SESSION["id"],
                  "idEEPP"=>$_POST["idEEPP"]
				 );

       $respuesta = ModeloEEPP::mdlGuardarDescuentosExtras($datos);

          return $respuesta

?>