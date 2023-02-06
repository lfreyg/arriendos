<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/ordenCompra.modelo.php";

 
$id_eepp = $_POST['id'];
$idOC = $_POST['idOC'];


?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaEEPPAsociaOC" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="5%">GD</th>
                  <th width="8%">Código</th>
                  <th width="22%">Descripción</th>
                  <th width="5%">Precio</th>
                  <th width="3%">Cantidad</th>  
                  <th width="3%">Cant.OC</th>
                  <th width="3%">Saldo</th>                   
                  <th width="5%">Acción</th>  
                </tr>

    </thead>
     <tbody>
   
  <?php           

      $eeppCobro = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionDetalleEquipos($id_eepp);
                                  
         for($i = 0; $i < count($eeppCobro); $i++){   

              $idDetalleEEPP = $eeppCobro[$i]["idRegistro"];
              $codigo = $eeppCobro[$i]["codigo"];
              $descripcion = $eeppCobro[$i]["descripcion"];
              $precio = $eeppCobro[$i]["precio"];             
              $dias = $eeppCobro[$i]["dias"];
              $guia = $eeppCobro[$i]["guia"];  

              $tipoTabla = 'EQUIPOS';

               $datos = array("id"=>$idDetalleEEPP,
                              "tipoTabla"=>$tipoTabla             
             );  

              $cantidad_oc = ModeloOrdenCompra::mdlObtenerCantidadesEEPPOC($datos);
              
              if($cantidad_oc){
                 $canOCSumado = $cantidad_oc["cantidad"];
             }else{
                 $canOCSumado = 0;
             }

              $saldo = $dias - $canOCSumado;
              
              $disable = '';

              if($saldo <= 0){
                $disable = 'disabled';
              }  

               $datos2 = array("id"=>$idDetalleEEPP,
                              "tipoTabla"=>$tipoTabla,
                              "idOC"=>$idOC            
             ); 

              $existeEnOC = ModeloOrdenCompra::mdlValidarExisteEnOC($datos2);

              if($existeEnOC){
                $disable = 'disabled';
              }


              
            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $guia?></div></td> 
    <td ><div align="left"><?php echo $codigo?></div></td> 
    <td ><div align="left"><?php echo $descripcion?></div></td>    
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td>   
    <td ><div align="center"><?php echo $dias?></div></td>
    <td ><div align="center"><?php echo $canOCSumado?></div></td>
    <td ><div align="center"><?php echo $saldo?></div></td>
    <td align="center" nowrap=""><button class="btn btn-success btn-xm" <?php echo $disable?> onclick="SeleccionEquipoEEPPOC('<?= $idDetalleEEPP?>','<?= $codigo?>','<?= $precio?>','<?=$saldo?>','<?=$tipoTabla?>')">Sel</button>
      </td> 
     
        
  </tr>
  <?php
     

            } 

   $descuentosExtras = ModeloEEPP::mdlMostrarDescuentosExtras($id_eepp);

    if($descuentosExtras){
       for($i = 0; $i < count($descuentosExtras); $i++){   

              $idDetalleEEPP = $descuentosExtras[$i]["id"];
              $tipo = $descuentosExtras[$i]["tipoActo"];            
              $fecha = $descuentosExtras[$i]["fecha"];
              $usuario = $descuentosExtras[$i]["usuario"];
              $descripcion = $descuentosExtras[$i]["descripcion"];
              $precio = $descuentosExtras[$i]["montoCambio"];
              $cantidad = 1;


              $tipoTabla = 'DESCUENTOEXTRA';

               $datos = array("id"=>$idDetalleEEPP,
                              "tipoTabla"=>$tipoTabla             
             );  

              $cantidad_oc = ModeloOrdenCompra::mdlObtenerCantidadesEEPPOC($datos);
              
              if($cantidad_oc){
                 $canOCSumado = $cantidad_oc["cantidad"];
             }else{
                 $canOCSumado = 0;
             }

              $saldo = $cantidad - $canOCSumado;
              
              $disable = '';

              if($saldo <= 0){
                $disable = 'disabled';
              }  

              $codigo = '';

            
  ?>    
   <tr>   
    <td ><div align="left"></div></td> 
    <td ><div align="left"></div></td>
    <td ><div align="left"><?php echo $descripcion?></div></td>     
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td> 
    <td ><div align="center"><?php echo number_format($cantidad,0,'','.')?></div></td>
    <td ><div align="center"><?php echo $canOCSumado?></div></td>
    <td ><div align="center"><?php echo $saldo?></div></td>
    <td align="center" nowrap=""><button class="btn btn-success btn-xm" <?php echo $disable?> onclick="SeleccionEquipoEEPPOC('<?= $idDetalleEEPP?>','<?=$codigo?>','<?=$precio?>','<?=$saldo?>','<?=$tipoTabla?>')">Sel</button>
      </td>  
   
       
  </tr>

  

 <?php 
             
     }
   }             

      $materiales = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionMateriales($id_eepp);

      if($materiales){
                             
         for($z = 0; $z < count($materiales); $z++){  

           $idDetalleEEPP = $materiales[$z]["id"];
           $descripcion =  $materiales[$z]["material"];
           $precioMat = $materiales[$z]["precio"];
           $cantidad = $materiales[$z]["cantidad"];
           $totalMat = $materiales[$z]["total"];
           $codigo = $materiales[$z]["codigo"];
           $guia  = $materiales[$z]["guia"];

            $tipoTabla = 'MATERIALES';

             $datos = array("id"=>$idDetalleEEPP,
                              "tipoTabla"=>$tipoTabla             
             );  

              $cantidad_oc = ModeloOrdenCompra::mdlObtenerCantidadesEEPPOC($datos);
              
              if($cantidad_oc){
                 $canOCSumado = $cantidad_oc["cantidad"];
             }else{
                 $canOCSumado = 0;
             }

              $saldo = $cantidad - $canOCSumado;
              
              $disable = '';

              if($saldo <= 0){
                $disable = 'disabled';
              }  

            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $guia?></div></td> 
    <td ><div align="left"><?php echo $codigo?></div></td> 
    <td ><div align="left"><?php echo $descripcion?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precioMat,0,'','.')?></div></td>
    <td ><div align="center"><?php echo number_format($cantidad,0,'','.')?></div></td>        
   <td ><div align="center"><?php echo $canOCSumado?></div></td>
    <td ><div align="center"><?php echo $saldo?></div></td>
    <td align="center" nowrap=""><button class="btn btn-success btn-xm" <?php echo $disable?> onclick="SeleccionEquipoEEPPOC('<?=$idDetalleEEPP?>','<?=$codigo?>','<?= $precioMat?>','<?=$saldo?>','<?=$tipoTabla?>')">Sel</button>
      </td>        
  </tr>

  <?php
    

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

          $('#tablaEEPPAsociaOC').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>


   



