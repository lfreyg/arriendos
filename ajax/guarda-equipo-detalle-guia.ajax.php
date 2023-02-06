<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";

               if(isset($_POST["idPedidoObra"])){
                  $idPedidoObra = $_POST["idPedidoObra"];
               }else{
                  $idPedidoObra = 0;
               }

  

   $datos = array("idGuia"=>$_POST["idGuia"],
				      "idEquipo"=>$_POST["idEquipo"],
                  "precio"=>$_POST["precio"],
                  "fechaArriendo"=>$_POST["fechaArriendo"],
                  "detalle"=>$_POST["detalle"],
                  "fechaDevolucion"=>$_POST["fechaDevolucion"],
                  "contrato"=>$_POST["contrato"],
                  "movimiento"=>$_POST["movimiento"],
                  "idEmpresa"=>$_POST["idEmpresa"],
                  "idPedidoObra"=>$idPedidoObra                                   
				 );

         
          $respuesta = ModeloGuiaDespachoDetalles::mdlIngresarGuiaDespachoDetalle($datos);


          

          return $respuesta

?>