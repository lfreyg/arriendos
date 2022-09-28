<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";
require_once "../modelos/ReportDevolucion.modelo.php";
session_start();
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
                  <th>Retiro</th>
                  <th>Movimiento</th>                                    
                  <th>Validar</th>
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
           $id_sucursal = $value["idSucursalEquipo"];
           $idEstadoEquipo = $value["idEstadoEquipo"];


           $dateReg = date_create($value["fecha"]);
           $fechaTermino = date_format($dateReg,"d-m-Y");

           $dateReg = date_create($value["fechaRetiroObra"]);
           $fechaRetiro = date_format($dateReg,"d-m-Y");
           
          
           $arriendo = $equipo." ".$modelo." ".$marca;
          
           $validado = $value["validado"];

          $disabled = '';

           if($idEstadoEquipo != 1 || $id_sucursal != $_SESSION["idSucursalParaUsuario"]){
              $disabled = 'disabled';
           }

           
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>    
    <td ><div align="left"><?php echo $fechaTermino?></div></td>  
    <td ><div align="left"><?php echo $fechaRetiro?></div></td>  
    <td ><div align="left"><?php echo $movimiento?></div></td>  

  <?php 
    if($validado == 1){

    ?>
    <td align="left" nowrap="">
      <span class="btn btn-warning btn-xm" title="Validar Retiro" onclick="validarRetiro('<?php echo $value["idRegistro"]?>')">V</span> 
    </td>
  <?php }else{
    ?>
    <td align="left" nowrap="">
      <span class="btn btn-success btn-xm" title="Validar Retiro" <?php echo $disabled?> onclick="quitarValidarRetiro('<?php echo $value["idRegistro"]?>')">OK</span> 
    </td>
  <?php  
  }
  ?>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
