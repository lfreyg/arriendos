<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";

 
$idFactura = $_GET['idFactura'];

$referencias = ModeloFacturacionEEPP::mdlReferenciaFacturas($idFactura);


?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaDetalleReferenciaFactura" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="10%">Código</th>
                  <th width="10%">Referencia</th>
                  <th width="10%">Documento</th>
                  <th width="10%">Fecha</th> 
                </tr>

    </thead>
     <tbody>
   
  <?php

     for($x = 0; $x < count($referencias); $x++){ 

             $id = $referencias[$x]["id"];
             $codigo = $referencias[$x]["codigo_referencia"];
             $descripcion = $referencias[$x]["descripcion"];
             $numero_referencia = $referencias[$x]["numero_referencia"];
             $fecha_referencia = $referencias[$x]["fecha_referencia"];


      
              


                            
            
  ?>
  <tr>   
    <td ><div align="left"><?=$codigo?></div></td> 
    <td ><div align="right"><?=$descripcion?></div></td> 
    <td ><div align="right"><?=$numero_referencia?></div></td> 
    <td ><div align="right"><?=$fecha_referencia?></div></td>        
  </tr>
  <?php
                
                

             


 }

  ?>
   </tbody>
</table>

   </tbody>
</table>






   



