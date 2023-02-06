<?php

require_once "../modelos/pedidoDetalles.modelo.php";

  
  //id_nombre_equipos es el id de la categoria del equipo, se modifica para que solo tome las categorias en el pedido de obras
  

   $datos = array("id_nombre_equipos"=>$_POST["id_nombre_equipos"],
				      "id_pedido"=>$_POST["id_pedido"],
                  "detalle"=>$_POST["detalle"],
                  "tipo"=>$_POST["tipo"],
                  "constructora"=>$_POST["constructora"],
                  "obra"=>$_POST["obra"]                                   
				 );

          $tabla = "pedido_equipo_detalle";

          $respuesta = ModeloPedidoDetalles::mdlIngresarPedidoDetalle($tabla, $datos);

          return $respuesta

?>