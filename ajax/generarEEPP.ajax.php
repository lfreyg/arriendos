<?php

require_once "../modelos/eepp.modelo.php";
session_start();

        
         
          $datos = array("idConstructora"=>$_POST["idConstructora"],           
                  "idObra"=>$_POST["idObra"],
                  "fecha"=>$_POST["fecha"]
                                    
             ); 

         $idConstructora = $datos["idConstructora"];
         $idObra = $datos["idObra"];
         $fecha = $datos["fecha"];

          
          $validaEEPP = ModeloEEPP::mdlValidaEEPPMes($idObra, $fecha);
          $idEEPP = 0;

          if($validaEEPP){
             $idEEPP = $validaEEPP["id"];
             $editaEEPP = ModeloEEPP::mdlEditaFechaEEPP($idEEPP, $fecha);
          }

          if($validaEEPP == 0){
            $idEEPPRespuesta = ModeloEEPP::mdlGenerarEEPP($idConstructora,$idObra,$fecha);

            if($idEEPPRespuesta == 'error'){
               return 'error';
            }else{
               $idEEPP = $idEEPPRespuesta["id"];
            }
            
          }

            $detalleEEPP = ModeloEEPP::mdlGenerarDetalleEEPP($idEEPP,$idObra,$fecha);
            
           
           $_SESSION["idEEPP"] = $detalleEEPP["id"];

           return "ok";
            


         

        

?>