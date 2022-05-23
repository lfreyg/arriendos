<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";


  

   $datos = array("idRegistroGuiaDetalle"=>$_POST["idRegistroGuiaDetalle"],
				      "idEquipo"=>$_POST["idEquipo"],                
                  "fechaRetiro"=>$_POST["fechaRetiro"],
                  "detalle"=>$_POST["detalle"],                  
                  "movimiento"=>$_POST["movimiento"],
                  "idReportDevolucion"=>$_POST["idReportDevolucion"]                                                   
				 );          

          $respuesta = ModeloReportDevolucionDetalles::mdlRegistrarRetiro($datos);

          return $respuesta

?>