<?php

require_once "../modelos/ordenCompra.modelo.php";


   $datos = array("id_oc_arriendo"=>$_POST["id_oc_arriendo"],
				          "numero_oc"=>$_POST["numero_oc"],                
                  "id_constructora"=>$_POST["id_constructora"],
                  "id_obra"=>$_POST["id_obra"],                  
                  "id_eepp"=>$_POST["id_eepp"],
                  "id_eepp_detalle"=>$_POST["id_eepp_detalle"],
                  "precio_oc"=>$_POST["precio_oc"],
                  "cantidad_oc"=>$_POST["cantidad_oc"],  
                  "tabla"=>$_POST["tabla"]                                                  
				 );  
      
        

          $respuesta = ModeloOrdenCompra::mdlIngresarDetalleOC($datos);

          echo $respuesta

?>