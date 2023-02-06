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
                  <th><div align="center">Código</div></th>  
                  <th><div align="center">Serie</div></th>             
                  <th><div align="center">Equipo</div></th>   
                  <th><div align="center">Eliminar</div></th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloGuiaDespachoDetalles::mdlGuiaDespachoTallerPorId($idGuia);


         foreach ($productos as $key => $value){



           $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"];          
           $guia = $value["guia"];
           $serie = $value["serie"];

                      
           $disabled = '';
           $disabled_valida = "";


           
           if(!empty($guia)){
            $disabled_valida = "disabled";
           }
           


           $arriendo = $equipo." ".$modelo." ".$marca;

                       
  ?>
  <tr>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $serie?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>
    
       
    <td align="center" nowrap="">
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled_valida?> onclick="eliminarConsulta('<?php echo $value["idRegistro"]?>','<?php echo $value["idLog"]?>')">X</button>
    </td>
      
  </tr>
    <?php
        }

    ?>

               

   </tbody>
</table>
</body>
</html>
