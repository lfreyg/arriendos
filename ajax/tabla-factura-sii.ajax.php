<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/obras.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];

$facturacion = ModeloFacturacionEEPP::obtenerDatosFactura($idFactura);
$estadoFactura = $facturacion["estado_factura"];

if($estadoFactura == 12){
   $estado = 7;
   ModeloFacturacionEEPP::mdlActualizaEstadoFactura($idFactura, $estado);
}

$disable = '';
if($estadoFactura == 13){
   $disable = 'disabled';
}   

$eeppCobro = ModeloFacturacionEEPP::mdlMostrarDatosFacturaSII($idFactura);


?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaSII" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="10%">Código</th>                     
                  <th width="40%">Descripción</th>  
                  <th width="10%">Cantidad</th>
                  <th width="10%">Precio</th>
                  <th width="10%">Valor</th>
                  <th width="5%">Editar</th>                  
                </tr>

    </thead>
     <tbody>
   
  <?php
               $periodo = '';  
               $total_facturacion_eepp = 0;                 
            for($i = 0; $i < count($eeppCobro); $i++){   

              $id = $eeppCobro[$i]["id"];
              $id_eepp = $eeppCobro[$i]["id_eepp"];
              $id_factura = $eeppCobro[$i]["id_factura"];
              $codigo = $eeppCobro[$i]["codigo"];
              $descripcion = $eeppCobro[$i]["descripcion"];
              $glosa = $eeppCobro[$i]["glosa"];
              $cantidad = $eeppCobro[$i]["cantidad"];
              $precio = $eeppCobro[$i]["precio"];
              $valor = $eeppCobro[$i]["valor"];
              $um = $eeppCobro[$i]["um"]; 


              
                          

      

              
            
  ?>
  <tr>    
    <td ><div align="left"><?= $codigo?></div></td> 
    <td ><div align="left"><?= $descripcion?></div></td>
    <td ><div align="center"><?= $cantidad.' '.$um?></div></td>
    <td ><div align="right"><?= '$ '.number_format($precio,0,'','.')?></div></td>
    <td ><div align="right"><?= '$ '.number_format($valor,0,'','.')?></div></td>  
    <td align="center" nowrap=""><button class="btn btn-warning btn-xm" <?php echo $disable?> onclick="editarRegistroSII('<?php echo $id?>')">E</button>
      </td>  
    
   
  </tr> 
  <?php
      }
  ?> 
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

          $('#tablaSII').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>

   



