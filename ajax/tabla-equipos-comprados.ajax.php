<?php
require_once "../controladores/tipoEquipos.controlador.php";
require_once "../modelos/tipoEquipos.modelo.php";

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";

require_once "../modelos/facturasDetalles.modelo.php";
require_once "../modelos/sucursales.modelo.php";

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaCompraDespliega"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                 
                  <th>Sucursal</th>
                  <th>Equipo</th>
                  <th>Modelo</th>
                  <th>Serie</th>
                  <th>Codigo</th>                  
                  <th>Precio Unitario</th>
                  <th>Acciones</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloFacturasDetalles::mdlFacturaPorIdFactura($id);
                               
            for($i = 0; $i < count($productos); $i++){   


            
            $idTipoEquipo = $productos[$i]["id_nombre_equipos"];
            $tipoEquipos = ModeloTipoEquipos::mdlMostrarTipoEquipos("nombre_equipos","id",$idTipoEquipo);

            $idSucursal = $productos[$i]["id_sucursal"];            
            $sucursal = ModeloSucursales::mdlMostrarSucursales("sucursales", "id", $idSucursal);
            $nombreSucursal = $sucursal["nombre"];

            $idMarca = $tipoEquipos["id_marca"];
            $marca = ModeloMarcas::mdlMostrarMarcas("marcas","id",$idMarca);  

            $precio = $productos[$i]["precio_compra"];
            $precio = number_format($precio,0,"",".");
            $movimiento = $productos[$i]["tiene_movimiento"];

            if($movimiento == 1){
              $disabled = "disabled";
            }else{
              $disabled = '';
            }
  ?>
  <tr>
    <td ><div align="left"><?php echo $nombreSucursal?></div></td>
    <td ><div align="left"><?php echo $tipoEquipos["descripcion"]?></div></td>
    <td ><div align="left"><?php echo $tipoEquipos["modelo"]?></div></td>  
    <td ><div align="left"><?php echo $productos[$i]["numero_serie"]?></div></td> 
    <td ><div align="left"><?php echo $productos[$i]["codigo"]?></div></td> 
    <td ><div align="right"><?php echo "$ ".$precio?></div></td>  
    <td align="center"><span class="btn btn-warning btn-xm" title="Editar" onclick="editar('<?php echo $productos[$i]["id"]?>')">E</span>
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $productos[$i]["id"]?>')">X</button></td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
