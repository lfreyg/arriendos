<?php

require_once "../modelos/equipos.modelo.php";


$id = $_POST['idEquipo'];

$equipoSQL = ModeloEquipos::mdlMostrarEquiposMantenedorUno($id);

$codigoEquipo = $equipoSQL["codigo"];
$equipo = $equipoSQL["descripcion"].' '.$equipoSQL["modelo"].' '.$equipoSQL["marca"];

 
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
<h4>Código: <?=$codigoEquipo?></h4>  
<h4>Equipo: <?=$equipo?></h4>  
<br>
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaHistoriaEstados"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                 
                  <th style="width: 25%;">Estado Solicitado</th>   
                  <th style="width: 25%;">Estado Aprobado</th> 
                  <th style="width: 15%;">Fecha Sol</th> 
                  <th style="width: 15%;">Fecha Aprobación</th>                 
                  <th style="width: 15%;">Ver</th>                   
                </tr>

    </thead>
     <tbody>
   
  <?php
         
          $productos = ModeloEquipos::mdlTraerHistoriaEstadosEquipo($id);   
           
         foreach ($productos as $key => $value){
           
            $idLog = $value["idLog"];
            $estadoAnterior = $value["estadoAnterior"];
            $estadoSolicitado = $value["estadoSolicitado"];
            $fechaSolicitud = $value["fecha_real"];
            $fecha_aprueba = $value["fecha_aprueba"];
            $solicitante = $value["usuario"];
            $aprobador = $value["aprobador"];
            $sucursal = $value["sucursal"];
            $motivo = $value["motivo"];

            $dateReg = date_create($fechaSolicitud);
            $fechaSolicitud = date_format($dateReg,"d-m-Y H:i:s");

            $dateReg = date_create($fecha_aprueba);
            $fecha_aprueba = date_format($dateReg,"d-m-Y H:i:s");

            $boton = "<button class='btn btn-primary btn-xm' onclick='verComprobante('<?php echo $idLog?>')'>PDF</button>";


           
           
  ?>
  <tr>
    <td ><div align="left"><?=$estadoAnterior?></div></td>
    <td ><div align="left"><?=$estadoSolicitado?></div></td>
    <td ><div align="left"><?=$fechaSolicitud?></div></td>
    <td ><div align="left"><?=$fecha_aprueba?></div></td>   
     <td align="center" nowrap=""><button class="btn btn-primary btn-xm" onclick="verComprobanteCambioEstado('<?php echo $idLog?>')">PDF</button>
      </td>  
    
    
    
  </tr>
  <?php
    }
  ?>
   </tbody>
</table>



</body>
</html>
