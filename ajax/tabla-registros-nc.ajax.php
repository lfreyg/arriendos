<?php
require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/eepp.modelo.php";
require_once "../controladores/eepp.controlador.php";
require_once "../modelos/ordenCompra.modelo.php";

 

$idNC = $_POST['idNC'];

$eeppCobro = ModeloFacturacionEEPP::mdlMostrarRegistrosNC($idNC);

?>



  
                     
 
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaNC" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >                                         
                  <th width="40%">Descripción</th> 
                  <th width="40%">Neto</th>
                  <th width="10%">Quitar</th> 
                </tr>

    </thead>
     <tbody>
   
  <?php
                            
            for($i = 0; $i < count($eeppCobro); $i++){   

              $id = $eeppCobro[$i]["id"];             
              $descripcion = $eeppCobro[$i]["descripcion"];             
              $valor = $eeppCobro[$i]["valor"];
              
   
            
  ?>
  <tr>     
      </td>      
    <td ><div align="left"><?= $descripcion?></div></td>
    <td ><div align="right"><?= '$ '.number_format($valor,0,'','.')?></div></td> 
     <td align="center" nowrap=""><button class="btn btn-danger btn-xm" onclick="quitarRegistroNC('<?=$id?>')"></button>
    
     
   
  </tr> 
  <?php
      }
  ?> 
   </tbody>
</table>

   

