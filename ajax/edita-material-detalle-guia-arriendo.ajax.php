<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


   $datos = array("idMaterial"=>$_POST["idMaterial"],
                  "idRegistro"=>$_POST["idRegistro"],				 
                  "precio"=>$_POST["precio"],
                  "cantidad"=>$_POST["cantidad"],
                  "cantidadActual"=>$_POST["cantidadActual"],
                  "cobra"=>$_POST["cobra"],

                                    
				 );  

            
          $respuesta = ModeloGuiaDespachoDetalles::mdlEditarMaterialGuiaDespacho($datos);

          return $respuesta

?>