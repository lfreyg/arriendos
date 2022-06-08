<?php

require_once "../modelos/ReportDevolucionDetalles.modelo.php";

$idConstructora = $_POST['idConstructora'];
$idObra = $_POST['idObra'];

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaEquiposCambio"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>Match</th>
                  <th>Código</th>              
                  <th>Equipo</th> 
                  <th>GD</th>                   
                  
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloReportDevolucionDetalles::mdlEquiposParaCambio($idConstructora,$idObra);


         foreach ($productos as $key => $value){

           $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"]; 
           $gd = $value["gd"];              
                    
           $arriendo = $equipo." ".$modelo." ".$marca;

          

           
            
  ?>
  <tr>
    <td align="left">
      <span class="btn btn-warning btn-xm" title="Cambiar" onclick="hacerCambio('<?php echo $value["idRegistro"]?>')">C</span>      
    </td>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>  
    <td ><div align="left"><?php echo $gd?></div></td>  
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
