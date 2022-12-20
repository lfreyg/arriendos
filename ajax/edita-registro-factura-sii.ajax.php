<?php

require_once "../modelos/facturacion.modelo.php";


   $datos = array("idRegistroSII"=>$_POST["idRegistroSII"],
                  "codigoSII"=>$_POST["codigoSII"],				 
                  "descripcionSII"=>$_POST["descripcionSII"],
                  "glosaSII"=>$_POST["glosaSII"],
                  "cantidadSII"=>$_POST["cantidadSII"],
                  "precioSII"=>$_POST["precioSII"],
                                    
				 );  

              
          $respuesta = ModeloFacturacionEEPP::mdlActualizaRegistroFacturaSII($datos);

          return $respuesta

?>