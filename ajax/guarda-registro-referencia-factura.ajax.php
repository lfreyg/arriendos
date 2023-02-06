<?php

require_once "../modelos/facturacion.modelo.php";
   
  

   $datos = array("idFactura"=>$_POST["idFactura"],
                  "idOC"=>$_POST["idOC"],				 
                  "idReferencia"=>$_POST["idReferencia"],
                  "numero"=>$_POST["numero"],
                  "fechaRef"=>$_POST["fechaRef"]                                    
				 );  

              
          $respuesta = ModeloFacturacionEEPP::mdlAgregaReferenciaFactura($datos);

          return $respuesta

?>