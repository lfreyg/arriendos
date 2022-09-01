<?php

require_once "../modelos/facturasDetalles.modelo.php";


   $datos = array("id_nombre_equipos"=>$_POST["id_nombre_equipos"],
				  "id_factura"=>$_POST["id_factura"],
                  "codigo"=>$_POST["codigo"],
                  "numero_serie"=>$_POST["numero_serie"],
                  "precio_compra"=>$_POST["precio_compra"],  
                  "id_sucursal"=>$_POST["id_sucursal"]
				 );

          $tabla = "equipos";

          $respuesta = ModeloFacturasDetalles::mdlIngresarFacturasDetalle($tabla, $datos);

          return $respuesta

?>