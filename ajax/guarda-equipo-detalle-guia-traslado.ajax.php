<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  

   $datos = array("idGuia"=>$_POST["idGuia"],
				      "idEquipo"=>$_POST["idEquipo"],
                  "precio"=>1,
                  "tipoGuia"=>'T',
                  "id_pedido_interno"=>$_POST["idPedidoInterno"]
                                                   
				 );

         
          $respuesta = ModeloGuiaDespachoDetalles::mdlIngresarGuiaDespachoDetalleTraslado($datos);

          return $respuesta

?>