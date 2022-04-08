<?php

require_once "../modelos/pedidoDetalles.modelo.php";


  

   $datos = array("id_nombre_equipos"=>$_POST["id_nombre_equipos"],
				      "id_pedido"=>$_POST["id_pedido"],
                  "detalle"=>$_POST["detalle"],
                  "tipo"=>$_POST["tipo"]                                   
				 );

          $tabla = "pedido_equipo_detalle";

          $respuesta = ModeloPedidoDetalles::mdlIngresarPedidoDetalle($tabla, $datos);

          return $respuesta

?>