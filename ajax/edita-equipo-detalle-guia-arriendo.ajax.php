<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


   $datos = array("id"=>$_POST["idArriendo"],
                  "fecha_arriendo"=>$_POST["fechaArriendo"],				 
                  "id_tipo_movimiento"=>$_POST["movimiento"],
                  "detalle"=>$_POST["detalle"]
                                    
				 );  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlEditarEquiposGuiaDespacho($datos);

          return $respuesta

?>