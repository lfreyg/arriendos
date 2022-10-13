<?php

require_once "../modelos/pedidoInternoDetalles.modelo.php";


   $datos = array("idEquipo"=>$_POST["idEquipo"],				 
                  "cantidad"=>$_POST["cantidad"],
                  "detalle"=>$_POST["detalle"]
                                    
				 );  

           

          $respuesta = ModeloPedidoInternoDetalles::mdlEditarEquiposPedidoInterno($datos);

          return $respuesta

?>