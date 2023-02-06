<?php

require_once "../modelos/facturacionNCND.modelo.php";


   $datos = array("idRegistroFacSII"=>$_POST["idRegistroFacSII"],
				      "id_eepp"=>$_POST["id_eepp"],                
                  "idFactura"=>$_POST["idFactura"],
                  "idND"=>$_POST["idND"],
                  "precio"=>$_POST["precio"]                      
				 );  
      
        

          $respuesta = ModeloFacturacionNCND::mdlGuardaRegistroNDSII($datos);

          echo $respuesta

?>