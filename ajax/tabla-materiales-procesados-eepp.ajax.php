<?php
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";


 
$idEEPP = $_POST['idEEPP'];

 $materialesCobro = ModeloEEPP::mdlMostrarMaterialesProcesados($idEEPP);


 if($materialesCobro){

  ?>
        
  <label style="background-color: rgb(102, 255, 153)">MATERIALES Y/O INSUMOS PARA COBRO</label> 
   <table class="table-bordered table-striped table-hover dt-responsive" id="tablasMaterialesProcesados" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr > 
                  <th width="5%">Guía</th>
                  <th width="10%">Fecha</th>
                  <th width="10%">Código</th>
                  <th width="40%">Material-Insumo</th>
                  <th width="10%">Cantidad</th>                  
                  <th width="10%">Precio</th>                     
                  <th width="10%">Cobro</th> 
                  <th width="10%"></th>
                  <th width="30%">Acciones</th>                  
                </tr>

    </thead>
     <tbody>
   
  <?php
            
          
                               
            for($i = 0; $i < count($materialesCobro); $i++){   

              $idRegEEPP = $materialesCobro[$i]["id"]; //id del registro
              $id_eepp = $materialesCobro[$i]["id_eepp"];
              $idGuiaDespacho = $materialesCobro[$i]["idGuiaDetalle"];
              $guiaMaterial = $materialesCobro[$i]["guia"];
              $fecha = $materialesCobro[$i]["fecha"];
              $codigo = $materialesCobro[$i]["codigo"];
              $material = $materialesCobro[$i]["material"];
              $cantidad = $materialesCobro[$i]["cantidad"];
              $precio = $materialesCobro[$i]["precio"];
              $total = $materialesCobro[$i]["total"];
              
              
             

              $datetime = date_create($fecha);
              $fecha =  date_format($datetime,"d-m-Y");

             

             $disabled = '';

            

            

            
  ?>
  <tr>
    <td ><div align="center"><?php echo $guiaMaterial?></div></td> 
    <td ><div align="center"><?php echo $fecha?></div></td> 
     <td ><div align="left"><?php echo $codigo?></div></td> 
    <td ><div align="left"><?php echo $material?></div></td>    
    <td ><div align="center"><?php echo number_format($cantidad,0,'','.')?></div></td> 
    <td ><div align="right"><?php echo '$ '.number_format($precio,0,'','.')?></div></td>
    <td ><div align="right"><?php echo '$ '.number_format($total,0,'','.')?></div></td> 
    <td></td> 
    <td align="center" nowrap=""><button class="btn btn-warning btn-xm" title="Editar" onclick="editarMaterialesEEPP('<?php echo $idRegEEPP?>','<?php echo $id_eepp?>','<?php echo $idGuiaDespacho?>')">E</button>
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsultaMaterialEEPP('<?php echo $idRegEEPP?>','<?php echo $id_eepp?>','<?php echo $idGuiaDespacho?>')">X</button></td> 
     
    
    
  </tr>
 <?php          


      }  
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

          $('#tablasMaterialesProcesados').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>