<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/obras.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];

$eeppCobro = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionSeleccion($idFactura);

ModeloFacturacionEEPP::mdlEliminarRegistrosFacturaSII($idFactura);

?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaEEPPFacturarPrevia" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="30%">Periodo EEPP</th>                     
                  <th width="10%">Total EEPP</th>  
                  
                </tr>

    </thead>
     <tbody>
   
  <?php
               $periodo = '';  
               $total_facturacion_eepp = 0;                 
            for($i = 0; $i < count($eeppCobro); $i++){   

              $id_eepp = $eeppCobro[$i]["id_eepp"];
              $fecha_eepp = $eeppCobro[$i]["fecha_eepp"];
              $fecha_corte = $eeppCobro[$i]["fecha_corte"];
              $total_equipos = $eeppCobro[$i]["total_equipos"];


              $dateReg = date_create($fecha_corte);
              $mes = date_format($dateReg,"m");
              $anno = date_format($dateReg,"Y");
              $nombreMes = ControladorEEPP::ctrNombreMeses($mes);

              $periodo .= ' - '.$nombreMes.'-'.$anno;
              

                        
            

              
              //FORMATEO DE FECHAS
               if($fecha_eepp != null){
                $dateReg1 = date_create($fecha_eepp);
                $fecha_eepp = date_format($dateReg1,"d-m-Y");
              }

              if($fecha_corte != null){
                $dateReg2 = date_create($fecha_corte);
                $fecha_corte = date_format($dateReg2,"d-m-Y");
              }
             
           
              //FIN FORMATEO DE FECHAS

             $materiales = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaMateriales($id_eepp);

             if($materiales){
                $montoMat = $materiales['total'];
             }else{
                $montoMat = 0;
             }

             $extras = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaExtras($id_eepp);

             if($extras){
                $montoextras = $extras['total'];
             }else{
                $montoextras = 0;
             }

             $dscto = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaDscto($id_eepp);

             if($dscto){
                $montodscto = $dscto['total'];
             }else{
                $montodscto = 0;
             }

             
            $total_facturacion_eepp_resumen = $total_equipos + $montoMat + $montoextras + $montodscto;

            $total_facturacion_eepp = $total_facturacion_eepp + $total_facturacion_eepp_resumen;
                          

      }

           $datos = array("idFactura"=>$idFactura,
                              "codigo"=>'EEPP',
                              "descripcion"=>$periodo,
                              "glosa"=>null,
                              "cantidad"=> 1,
                              "um"=> '',
                              "precio"=> $total_facturacion_eepp,
                              "valor"=> $total_facturacion_eepp,
                              "id_eepp"=>null

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);       
            
  ?>
  <tr>    
    <td ><div align="left"><?php echo $periodo?></div></td>      
    <td ><div align="right"><?php echo '$ '.number_format($total_facturacion_eepp,0,'','.')?></div></td> 
   
  </tr>  
   </tbody>
</table>

   






   



