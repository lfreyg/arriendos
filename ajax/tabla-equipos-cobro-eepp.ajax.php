<?php
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";


 
$idObra = $_GET['idObra'];
$fecha = $_GET['fecha'];

$equiposCobro = ControladorEEPP::ctrMostrarEquiposParaCobro($idObra,$fecha);

?>

<form role="form" method="post" id="formdata">

  
  <div class="form-group">                      
   
<table class="table-bordered table-striped table-hover dt-responsive" id="tablasEquiposCobro" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                 
                  <th width="5%">Sel</th>
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

             if($equiposCobro[$i]["devuelto"] == 1){
                $fechaHasta = $equiposCobro[$i]["fecha_devolucion"];
              }else{
                $fechaHasta = $fecha;
              }

              if($equiposCobro[$i]["ultimo_cobro"] == null){
                $fechaDesde = $equiposCobro[$i]["fecha_arriendo"];
              }else{
                $fechaDesde = $equiposCobro[$i]["ultimo_cobro"];
              }

              $datetime1 = date_create($fechaDesde);
              $inicio =  date_format($datetime1,"d-m-Y");

              $datetime2 = date_create($fechaHasta);
              $fin = date_format($datetime2,"d-m-Y");

              //$diasDiferencia = $fin ->diff($inicio);
              $diasDiferencia = date_diff($datetime2, $datetime1);

              $dias = $diasDiferencia->format('%a');

              if($dias == 0){
                $dias = 1;
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

            
  ?>
  <tr>
    <td ><div align="center"><input type="checkbox" class="checkBoxGroup" value="<?php echo $idGuiaDetalle?>" name="idObrabox[]" id="idObrabox" checked/></div></td>
    <td ><div align="center"><?php echo $guia?></div></td> 
    <td ><div align="center"><?php echo $contrato?></div></td> 
    <td ><div align="left"><?php echo $codigo?></div></td> 
    <td ><div align="left"><?php echo $equipo?></div></td> 
    <td ><div align="right"><?php echo number_format($precio,0,'','.')?></div></td>   
    <td ><div align="center"><?php echo $fecArriendo?></div></td>   
    <td ><div align="center"><?php echo $fecDevolucion?></div></td>   
    <td ><div align="center"><?php echo $report?></div></td>   
    <td ><div align="left"><?php echo $tipoDevolucionNombre?></div></td>   
    <td ><div align="center"><?php echo $ultimo_cobro?></div></td>   
    <td ><div align="center"><?php echo $fechaDesde?></div></td>   
    <td ><div align="center"><?php echo $fechaHasta?></div></td>   
    <td ><div align="center"><?php echo $dias?></div></td>   
    <td ><div align="right"><?php echo number_format($cobro,0,'','.')?></div></td>   
    
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
<br>
<br>
                     
                   


   

</form>


