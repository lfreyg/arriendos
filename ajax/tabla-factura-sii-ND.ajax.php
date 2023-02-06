<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/ordenCompra.modelo.php";

 

$idFactura = $_POST['idFactura'];

$eeppCobro = ModeloFacturacionEEPP::mdlMostrarDatosFacturaSII($idFactura);

?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaSII" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="10%">Sel</th>                     
                  <th width="40%">Descripción</th> 
                  <th width="40%">Neto</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
                            
            for($i = 0; $i < count($eeppCobro); $i++){   

              $id = $eeppCobro[$i]["id"];
              $id_eepp = $eeppCobro[$i]["id_eepp"];
             
              $codigo = $eeppCobro[$i]["codigo"];
              $descripcion = $eeppCobro[$i]["descripcion"];
              $glosa = $eeppCobro[$i]["glosa"];
              $valor = $eeppCobro[$i]["valor"];
              
   
            
  ?>
  <tr>  
    <td align="center" nowrap=""><button class="btn btn-success btn-xm" onclick="agregaItemNDSII('<?=$id_eepp?>','<?=$id?>')"></button>
      </td>      
    <td ><div align="left"><?= $descripcion?></div></td>
    <td ><div align="right"><?= '$ '.number_format($valor,0,'','.')?></div></td> 
    
     
   
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


