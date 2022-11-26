<?php

require_once "../modelos/eepp.modelo.php";
session_start();

        
         
          $datos = array("idEEPP"=>$_POST["idEEPP"],           
                  "idObra"=>$_POST["idObra"],
                  "fechaEEPP"=>$_POST["fechaEEPP"],
                  "mes"=>$_POST["mes"],
                  "anno"=>$_POST["anno"]

                                    
             ); 

         $idEEPP = $datos["idEEPP"];
         $idObra = $datos["idObra"];
         $fechaEEPP = $datos["fechaEEPP"];
         $mes = $datos["mes"];
         $anno = $datos["anno"];
         $edita = 1;

         $_SESSION["idEEPP"] = $idEEPP; 
         $_SESSION["fechaEEPP"] = $fechaEEPP;
         $_SESSION["idObraEEPP"] = $idObra;
         $_SESSION["editaEEPP"] = $edita; 
         $_SESSION["mesEditaEEPP"] = $mes;  
         $_SESSION["anoEditaEEPP"] = $anno;   
        
         return "ok";
            


         

        

?>