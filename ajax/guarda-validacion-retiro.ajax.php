<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";

  
   $datos = array("idRegistro"=>$_POST["idRegistro"],
                  "tipo"=>$_POST["tipo"]
               );
  

          $respuesta = ModeloReportDevolucionDetalles::mdlValidaEquipoRetiro($datos);

          return $respuesta;

?>