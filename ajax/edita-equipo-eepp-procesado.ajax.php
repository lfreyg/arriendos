<?php

require_once "../modelos/eepp.modelo.php";

   $datos = array("idRegistro"=>$_POST["idRegistro"],
                  "idEEPP"=>$_POST["idEEPP"],				 
                  "idGuia"=>$_POST["idGuia"],
                  "ultimo"=>$_POST["ultimo"],
                  "precio"=>$_POST["precio"],
                  "desde"=>$_POST["desde"],
                  "hasta"=>$_POST["hasta"]                                    
				 ); 

            


          $respuesta = ModeloEEPP::mdlEditarEquiposEEPPProcesado($datos);
        
          return $respuesta

?>