<?php

require_once "../modelos/pedidoInternoDetalles.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

$id = $_POST['id'];
$idSucursal = $_POST['idSucursal'];
$estado = $_POST['estado'];

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
                  <th>Equipo</th>              
                  <th><div align="center">Solicito</div></th>
                  <th>Detalles</th>
                  <th><div align="center">Tengo</div></th>
                  <th><div align="center">Disponible</div></th> 
                  <th><div align="center">Revisión</div></th>                                   
                  <th><div align="center">Acciones</div></th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloPedidoInternoDetalles::mdlPedidoInternoPorId($id);
            $i = 0;


         foreach ($productos as $key => $value){

           $idCategoria = $value["idCategoria"];
           $equipo = $value["categoria"];
           $cantidad = $value["cantidad"];
           $detalle = $value["detalle"];
           $stock = $value["stock"];
           $repara = $value["revision"];
           $tengo = $value["tengo"];

            
          
           $i++; 
            
             $disabled = '';
            
            if($estado == 1){
              $disabled = "disabled";
            }else{
              $disabled = '';
            }
            
  ?>
  <tr>   
    <td ><div align="left"><?php echo $equipo?></div></td>
    <td ><div align="center"><?php echo $cantidad?></div></td>
    <td ><div align="left"><?php echo $detalle?></div></td>  
    <td ><div align="center"><?php echo $tengo?></div></td>  
    <td ><div align="center"><?php echo $stock?></div></td>  
    <td ><div align="center"><?php echo $repara?></div></td> 
       
    <td align="center" nowrap=""><span class="btn btn-warning btn-xm" title="Editar" onclick="editar('<?php echo $value["id"]?>')">E</span>
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $value["id"]?>')">X</button></td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
