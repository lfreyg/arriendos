<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  

   $datos = array("idGuia"=>$_POST["idGuia"],
                  "idLog"=>$_POST["idLog"],
				      "idEquipo"=>$_POST["idEquipo"],
                  "precio"=>$_POST["precio"],                 
                  "detalle"=>$_POST["detalle"],
                  "idEmpresa"=>$_POST["idEmpresa"],
                  "tipoGuia"=>'TA'                                   
				 );

         
          $respuesta = ModeloGuiaDespachoDetalles::mdlIngresarGuiaDespachoTallerDetalle($datos);

          return $respuesta

?>