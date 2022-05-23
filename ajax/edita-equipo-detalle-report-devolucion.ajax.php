<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";


   $datos = array("id"=>$_POST["idArriendo"],
                  "fecha_termino"=>$_POST["fechaTermino"],				 
                  "movimiento"=>$_POST["movimiento"],
                  "detalle"=>$_POST["detalle"]
                                    
				 );  

            
          $respuesta = ModeloReportDevolucionDetalles::mdlEditarEquiposRetirado($datos);

          return $respuesta

?>