<?php

require_once "../modelos/estados.modelo.php";


 
$idUsuario = $_POST['idUsuario'];

$estados = ModeloEstados::mdlEstadosSeleccionados($idUsuario);


?>



  
                     
 <h4><strong>Estados Autorizados</strong></h4>
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaEstadosSeleccionados" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="50%">Estado</th>
                  <th width="10%">Quitar</th>                 
                </tr>

    </thead>
     <tbody>
   
  <?php

     for($x = 0; $x < count($estados); $x++){ 

             $id = $estados[$x]["id"];            
             $descripcion = $estados[$x]["descripcion"];
            
                            
            
  ?>
  <tr>       
    <td ><div align="left"><?=$descripcion?></div></td> 
     <td align="center" nowrap=""><button class="btn btn-danger btn-xm" onclick="quitarEstado('<?=$id?>')"></button>     
  </tr>
  <?php
                
                

             


 }

  ?>
   </tbody>
</table>

   </tbody>
</table>






   



