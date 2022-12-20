<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];

$obtieneIdEEPP = ModeloFacturacionEEPP::mdlMostrarEEPPAsociadoFactura($idFactura);


?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaDetalleFacturadoActual" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="10%">EEPP</th>
                  <th width="10%">Monto EEPP</th>
                  <th width="10%">Facturado</th>
                  <th width="10%">Por Facturar</th> 
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

      $eeppCobro = ModeloFacturacionEEPP::mdlTotalEEPP($id_eepp);
                                  
         

              $montoEEPP = $eeppCobro["total_eepp"];

              $factura = ModeloFacturacionEEPP::mdlMontoFacturadoEEPP($id_eepp);

              if(!$factura){
                $montoFacturado = 0;
              }else{
                $montoFacturado = $factura["totalFactura"];
              }

              $saldo = $montoEEPP - $montoFacturado;

              if($saldo < 0){
             //   $saldo = 0;
              }


                            
            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $periodo?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($montoEEPP,0,'','.')?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($montoFacturado,0,'','.')?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($saldo,0,'','.')?></div></td>        
  </tr>
  <?php
                
                

             


 }

  ?>
   </tbody>
</table>

   </tbody>
</table>






   



