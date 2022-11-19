<?php

require_once "../modelos/eepp.modelo.php";

   $datos = array("idEEPP"=>$_POST["idEEPP"],
                  "desde"=>$_POST["desde"],
                  "hasta"=>$_POST["hasta"],
                  "tipoCobro"=>$_POST["tipoCobro"]
             );

   
   $idEEPP = $datos["idEEPP"];
	$fechaDesde = $datos["desde"];
   $fechaHasta = $datos["hasta"];
   $tipoCobro = $datos["tipoCobro"];
   $respuesta = 'ok';

    if($tipoCobro == 'LUNES A LUNES'){
                   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                  
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);

                           $fechaDia = date('Y-m-d',$z);

                         $validaFecha = ModeloEEPP::mdlValidaDiaDescuento($idEEPP, $fechaDia);  

                        if(!$validaFecha){
                         $respuesta = ModeloEEPP::mdlGuardaDiaDescuento($idEEPP, $fechaDia);
                        }
                      
                          
                          
                      }
             }  
             
             if($tipoCobro == 'LUNES A VIERNES'){                 
                   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          $valida = 0;

                           $fechaDia = date('Y-m-d',$z);
                          
                          if($day == 'Monday'){
                            $valida = 1;
                          }

                          if($day == 'Tuesday'){
                            $valida = 1;
                          }

                          if($day == 'Wednesday'){
                            $valida = 1;
                          }

                         if($day == 'Thursday'){
                            $valida = 1;
                          }

                          if($day == 'Friday'){
                            $valida = 1;
                          }

                          if($valida == 1){  
                              $validaFecha = ModeloEEPP::mdlValidaDiaDescuento($idEEPP, $fechaDia);  

                              if(!$validaFecha){
                               $respuesta = ModeloEEPP::mdlGuardaDiaDescuento($idEEPP, $fechaDia);
                              }
                         }

                      }
            
           
             }   

             if($tipoCobro == 'LUNES A SABADO'){
                        
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          $valida = 0;

                          $fechaDia = date('Y-m-d',$z);
                          
                          if($day == 'Monday'){
                            $valida = 1; 
                          }

                          if($day == 'Tuesday'){
                            $valida = 1; 
                          }

                          if($day == 'Wednesday'){
                            $valida = 1; 
                          }

                         if($day == 'Thursday'){
                            $valida = 1; 
                          }

                          if($day == 'Friday'){
                            $valida = 1; 
                          }

                          if($day == 'Saturday'){
                            $valida = 1; 
                          }

                        if($valida == 1){  
                              $validaFecha = ModeloEEPP::mdlValidaDiaDescuento($idEEPP, $fechaDia);  

                              if(!$validaFecha){
                              $respuesta =  ModeloEEPP::mdlGuardaDiaDescuento($idEEPP, $fechaDia);
                              }
                         }

                      }

                      
             }  
              


          return $respuesta;

?>