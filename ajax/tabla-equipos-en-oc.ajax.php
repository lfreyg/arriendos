<?php
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/ordenCompra.modelo.php";
require_once "../modelos/facturacion.modelo.php";

$idOC = $_POST['id'];
$idFactura = $_POST['idFactura'];

$disable = '';
if($idFactura != 0){
   $facturacion = ModeloFacturacionEEPP::obtenerDatosFactura($idFactura);
   $estadoFactura = $facturacion["estado_factura"];
  
  if($estadoFactura == 7 || $estadoFactura == 13){
    $disable = 'disabled';
  }

}

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablas"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>Código</th>              
                  <th>Descripción</th>                  
                  <th>precio</th>
                  <th>cantidad</th>  
                  <th>Total</th>                                  
                  <th>Acciones</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloOrdenCompra::mdlDetalleOCPorId($idOC);


         foreach ($productos as $key => $value){

             $id = $value["id"];
             $id_eepp_detalle = $value["id_eepp_detalle"];
             $precio_oc = $value["precio_oc"];
             $cantidad_oc = $value["cantidad_oc"];
             $total = $value["total"];
             $tabla = $value["tabla"];
             
         
           if($tabla == 'EQUIPOS'){
            $equipoEEPP = ModeloEEPP::mdlMostrarEquiposProcesadoEdita($id_eepp_detalle);

             $codigo = $equipoEEPP["codigo"];
             $equipo = $equipoEEPP["descripcion"];
             $modelo = $equipoEEPP["modelo"];
             $marca =  $equipoEEPP["marca"];    

           
            $arriendo = $equipo." ".$modelo." ".$marca;
           } 

           if($tabla == 'DESCUENTOEXTRA'){
            $DescuentoEEPP = ModeloOrdenCompra::mdlMostrarDescuentosExtrasOC($id_eepp_detalle);

             $codigo = '';
             $equipo = $DescuentoEEPP["descripcion"];
             $arriendo = $equipo;
           } 

           if($tabla == 'MATERIALES'){
            $materiaEEPP = ModeloEEPP::mdlMostrarMaterialesProcesadoEdita($id_eepp_detalle);

             $codigo = $materiaEEPP["codigo"];;
             $equipo = $materiaEEPP["material"];
             $arriendo = $equipo;
           } 

          
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>    
    <td ><div align="center"><?php echo $precio_oc?></div></td>  
    <td ><div align="center"><?php echo $cantidad_oc?></div></td>  
    <td ><div align="center"><?php echo $total?></div></td>

       
    <td align="left" nowrap="">
            
      <button class="btn btn-danger btn-xm" title="Eliminar" <?=$disable?> onclick="eliminarConsultaOC('<?php echo $value["id"]?>')">X</button>
    </td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
