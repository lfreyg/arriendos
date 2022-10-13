<?php

require_once "../modelos/guiaDespacho.modelo.php";
require_once "../controladores/guiaDespacho.controlador.php";

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaGuiasTrasladoPedido"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                     
                  <th><div align="center">Generada Por</div></th> 
                  <th><div align="center">Origen</div></th>
                  <th><div align="center">N° Guía</div></th>
                  <th><div align="center">Fecha</div></th>                   
                  <th><div align="center">Transportado</div></th>   
                  <th><div align="center">Estado</div></th>                                
                  <th><div align="center">Ver</div></th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloGuiaDespacho::mdlGuiaDespachoTrasladoPedido($id);
            $i = 0;


         foreach ($productos as $key => $value){

           $generadoPor = $value["usuarioCrea"];
           $origen = $value["sucursalOrigen"];
           $numeroGuia = $value["numeroGuia"];

           $dateReg = date_create($value["fecha"]);
           $fecha = date_format($dateReg,"d-m-Y");
                   
           $chofer = $value["chofer"];
           $estado = $value["estadoGuia"];
           $idGuia = $value["idGuia"];
          
            
          
           $i++; 
            
             $disabled = '';
            
            if($estado == 1){
              $disabled = "disabled";
            }else{
              $disabled = '';
            }
            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $generadoPor?></div></td>
    <td ><div align="left"><?php echo $origen?></div></td>
    <td ><div align="center"><?php echo $numeroGuia?></div></td>  
    <td ><div align="center"><?php echo $fecha?></div></td>  
    <td ><div align="left"><?php echo $chofer?></div></td>  
    <td ><div align="left"><?php echo $estado?></div></td> 
       
    <td align="center" nowrap=""><span class="btn btn-warning btn-xm" title="Ver" onclick="verGuia('<?php echo $idGuia?>')">?</span>
      </td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
