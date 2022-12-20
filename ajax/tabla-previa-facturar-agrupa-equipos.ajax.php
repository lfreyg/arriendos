<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];

$obtieneIdEEPP = ModeloFacturacionEEPP::mdlMostrarEEPPAsociadoFactura($idFactura);

 ModeloFacturacionEEPP::mdlEliminarRegistrosFacturaSII($idFactura);

?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaEEPPFacturarAgrupaEquipos" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="10%">Periodo</th>
                  <th width="10%">Descripcion</th>
                  <th width="5%">Precio</th>
                  <th width="5%">Cantidad</th>  
                  <th width="5%">UM</th> 
                  <th width="10%">Total</th>  
                </tr>

    </thead>
     <tbody>
   
  <?php

     for($x = 0; $x < count($obtieneIdEEPP); $x++){ 

             $id_eepp = $obtieneIdEEPP[$x]["id_eepp"];
             $fecha_corte = $obtieneIdEEPP[$x]["fecha_corte"];


      
              $dateReg = date_create($fecha_corte);
              $mes = date_format($dateReg,"m");
              $anno = date_format($dateReg,"Y");
              $nombreMes = ControladorEEPP::ctrNombreMeses($mes);

              $periodo = $nombreMes.'-'.$anno;

      $eeppCobro = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionAgrupaEquipos($id_eepp);
                                  
         for($i = 0; $i < count($eeppCobro); $i++){   

              $descripcion = $eeppCobro[$i]["descripcion"];
              $precio = $eeppCobro[$i]["precio"];
              $total_equipos = $eeppCobro[$i]["total_equipos"];
              $dias = $eeppCobro[$i]["dias"];
              
            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $periodo?></div></td> 
    <td ><div align="left"><?php echo $descripcion?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td> 
    <td ><div align="center"><?php echo $dias?></div></td> 
    <td ><div align="center">DÍAS</div></td>
    <td ><div align="right"><?php echo '$ '.number_format($total_equipos,0,'','.')?></div></td>    
  </tr>
  <?php
                
                $datos = array("idFactura"=>$idFactura,
                              "codigo"=>null,
                              "descripcion"=>$descripcion,
                              "glosa"=>"Corresponde al Periodo ". $periodo,
                              "cantidad"=> $dias,
                              "um"=> 'Días',
                              "precio"=> $precio,
                              "valor"=> $total_equipos,
                              "id_eepp"=>$id_eepp

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);

            } 

   $descuentosExtras = ModeloEEPP::mdlMostrarDescuentosExtras($id_eepp);

    if($descuentosExtras){
       for($i = 0; $i < count($descuentosExtras); $i++){   

              $tipo = $descuentosExtras[$i]["tipoActo"];            
              $fecha = $descuentosExtras[$i]["fecha"];
              $usuario = $descuentosExtras[$i]["usuario"];
              $descripcion = $descuentosExtras[$i]["descripcion"];
              $montoCambio = $descuentosExtras[$i]["montoCambio"];
              $cantidad = 1;
  ?>    
   <tr>   
    <td ><div align="left"><?php echo $periodo?></div></td> 
    <td ><div align="left"><?php echo $descripcion?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($montoCambio,0,'','.')?></div></td> 
    <td ><div align="center"><?php echo number_format($cantidad,0,'','.')?></div></td>
    <td ><div align="center"><?php echo $tipo?></div></td>
    <td ><div align="right"><?php echo '$ '.number_format($montoCambio,0,'','.')?></div></td>    
  </tr>

  

 <?php
            
               $datos = array("idFactura"=>$idFactura,
                              "codigo"=>null,
                              "descripcion"=>$descripcion,
                              "glosa"=>"Corresponde al Periodo ". $periodo,
                              "cantidad"=> $cantidad,
                              "um"=> '',
                              "precio"=> $montoCambio,
                              "valor"=> $montoCambio,
                              "id_eepp"=>$id_eepp

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);

     }
   }             

      $materiales = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionMateriales($id_eepp);

      if($materiales){
                             
         for($z = 0; $z < count($materiales); $z++){  

           $material =  $materiales[$z]["material"];
           $precioMat = $materiales[$z]["precio"];
           $cantidad = $materiales[$z]["cantidad"];
           $totalMat = $materiales[$z]["total"];

  ?>
  <tr>   
    <td ><div align="left"><?php echo $periodo?></div></td> 
    <td ><div align="left"><?php echo $material?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precioMat,0,'','.')?></div></td> 
    <td ><div align="center"><?php echo number_format($cantidad,0,'','.')?></div></td>
    <td ><div align="center">UND</div></td>
    <td ><div align="right"><?php echo '$ '.number_format($totalMat,0,'','.')?></div></td>    
  </tr>

  <?php

          $datos = array("idFactura"=>$idFactura,
                              "codigo"=>null,
                              "descripcion"=>$material,
                              "glosa"=>"Corresponde al Periodo ". $periodo,
                              "cantidad"=> $cantidad,
                              "um"=> 'UND',
                              "precio"=> $precioMat,
                              "valor"=> $totalMat,
                              "id_eepp"=>$id_eepp

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);
       }
     }

 }

  ?>
   </tbody>
</table>

   </tbody>
</table>






   



