<?php

require_once "../modelos/equipos.modelo.php";


$id = $_POST['idEquipo'];

$equipoSQL = ModeloEquipos::mdlMostrarEquiposMantenedorUno($id);

$codigoEquipo = $equipoSQL["codigo"];
$equipo = $equipoSQL["descripcion"].' '.$equipoSQL["modelo"].' '.$equipoSQL["marca"];

 
?>

<h4>Código: <?=$codigoEquipo?></h4>  
<h4>Equipo: <?=$equipo?></h4>  
<br>
<table class="table table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaHistoriaCostos"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">
               


               <tr>                 
                  <th style="width: 25%;">Taller</th>   
                  <th style="width: 10%;">Factura</th> 
                  <th style="width: 10%;">Neto</th> 
                  <th style="width: 10%;">Fecha</th>  
                  <th style="width: 20%;">Detalle</th>      
                  <th style="width: 25%;">Usuario</th> 
                </tr>

    </thead>
     <tbody>
   
  <?php
         
          $productos = ModeloEquipos::mdlTraerGastosDetalles($id);   
           
         foreach ($productos as $key => $value){
           
            $id = $value["id"];
            $taller = $value["taller"];
            $factura = $value["factura"];
            $neto = $value["neto"];
            $fechaFac = $value["fecha"];
            $detalle = $value["detalles"];
            $usuario = $value["usuario"];
            $fechaIng = $value["fecha_ingreso"];

            if($taller == null){
              $taller = 'TALLER INTERNO';
            }
           

            $dateReg = date_create($fechaFac);
            $fechaFac = date_format($dateReg,"d-m-Y");

            $dateReg = date_create($fechaIng);
            $fechaIng = date_format($dateReg,"d-m-Y H:i:s");
         
         
            $boton = "<button class='btn btn-primary btn-xm' onclick='verComprobante('<?php echo $id?>')'>PDF</button>";



           
           
  ?>
  <tr>
    <td ><div align="left"><?=$taller?></div></td>
    <td ><div align="left"><?=$factura?></div></td>
    <td ><div align="left"><?='$ '.number_format($neto,0,'','.')?></div></td>
    <td ><div align="left"><?=$fechaFac?></div></td>  
    <td ><div align="left"><?=$detalle?></div></td> 
    <td ><div align="left"><?=$usuario?></div></td> 
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

          $('#tablaHistoriaCostos').DataTable(
              {
            "language":idioma_espanol,
            responsive: 'true',
            dom: 'Bfrtip',

           buttons: [
                  'excel', 'pdf'
                ]
        }
            );
      } );
</script>