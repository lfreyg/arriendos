<?php

require_once "../modelos/pedidoDetalles.modelo.php";


   $datos = array("id"=>$_POST["idEquipo"],				 
                  "tipo"=>$_POST["tipo"],
                  "detalle"=>$_POST["detalle"]
                                    
				 );  

             $tabla = "pedido_equipo_detalle";

          $respuesta = ModeloPedidoDetalles::mdlEditarEquiposPedido($tabla, $datos);

          return $respuesta

?>