<?php

require_once "../modelos/estados.modelo.php";


 
$idUsuario = $_POST['idUsuario'];

$estados = ModeloEstados::mdlEstadosDisponibles($idUsuario);


?>



  
                     
 <h4><strong>Estados Disponibles</strong></h4>
<table class="table-bordered table-striped table-hover dt-responsive" id="tablaEstados" width="100%"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr >   
                  <th width="50%">Estado</th>
                  <th width="10%">Seleccionar</th>                 
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
     <td align="center" nowrap=""><button class="btn btn-success btn-xm" onclick="agregarEstado('<?=$id?>')"></button>     
  </tr>
  <?php
                
                

             


 }

  ?>
   </tbody>
</table>

   </tbody>
</table>






   



