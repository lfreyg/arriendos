<?php

require_once "../modelos/facturacion.modelo.php";
require_once "../controladores/eepp.controlador.php";

$idFactura = $_GET['idFactura'];
$idObra = $_GET['idObra'];

$facturacion = ModeloFacturacionEEPP::mdlValidarFacturaOC($idFactura);

$disable = '';
if($facturacion){
  

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaFacturaOC"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>Periodo</th> 
                  <th>Orden Compra</th> 
                  <th>Fecha OC</th>       
                  <th>Selecionar</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $oc = ModeloFacturacionEEPP::mdlOCParaFacturar($idObra);
         $contar = 0;
         foreach ($oc as $key => $value){

           $id = $value["idOC"];
           $idEEPP = $value["id_eepp"];
           $numOC = $value["numero_oc"];
           $fecOC = $value["fecha_oc"];
           $id_factura = $value["id_factura"];           
           $fecha = $value["fecha_corte"];
           
           $dateReg = date_create($fecOC);
           $fecOC = date_format($dateReg,"d-m-Y");
          
           $dateReg = date_create($fecha);
           $hasta = date_format($dateReg,"d-m-Y");

              $mes = date_format($dateReg,"m");
              $anno = date_format($dateReg,"Y");
              $nombreMes = ControladorEEPP::ctrNombreMeses($mes);

              $periodo = $nombreMes.'-'.$anno;

              if($idFactura == $id_factura){
                $disable = '';
              }
           
          

           $contar++;

          

          
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $periodo?></div></td>
    <td ><div align="left"><?php echo $numOC?></div></td>
    <td ><div align="left"><?php echo $fecOC?></div></td>
       
    <td align="left" nowrap="">
            
      <button class="btn btn-success btn-xm" <?php echo $disable?> title="Eliminar" onclick="eliminarEEPPSeleccionado('<?php echo $id?>','<?php echo $idEEPP?>')">X</button>
    </td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>  
</body>
</html>
<?php


}

?>