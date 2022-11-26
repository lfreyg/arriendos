<?php
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/obras.modelo.php";


 
$idEEPP = $_POST['idEEPP'];
$idObra = $_POST['idObra'];

$consultaDias = ModeloEEPP::mdlCuentaDiasDescuento($idEEPP);

$descuentoDias = 0;
if($consultaDias){
  $descuentoDias = $consultaDias["diasDescuento"];
}


$preguntaFecha = ModeloEEPP::mdlPrimerDiaDescuento($idEEPP);

if($preguntaFecha){
  $primeraFecha = $preguntaFecha["primeraFecha"];
}




$equiposCobro = ModeloEEPP::mdlMostrarEquiposProcesados($idEEPP);


if($equiposCobro){

?>



<label style="background-color: rgb(102, 255, 153)">EQUIPOS PARA COBRO</label> 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablasEquiposProcesados" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="5%">Guía</th>
                  <th width="5%">Contrato</th>
                  <th width="5%">Código</th>   
                  <th width="20%">Equipo</th>    
                  <th width="5%">Precio</th>
                  <th width="7%">Fecha Arriendo</th> 
                  <th width="7%">Fecha Dev.</th> 
                  <th width="5%">Report</th> 
                  <th width="5%">Tipo Dev.</th>
                  <th width="5%">Último Cobro</th>
                  <th width="7%">Desde</th>
                  <th width="7%">Hasta</th>
                  <th width="5%">Días</th>
                  <th width="5%">Cobro</th>
                  <th width="5%">Acciones</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
                                  
            for($i = 0; $i < count($equiposCobro); $i++){   

              $idRegistro = $equiposCobro[$i]["id"];
              $idGuiaDetalle = $equiposCobro[$i]["idGuiaDetalle"];
              
              $guia = $equiposCobro[$i]["guia"];
              $contrato = $equiposCobro[$i]["contrato"];
              $codigo = $equiposCobro[$i]["codigo"];
              $serie = $equiposCobro[$i]["serie"];
              $equipo = $equiposCobro[$i]["descripcion"].' '.$equiposCobro[$i]["modelo"].' '.$equiposCobro[$i]["marca"];
              $precio = $equiposCobro[$i]["precio"];
              $fecArriendo = $equiposCobro[$i]["fecha_arriendo"];
              $fecDevolucion = $equiposCobro[$i]["fecha_devolucion"];
              $report = $equiposCobro[$i]["report_devolucion"];
              $tipoDevolucion = $equiposCobro[$i]["tipo_devolucion"];
              $tipoDevolucionNombre = $equiposCobro[$i]["nombreDevolucion"];
              $ultimo_cobro = $equiposCobro[$i]["ultimo_cobro"];
              $matchCambio = $equiposCobro[$i]["match_cambio"];
              $fechaDesde = $equiposCobro[$i]["cobro_desde"];
              $fechaHasta = $equiposCobro[$i]["cobro_hasta"];

              $obraConsulta = ModeloObras::mdlMostrarObrasPorId($idObra);
              $tipoCobro = $obraConsulta["tipoCobro"];

              if($report == 0){
                $report = '';
              }
              
              $aplicaDescuento = 1;
              if($fecDevolucion != '0000-00-00'){
                $preguntaFechaDevolucion = strtotime($fecDevolucion);
                $preguntaFechaDescuento = strtotime($primeraFecha);
                
                 if($preguntaFechaDevolucion < $preguntaFechaDescuento){
                      $aplicaDescuento = 0;
                 }

              }


                $preguntaFechaArriendo = strtotime($fecArriendo);
                $preguntaFechaDescuento = strtotime($primeraFecha);
                
                 if($preguntaFechaArriendo > $preguntaFechaDescuento){
                      $aplicaDescuento = 0;
                 }

              
             
              
  
              if($tipoCobro == 'LUNES A LUNES'){
                $dias = 1;   
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
                  $dias = 1;   
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
                  $dias = 1;   
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

              if($fecDevolucion != '0000-00-00'){
                $dateReg2 = date_create($fecDevolucion);
                $fecDevolucion = date_format($dateReg2,"d-m-Y");
              }else{
                $fecDevolucion = '';
              }

              if($ultimo_cobro != '0000-00-00'){
                $dateReg3 = date_create($ultimo_cobro);
                $ultimo_cobro = date_format($dateReg3,"d-m-Y");
              }else{
                $ultimo_cobro = '';
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


                if($aplicaDescuento == 1){
                  $dias = $dias - $descuentoDias;   
                  }         

              $cobro = $dias * $precio;

              $estilo = '';

              if($tipoDevolucion == 11){
                $estilo = 'style="background-color: rgb(102, 255, 153)"';
              }

              if($tipoDevolucion == 15){
                $tipoDevolucionNombre = 'TERMINO';
              }

              if($matchCambio != 0){
                $estilo = 'style="background-color: rgb(102, 255, 153)"';
              }

              $disabled = '';

            
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
    <td align="center" nowrap=""><button class="btn btn-warning btn-xm" title="Editar" onclick="editarEquipoEEPP('<?php echo $idRegistro?>','<?php echo $idEEPP?>','<?php echo $idGuiaDetalle?>')">E</button>
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $idRegistro?>','<?php echo $idEEPP?>','<?php echo $idGuiaDetalle?>')">X</button></td> 
    
    
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

          $('#tablasEquiposProcesados').DataTable(
              {
            "language":idioma_espanol
        }
            );
      } );
</script>
