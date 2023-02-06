<?php

require_once "../modelos/facturacionNCND.modelo.php";


   $datos = array("idRegistroFacSII"=>$_POST["idRegistroFacSII"],
				      "id_eepp"=>$_POST["id_eepp"],                
                  "idFactura"=>$_POST["idFactura"],
                  "idNC"=>$_POST["idNC"],
                  "precio"=>$_POST["precio"]                      
				 );  
      
        

          $respuesta = ModeloFacturacionNCND::mdlGuardaRegistroNCSII($datos);

          echo $respuesta

?>