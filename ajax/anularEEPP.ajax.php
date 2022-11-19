<?php

require_once "../modelos/eepp.modelo.php";
session_start();

        
         
          $datos = array("idEEPP"=>$_POST["idEEPP"]
                                    
             ); 

         $idEEPP = $datos["idEEPP"];
        
         $detalleEEPP = ModeloEEPP::mdlAnularEEPP($idEEPP);
            
           
           $_SESSION["idEEPP"] = "";

           return "ok";
            


         

        

?>