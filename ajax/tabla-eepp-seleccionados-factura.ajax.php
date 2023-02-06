<?php

require_once "../modelos/facturacion.modelo.php";
require_once "../controladores/eepp.controlador.php";

$idFactura = $_GET['idFactura'];

$facturacion = ModeloFacturacionEEPP::obtenerDatosFactura($idFactura);
$estadoFactura = $facturacion["estado_factura"];

$disable = '';
if($estadoFactura == 7 || $estadoFactura == 13 || $estadoFactura == 14){
   $disable = "disabled";
}

 $productos = ModeloFacturacionEEPP::mdlMostrarListadoEEPPSeleccionado($idFactura);

 if(!$productos){
  echo '';
  die;
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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaSeleccionaEEPP"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>EEPP Seleccionado</th>        
                  <th>Quitar</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
           
         $contar = 0;
         foreach ($productos as $key => $value){

           $id = $value["idEEPPSeleccion"];
           $fecha = $value["fechaEEPP"];
           $idEEPP = $value["idEEPP"];
          
           $dateReg = date_create($fecha);
           $hasta = date_format($dateReg,"d-m-Y");

              $mes = date_format($dateReg,"m");
              $anno = date_format($dateReg,"Y");
              $nombreMes = ControladorEEPP::ctrNombreMeses($mes);

              $periodo = $nombreMes.'-'.$anno;
           
           $disabled = '';
           $disabled_valida = '';

           $contar++;

          

          
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $periodo?></div></td>
       
    <td align="left" nowrap="">
            
      <button class="btn btn-danger btn-xm" <?php echo $disable?> title="Eliminar" onclick="eliminarEEPPSeleccionado('<?php echo $id?>','<?php echo $idEEPP?>')">X</button>
    </td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>  
</body>
</html>
