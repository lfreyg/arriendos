<?php

require_once "../modelos/facturacionNCND.modelo.php";


   $datos = array("descripcion"=>$_POST["descripcion"],
                  "neto"=>$_POST["neto"],				 
                  "idFactura"=>$_POST["idFactura"],
                  "idTipoNC"=>$_POST["idTipoNC"],
                  "idNC"=>$_POST["idNC"],
                  "rut"=>$_POST["rut"],
                  "razon"=>$_POST["razon"],
                  "tele"=>$_POST["tele"],
                  "contacto"=>$_POST["contacto"],
                  "direccion"=>$_POST["direccion"],
                  "comuna"=>$_POST["comuna"],
                  "ciudad"=>$_POST["ciudad"],
                  "codigo"=>$_POST["codigo"],
                                                    
				 );  



          $respuesta = ModeloFacturacionNCND::mdlRegistrarDetalleNCSii($datos);

          return $respuesta

?>