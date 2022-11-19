<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";


  

   $datos = array("idGuia"=>$_POST["idGuia"],
				      "idMaterial"=>$_POST["idMaterial"],
                  "cantidad"=>$_POST["cantidad"],
                  "precio"=>$_POST["precio"],
                  "fecha"=>$_POST["fecha"],
                  "seCobra"=>$_POST["seCobra"],                  
                  "idEmpresa"=>$_POST["idEmpresa"]                                   
				 );

         
          $respuesta = ModeloGuiaDespachoDetalles::mdlIngresarMaterialGuiaDespacho($datos);

          return $respuesta

?>