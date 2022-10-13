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
                  <th align="left">Categoria</th>
                  <th align="left">Código</th>              
                  <th align="left">Equipo</th>                  
                  <th align="center">Fecha</th>                                                     
                  <th align="center">Eliminar</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloGuiaDespachoDetalles::mdlGuiaDespachoTrasladoPorId($idGuia);


         foreach ($productos as $key => $value){



           $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"]; 
           $categoria = $value["categoria"]; 
                 

           $dateReg = date_create($value["fecha"]);
           $fecha = date_format($dateReg,"d-m-Y");
           
           $disabled = '';
           $disabled_valida = "";


          
           if($value["validado"] == 0){
              $disabled = "disabled";
           }

          

           $arriendo = $equipo." ".$modelo." ".$marca;

          
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $categoria?></div></td>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>    
    <td ><div align="center"><?php echo $fecha?></div></td>   
       
    <td align="center" nowrap="">
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $value["idRegistro"]?>','<?php echo $value["idEquipo"]?>')">X</button>
    </td>
      
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
