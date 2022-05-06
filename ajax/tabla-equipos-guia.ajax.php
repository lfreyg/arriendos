<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";

$idGuia = $_POST['id'];

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaCompraDespliega"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>Código</th>              
                  <th>Equipo</th>
                  <th>precio</th>
                  <th>Fecha</th>
                  <th>Movimiento</th>                                    
                  <th>Acciones</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloGuiaDespachoDetalles::mdlGuiaDespachoPorId($idGuia);


         foreach ($productos as $key => $value){

           $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"];
           $precio = $value["precio"];          
           $movimiento = $value["movimiento"];

           $dateReg = date_create($value["fecha"]);
           $fecha = date_format($dateReg,"d-m-Y");
           
           $disabled = '';

           $arriendo = $equipo." ".$modelo." ".$marca;
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>
    <td ><div align="left"><?php echo $precio?></div></td>  
    <td ><div align="left"><?php echo $fecha?></div></td>  
    <td ><div align="left"><?php echo $movimiento?></div></td>  

       
    <td align="center" nowrap=""><span class="btn btn-warning btn-xm" title="Editar" onclick="editar('<?php echo $value["idRegistro"]?>')">E</span>
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $value["idRegistro"]?>','<?php echo $value["idEquipo"]?>')">X</button></td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
