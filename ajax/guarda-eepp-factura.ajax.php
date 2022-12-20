<?php

require_once "../modelos/facturacion.modelo.php";


   $datos = array("idEEPP"=>$_POST["idEEPP"],
				      "idFactura"=>$_POST["idFactura"]               
                                                                   
				 );  
          


          $respuesta = ModeloFacturacionEEPP::mdlIngresarFacturaEEPP($datos);

          echo $respuesta

?>