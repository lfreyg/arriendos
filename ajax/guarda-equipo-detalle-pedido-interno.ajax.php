<?php

require_once "../modelos/pedidoInternoDetalles.modelo.php";


  

   $datos = array("idCategoria"=>$_POST["idCategoria"],
				      "id_pedido"=>$_POST["id_pedido"],
                  "detalle"=>$_POST["detalle"],
                  "cantidad"=>$_POST["cantidad"],
                  "tengo"=>$_POST["tengo"],  
                  "disponible"=>$_POST["disponible"],
                  "revision"=>$_POST["revision"]                                 
				 );

         
          $respuesta = ModeloPedidoInternoDetalles::mdlIngresarPedidoInternoDetalle($datos);

          return $respuesta

?>