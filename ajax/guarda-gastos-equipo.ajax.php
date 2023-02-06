<?php

require_once "../modelos/equipos.modelo.php";

   $datos = array("idEquipo"=>$_POST["idEquipo"],
                  "idUsuario"=>$_POST["idUsuario"],				 
                  "taller"=>$_POST["taller"],
                  "factura"=>$_POST["factura"],
                  "neto"=>$_POST["neto"],
                  "fecha"=>$_POST["fecha"],
                  "detalle"=>$_POST["detalle"]
                  

                                                    
				 ); 

            


          $respuesta = ModeloEquipos::mdlAgregaGastoEquipo($datos);
        
          return $respuesta

?>