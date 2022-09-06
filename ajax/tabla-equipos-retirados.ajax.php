<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";
require_once "../modelos/ReportDevolucion.modelo.php";

$idReport = $_POST['id'];

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo4 {font-size: 14px; }
-->
</style>
</head>

<body>
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaDetalles"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>Código</th>              
                  <th>Equipo</th>                  
                  <th>Termino</th>
                  <th>Movimiento</th>                                    
                  <th>Acciones</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloReportDevolucionDetalles::mdlRetiroPorId($idReport);


         foreach ($productos as $key => $value){

           $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"];                
           $movimiento = $value["movimiento"];

           $dateReg = date_create($value["fecha"]);
           $fecha = date_format($dateReg,"d-m-Y");
           
           $disabled = '';

           $validar = ModeloReportDevolucionDetalles::mdlValidaEquipoReportEliminar($value["idRegistro"]);

           $conMatch = ModeloReportDevolucion::mdlValidaEquipoReportCambiadoDetalle($value["idRegistro"]);

          if($conMatch){
            $disabled = 'disabled';
          }

          
           if($validar){
              $disabled = "disabled";
           }

           $arriendo = $equipo." ".$modelo." ".$marca;

           $estadoEquipo = $value["idEstado"];

           
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>    
    <td ><div align="left"><?php echo $fecha?></div></td>  
    <td ><div align="left"><?php echo $movimiento?></div></td>  

       
    <td align="left" nowrap="">
      <span class="btn btn-warning btn-xm" title="Editar" onclick="editar('<?php echo $value["idRegistro"]?>')">E</span>      
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $value["idRegistro"]?>','<?php echo $value["idEquipo"]?>')">X</button>
      <span class="btn btn-success btn-xm" title="Foto" onclick="editar('<?php echo $value["idRegistro"]?>')">F</span>
     <?php if($estadoEquipo == 11){?>
      <button class="btn btn-info btn-xm" title="Cambio" onclick="matchCambio('<?php echo $value["idRegistro"]?>','<?php echo $value["contrato"]?>')">C</button>
     <?php } ?> 
    </td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
