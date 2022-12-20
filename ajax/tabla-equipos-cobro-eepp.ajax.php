<?php
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/obras.modelo.php";


 
$idObra = $_GET['idObra'];
$fecha = $_GET['fecha'];

$equiposCobro = ControladorEEPP::ctrMostrarEquiposParaCobro($idObra,$fecha);

?>

<form role="form" method="post" id="formdata">

  
                     
<label>EQUIPOS PARA COBRO</label>   
<table class="table-bordered table-striped table-hover dt-responsive" id="tablasEquiposCobro" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="5%">Guía</th>
                  <th width="5%">Contrato</th>
                  <th width="5%">Código</th>   
                  <th width="20%">Equipo</th>    
                  <th width="5%">Precio</th>
                  <th width="7%">Fecha Arriendo</th> 
                  <th width="7%">Fecha Term.</th> 
                  <th width="5%">Report</th> 
                  <th width="5%">Tipo Dev.</th>
                  <th width="5%">Último Cobro</th>
                  <th width="7%">Desde</th>
                  <th width="7%">Hasta</th>
                  <th width="5%">Días</th>
                  <th width="5%">Cobro</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
                                  
            for($i = 0; $i < count($equiposCobro); $i++){   

              $idGuiaDetalle = $equiposCobro[$i]["idGuiaDetalle"];
              $guia = $equiposCobro[$i]["guia"];
              $contrato = $equiposCobro[$i]["contrato"];
              $codigo = $equiposCobro[$i]["codigo"];
              $equipo = $equiposCobro[$i]["descripcion"].' '.$equiposCobro[$i]["modelo"].' '.$equiposCobro[$i]["marca"];
              $precio = $equiposCobro[$i]["precio"];
              $fecArriendo = $equiposCobro[$i]["fecha_arriendo"];
              $fecDevolucion = $equiposCobro[$i]["fecha_devolucion"];
              $report = $equiposCobro[$i]["report_devolucion"];
              $tipoDevolucion = $equiposCobro[$i]["tipo_devolucion"];
              $tipoDevolucionNombre = $equiposCobro[$i]["nombreDevolucion"];
              $ultimo_cobro = $equiposCobro[$i]["ultimo_cobro"];
              $matchCambio = $equiposCobro[$i]["match_cambio"];

              $obraConsulta = ModeloObras::mdlMostrarObrasPorId($idObra);
              $tipoCobro = $obraConsulta["tipoCobro"];

             
             $preguntaFechaDevolucion = strtotime($fecDevolucion);
             $preguntaFechaEEPP = strtotime($fecha);

             if($fecDevolucion != null){
              if( $preguntaFechaDevolucion <= $preguntaFechaEEPP){
                $fechaHasta = $equiposCobro[$i]["fecha_devolucion"];
              }else{
                $fechaHasta = $fecha;
              }
            }else{
                $fechaHasta = $fecha;
              }

             

             

             
              $fechaDesde = $equiposCobro[$i]["fecha_desde"];
              
             if($tipoCobro == 'LUNES A LUNES'){
                $dias = 0;   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          
                          if($day == 'Monday'){
                            $dias ++;
                          }

                          if($day == 'Tuesday'){
                            $dias ++;
                          }

                          if($day == 'Wednesday'){
                            $dias ++;
                          }

                         if($day == 'Thursday'){
                            $dias ++;
                          }

                          if($day == 'Friday'){
                            $dias ++;
                          }

                          if($day == 'Saturday'){
                            $dias ++;
                          }

                          if($day == 'Sunday'){
                            $dias ++;
                          }
                      }
             }  
             
             if($tipoCobro == 'LUNES A VIERNES'){                 
                  $dias = 0;   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          
                          if($day == 'Monday'){
                            $dias ++;
                          }

                          if($day == 'Tuesday'){
                            $dias ++;
                          }

                          if($day == 'Wednesday'){
                            $dias ++;
                          }

                         if($day == 'Thursday'){
                            $dias ++;
                          }

                          if($day == 'Friday'){
                            $dias ++;
                          }
                      }
            
           
             }   

             if($tipoCobro == 'LUNES A SABADO'){
                  $dias = 0;   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          
                          if($day == 'Monday'){
                            $dias ++;
                          }

                          if($day == 'Tuesday'){
                            $dias ++;
                          }

                          if($day == 'Wednesday'){
                            $dias ++;
                          }

                         if($day == 'Thursday'){
                            $dias ++;
                          }

                          if($day == 'Friday'){
                            $dias ++;
                          }

                          if($day == 'Saturday'){
                            $dias ++;
                          }
                      }
             }  

              
              //FORMATEO DE FECHAS
               if($fecArriendo != null){
                $dateReg1 = date_create($fecArriendo);
                $fecArriendo = date_format($dateReg1,"d-m-Y");
              }

              if($fecDevolucion != null){
                $dateReg2 = date_create($fecDevolucion);
                $fecDevolucion = date_format($dateReg2,"d-m-Y");
              }

              if($ultimo_cobro != null){
                $dateReg3 = date_create($ultimo_cobro);
                $ultimo_cobro = date_format($dateReg3,"d-m-Y");
              }

              if($fechaDesde != null){
                $dateReg4 = date_create($fechaDesde);
                $fechaDesde = date_format($dateReg4,"d-m-Y");
              }

              if($fechaHasta != null){
                $dateReg5 = date_create($fechaHasta);
                $fechaHasta = date_format($dateReg5,"d-m-Y");
              }


              //FIN FORMATEO DE FECHAS

                          

              $cobro = $dias * $precio;

              $estilo = '';

              if($tipoDevolucion == 11){
                $estilo = 'style="background-color: rgb(102, 255, 153)"';
              }

            
  ?>
  <tr <?php echo $estilo?>>    
    <td ><div align="center"><?php echo $guia?></div></td> 
    <td ><div align="center"><?php echo $contrato?></div></td> 
    <td ><div align="left"><?php echo $codigo?></div></td> 
    <td ><div align="left"><?php echo $equipo?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td>   
    <td ><div align="center"><?php echo $fecArriendo?></div></td>   
    <td ><div align="center"><?php echo $fecDevolucion?></div></td>   
    <td ><div align="center"><?php echo $report?></div></td>   
    <td ><div align="left"><?php echo $tipoDevolucionNombre?></div></td>   
    <td ><div align="center"><?php echo $ultimo_cobro?></div></td>   
    <td ><div align="center"><?php echo $fechaDesde?></div></td>   
    <td ><div align="center"><?php echo $fechaHasta?></div></td>   
    <td ><div align="center"><?php echo $dias?></div></td>   
    <td ><div align="right"><?php echo '$ '. number_format($cobro,0,'','.')?></div></td>   
    
    
  </tr>
  <?php

    
      if($matchCambio != null){
           $QueryequipoMatch = ControladorEEPP::ctrEquiposCambiadosEEPP($matchCambio);

        
       
       if($QueryequipoMatch){
           $codigoCambio = $QueryequipoMatch[0]["codigo"];
           $equipoCambio = $QueryequipoMatch[0]["equipo"];
           $modeloCambio = $QueryequipoMatch[0]["modelo"];
           $marcaCambio =  $QueryequipoMatch[0]["marca"];
           $guiaCambio = $QueryequipoMatch[0]["gd"];
           $fechaArriendoCambio = $QueryequipoMatch[0]["fecha_arriendo"];
           $dateReg1 = date_create($fechaArriendoCambio);
           $fechaArriendoCambio = date_format($dateReg1,"d-m-Y");

           $nombreEquipoCambio = $equipoCambio.' '.$modeloCambio.' '.$marcaCambio;

         echo '<tr>';
         echo '<td colspan = 13>';
         echo '<strong>'; 
         echo 'Equipo cambiado por '.$nombreEquipoCambio.' Código '.$codigoCambio.' Entregado con fecha '.$fechaArriendoCambio.' en la GD '.$guiaCambio;
         echo '</strong>'; 
         echo '</td>';
         echo '</tr>'; 
       }



      }
            


            }  

  ?>
   </tbody>
</table>
<br>
<br>

<?php
 $materialesCobro = ControladorEEPP::ctrMostrarMaterialesParaCobro($idObra, $fecha);

 if($materialesCobro){

  ?>
        
  <label style="background-color: rgb(102, 255, 153)">MATERIALES Y/O INSUMOS PARA COBRO</label> 
   <table class="table-bordered table-striped table-hover dt-responsive" id="tablasMaterialesCobro" width="70%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr > 
                  <th width="5%">Guía</th>
                  <th width="10%">Fecha</th>
                  <th width="10%">Código</th>
                  <th width="40%">Material-Insumo</th>
                  <th width="10%">Cantidad</th>                  
                  <th width="10%">Precio</th>                     
                  <th width="20%">Cobro</th>                  
                </tr>

    </thead>
     <tbody>
   
  <?php
            
          
                               
            for($i = 0; $i < count($materialesCobro); $i++){   

              $idRegistro = $materialesCobro[$i]["idRegistro"];
              $guiaMaterial = $materialesCobro[$i]["guia"];
              $fecha = $materialesCobro[$i]["fecha"];
              $codigo = $materialesCobro[$i]["codigoMaterial"];
              $material = $materialesCobro[$i]["material"];
              $cantidad = $materialesCobro[$i]["cantidad"];
              $precio = $materialesCobro[$i]["precio"];
              $total = $materialesCobro[$i]["total"];
              
              
             

              $datetime = date_create($fecha);
              $fecha =  date_format($datetime,"d-m-Y");

             

             

            

            

            
  ?>
  <tr>
    <td ><div align="center"><?php echo $guiaMaterial?></div></td> 
    <td ><div align="center"><?php echo $fecha?></div></td> 
     <td ><div align="left"><?php echo $codigo?></div></td> 
    <td ><div align="left"><?php echo $material?></div></td>    
    <td ><div align="center"><?php echo number_format($cantidad,0,'','.')?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td>
    <td ><div align="right"><?php echo '$ '.number_format($total,0,'','.')?></div></td>  
     
    
    
  </tr>
 <?php          


      }  
    }

  ?>
   </tbody>
</table>






   

</form>


