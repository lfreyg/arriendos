<?php

require_once "../modelos/eepp.modelo.php";

   $datos = array("idRegistro"=>$_POST["idRegistro"],
                  "idEEPP"=>$_POST["idEEPP"],				 
                  "idGuia"=>$_POST["idGuia"],                
                  "precio"=>$_POST["precio"]                                                      
				 ); 

            


          $respuesta = ModeloEEPP::mdlEditarMaterialEEPPProcesado($datos);
        
          return $respuesta

?>