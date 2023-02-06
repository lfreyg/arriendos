<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/facturacionOC.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];
$idOC = $_GET['idOC'];

$obtieneIdEEPP = ModeloFacturacionEEPPOC::mdlMostrarEEPPAsociadoFacturaOC($idFactura);

 ModeloFacturacionEEPP::mdlEliminarRegistrosFacturaSII($idFactura);

?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaEEPPFacturarDetalleEquipos" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="7%">Periodo</th>
                  <th width="20%">Descripcion</th>
                  <th width="5%">Precio</th>
                  <th width="5%">Cantidad</th>  
                  <th width="5%">UM</th> 
                  <th width="5%">Total</th>  
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

      $eeppCobro = ModeloFacturacionEEPPOC::mdlMostrarEEPPFacturacionDetalleEquiposOC($id_eepp, $idOC);
                                  
         for($i = 0; $i < count($eeppCobro); $i++){   

              $codigo = $eeppCobro[$i]["codigo"];
              $descripcion = $eeppCobro[$i]["descripcion"];
              $precio = $eeppCobro[$i]["precio"];
              $total_equipos = $eeppCobro[$i]["total_equipos"];
              $dias = $eeppCobro[$i]["dias"];
              $guia = $eeppCobro[$i]["guia"];
              $fechaArriendo = $eeppCobro[$i]["fecha_arriendo"];
              $desde = $eeppCobro[$i]["cobro_desde"];
              $hasta = $eeppCobro[$i]["cobro_hasta"];
              $descripcionCod = $codigo.' / '.$descripcion;

              $report = $eeppCobro[$i]['report_devolucion'];

              $devolucionTxt = '';
              if($report != 0){
                $devolucionTxt = ', Devuelto con Report '.$report;
              }

              
              $dateReg1 = date_create($fechaArriendo);
              $fechaArriendo = date_format($dateReg1,"d-m-Y");

              $dateReg1 = date_create($desde);
              $desde = date_format($dateReg1,"d-m-Y");

              $dateReg1 = date_create($hasta);
              $hasta = date_format($dateReg1,"d-m-Y");

              $glosa = 'Corresponde al mes de '.$periodo.', desde '.$desde.' (con GD '.$guia.') hasta '.$hasta.$devolucionTxt;
              
            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $periodo?></div></td> 
    <td ><div align="left"><?php echo $descripcionCod?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td> 
    <td ><div align="center"><?php echo $dias?></div></td> 
    <td ><div align="center">DÍAS</div></td>
    <td ><div align="right"><?php echo '$ '.number_format($total_equipos,0,'','.')?></div></td>    
  </tr>
  <?php

               $datos = array("idFactura"=>$idFactura,
                              "codigo"=>$codigo,
                              "descripcion"=>$descripcion,
                              "glosa"=>$glosa,
                              "cantidad"=> $dias,
                              "um"=> 'Días',
                              "precio"=> $precio,
                              "valor"=> $total_equipos,
                              "id_eepp"=>$id_eepp

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);


            } 

   $descuentosExtras = ModeloFacturacionEEPPOC::mdlMostrarDescuentosExtrasOC($id_eepp, $idOC);

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
                              "glosa"=>'Corresponde al Periodo '.$periodo,
                              "cantidad"=> $cantidad,
                              "um"=> '',
                              "precio"=> $montoCambio,
                              "valor"=> $montoCambio,
                              "id_eepp"=>$id_eepp

                                                                   
             );  

               $valida = ModeloFacturacionEEPP::mdlInsertarRegistrosFacturaSII($datos);
     }
   }             

      $materiales = ModeloFacturacionEEPPOC::mdlMostrarEEPPFacturacionMaterialesOC($id_eepp, $idOC);

      if($materiales){
                             
         for($z = 0; $z < count($materiales); $z++){  

           $material =  $materiales[$z]["material"];
           $precioMat = $materiales[$z]["precio"];
           $cantidad = $materiales[$z]["cantidad"];
           $totalMat = $materiales[$z]["total"];
           $codigo = $materiales[$z]["codigo"];
           $guia  = $materiales[$z]["guia"];

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
                              "codigo"=>$codigo,
                              "descripcion"=>$material,
                              "glosa"=>"Corresponde al Periodo ". $periodo." GD ".$guia,
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



<script type="text/javascript">
      $(document).ready(function() {

        $.extend( true, $.fn.dataTable.defaults, {
            "searching": true,
            "ordering": false
        } );

        var idioma_espanol = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron registros",
                "sEmptyTable":     "No existen registros",
                "sInfo":           "_START_ al _END_  de _TOTAL_ registros",
                "sInfoEmpty":      "0 registros",
                "sInfoFiltered":   "( de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
                },
                "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
              }

          $('#tablaEEPPFacturarDetalleEquipos').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>


   



