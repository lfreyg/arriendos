<?php
require_once "../controladores/tipoEquipos.controlador.php";
require_once "../modelos/tipoEquipos.modelo.php";

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";

require_once "../modelos/facturasDetalles.modelo.php";

$id = $_POST['id'];

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
<table width="498" border="1" cellpadding="0" cellspacing="0"> 
    <td width="104" bgcolor="#CCCCCC"><div align="center" class="Estilo4">Equipo</div></td>    
    <td width="60" bgcolor="#CCCCCC"><div align="center" class="Estilo4">Modelo</div></td>
    <td width="60" bgcolor="#CCCCCC"><div align="center" class="Estilo4">Codigo</div></td>
    <td width="60" bgcolor="#CCCCCC"><div align="center" class="Estilo4">Serie</div></td>
    <td width="60" bgcolor="#CCCCCC"><div align="center" class="Estilo4">Precio</div></td>
    <td width="60" bgcolor="#CCCCCC"><div align="center" class="Estilo4">Acciones</div></td>
  </tr>
  <?php
            
            $productos = ModeloFacturasDetalles::mdlFacturaPorIdFactura($id);
                               
            for($i = 0; $i < count($productos); $i++){   


            $idTipoEquipo = $productos[$i]["id_nombre_equipos"];
            $tipoEquipos = ModeloTipoEquipos::mdlMostrarTipoEquipos("nombre_equipos","id",$idTipoEquipo);

            $idMarca = $tipoEquipos["id_marca"];
            $marca = ModeloMarcas::mdlMostrarMarcas("marcas","id",$idMarca);  
  ?>
  <tr>
    <td width="75" bgcolor="#FFFFCC"><div align="center" class="Estilo4"><?php echo $tipoEquipos["descripcion"]?></div></td>
    <td width="104" bgcolor="#FFFFCC"><div align="left" class="Estilo4"><?php echo .$tipoEquipos["modelo"]?></div></td>  
    <td width="104" bgcolor="#FFFFCC"><div align="left" class="Estilo4"><?php echo $productos[$i]["codigo"]?></div></td>  
    <td width="104" bgcolor="#FFFFCC"><div align="left" class="Estilo4"><?php echo $productos[$i]["serie"]?></div></td> 
    <td width="104" bgcolor="#FFFFCC"><div align="left" class="Estilo4"><?php echo $productos[$i]["precio"]?></div></td>  
    <td width="60" align="center"><button class="btn btn-danger btn-xs" onclick="eliminar_patente('<?php echo $productos[$i]["id"]?>')"></button></td>
    
  </tr>
  <?php
            


            }  

  ?>
</table>
</body>
</html>
