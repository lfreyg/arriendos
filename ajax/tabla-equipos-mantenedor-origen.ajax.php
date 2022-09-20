<?php

require_once "../modelos/equipos.modelo.php";


$id = $_POST['idEquipo'];

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
  <h3>Origen</h3>
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaCompraDespliega"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                 
                  <th>Codigo</th>
                  <th>Serie</th>
                  <th>Descripción</th> 
                  <th>Fecha Crea</th>                 
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloEquipos::mdlMostrarEquiposOrigen($id);

           
            $equipo = $productos["descripcion"]." ".$productos["modelo"]." ".$productos["marca"];  

            $dateReg = date_create($productos["fecha"]);
            $fechaReg = date_format($dateReg,"d-m-Y H:i:s");

           
  ?>
  <tr>
    <td ><div align="left"><?php echo $productos["codigo"]?></div></td>
    <td ><div align="left"><?php echo $productos["serie"]?></div></td>   
    <td ><div align="left"><?php echo $equipo?></div></td>   
    <td ><div align="left"><?php echo $fechaReg?></div></td> 
    
    
    
  </tr>
  
   </tbody>
</table>


<h3>Modificaciones</h3>
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaCompraDespliega"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                 
                  <th>Codigo</th>
                  <th>Serie</th>
                  <th>Descripción</th>  
                  <th>Fecha Mod</th> 
                  <th>Usuario</th>                
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $equipos = ModeloEquipos::mdlMostrarEquiposHistoria($id);

                  
         for($i = 0; $i < count($equipos); $i++){
           
            $equipo = $equipos[$i]["descripcion"]." ".$equipos[$i]["modelo"]." ".$equipos[$i]["marca"];  

            $dateReg = date_create($equipos[$i]["fecha"]);
            $fechaReg = date_format($dateReg,"d-m-Y H:i:s");

           
  ?>
  <tr>
    <td ><div align="left"><?php echo $equipos[$i]["codigo"]?></div></td>
    <td ><div align="left"><?php echo $equipos[$i]["serie"]?></div></td>   
    <td ><div align="left"><?php echo $equipo?></div></td> 
    <td ><div align="left"><?php echo $fechaReg?></div></td> 
     <td ><div align="left"><?php echo $equipos[$i]["usuario"]?></div></td> 
    
    
    
  </tr>
  <?php
           }
  ?>         

  
   </tbody>
</table>


</body>
</html>
