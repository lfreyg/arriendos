<?php
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/facturacion.modelo.php";


 
$idEEPP = $_POST['idEEPP'];

 $descuentosExtras = ModeloEEPP::mdlMostrarDescuentosExtras($idEEPP);


 if($descuentosExtras){

  ?>
        
  <label style="background-color: rgb(102, 255, 153)">DESCUENTOS Y/O COBROS EXTRAS</label> 
   <table class="table-bordered table-striped table-hover dt-responsive" id="tablasDescuentosExtras" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr > 
                  <th width="10%">Tipo</th>
                  <th width="15%">Fecha</th>
                  <th width="15%">Usuario</th>
                  <th width="35%">Descripción</th>
                  <th width="10%">Monto</th> 
                  <th width="10%">Acciones</th>                  
                </tr>

    </thead>
     <tbody>
   
  <?php
            
          
                               
            for($i = 0; $i < count($descuentosExtras); $i++){   

              $id = $descuentosExtras[$i]["id"];
              $id_eepp = $descuentosExtras[$i]["id_eepp"];

              $tipo = $descuentosExtras[$i]["tipoActo"];            
              $fecha = $descuentosExtras[$i]["fecha"];
              $usuario = $descuentosExtras[$i]["usuario"];
              $descripcion = $descuentosExtras[$i]["descripcion"];
              $montoCambio = $descuentosExtras[$i]["montoCambio"];
              

              $dateReg = date_create($fecha);
              $fecha = date_format($dateReg,"d-m-Y H:i:s");
            

             $disable = '';

             

            

            

            
  ?>
  <tr>
    <td ><div align="center"><?php echo $tipo?></div></td> 
    <td ><div align="center"><?php echo $fecha?></div></td> 
     <td ><div align="left"><?php echo $usuario?></div></td> 
    <td ><div align="left"><?php echo strtoupper($descripcion)?></div></td>  
    <td ><div align="right"><?php echo '$ '.number_format($montoCambio,0,'','.')?></div></td>     
    <td align="center" nowrap="">
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disable?> onclick="eliminarConsultaExtra('<?php echo $id?>')">X</button></td> 
     
    
    
  </tr>
 <?php          


      }  

             $equipos = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaEquipos($idEEPP);

             if($equipos){
                $montoEqui = $equipos['total'];
             }else{
                $montoEqui = 0;
             }


             $materiales = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaMateriales($idEEPP);

             if($materiales){
                $montoMat = $materiales['total'];
             }else{
                $montoMat = 0;
             }

             $extras = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaExtras($idEEPP);

             if($extras){
                $montoextras = $extras['total'];
             }else{
                $montoextras = 0;
             }

             $dscto = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPreviaDscto($idEEPP);

             if($dscto){
                $montodscto = $dscto['total'];
             }else{
                $montodscto = 0;
             }

             
            $total_facturacion_eepp = $montoEqui + $montoMat + $montoextras + $montodscto;

            $total = ModeloEEPP::mdlActualizaTotalEEPP($idEEPP,$total_facturacion_eepp);



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

          $('#tablasDescuentosExtras').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>