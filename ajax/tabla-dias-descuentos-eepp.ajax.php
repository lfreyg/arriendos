<?php
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";


 
$idEEPP = $_POST['idEEPP'];

 $diasDescuento = ModeloEEPP::mdlMostrarDiasDescuento($idEEPP);


 if($diasDescuento){

  ?>
        
  <label style="background-color: rgb(102, 255, 153)">DIAS DE DESCUENTO</label> 
   <table class="table-bordered table-striped table-hover dt-responsive" id="tablaDiasDescuento" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr > 
                  
                  <th width="15%"><div align="center">Fecha</div></th>
                  <th width="10%"><div align="center">Eliminar</div></th>                  
                </tr>

    </thead>
     <tbody>
   
  <?php
            
          
                               
            for($i = 0; $i < count($diasDescuento); $i++){   

              $id = $diasDescuento[$i]["id"];
              $id_eepp = $diasDescuento[$i]["id_eepp"];                          
              $fecha = $diasDescuento[$i]["fecha"];

                         $fechaNum=strtotime($fecha);
                         $day = date("l", $fechaNum);
                          
                          if($day == 'Monday'){
                            $nombreDia = 'LUNES';
                          }

                          if($day == 'Tuesday'){
                            $nombreDia = 'MARTES';
                          }

                          if($day == 'Wednesday'){
                            $nombreDia = 'MIERCOLES';
                          }

                         if($day == 'Thursday'){
                            $nombreDia = 'JUEVES';
                          }

                          if($day == 'Friday'){
                            $nombreDia = 'VIERNES';
                          }

                          if($day == 'Saturday'){
                            $nombreDia = 'SABADO';
                          }

                          if($day == 'Sunday'){
                            $nombreDia = 'DOMINGO';
                          }
             

              $dateReg = date_create($fecha);
              $fecha = date_format($dateReg,"d-m-Y");
            

            
  ?>
  <tr>   
    <td ><div align="center"><?php echo $nombreDia.', '.$fecha?></div></td>         
    <td align="center" nowrap="">
      <button class="btn btn-danger btn-xm" title="Eliminar" onclick="eliminarConsultaDiaDescuento('<?php echo $id?>')">X</button></td> 
     
    
    
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

          $('#tablaDiasDescuento').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>