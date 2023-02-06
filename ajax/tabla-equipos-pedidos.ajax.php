<?php

require_once "../modelos/pedidoDetalles.modelo.php";

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
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaCompraDespliega"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th>#</th>                              
                  <th>Equipo</th>                 
                  <th>Detalles</th>
                  <th>Tipo</th>                                    
                  <th>Acciones</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloPedidoDetalles::mdlPedidoPorId($id);
            $i = 0;


         foreach ($productos as $key => $value){

           $categoria = $value["categoria"];          
           $tipo = $value["tipo"];
           $detalle = $value["detalle"];
           $movimiento = $value["entrega"];
           $guiaDespacho = $value["id_guia_despacho"];
           $i++; 
            
            
            if($guiaDespacho != null){
              $disabled = "disabled";
            }else{
              $disabled = '';
            }
  ?>
  <tr>
    <td><div align="center"><?php echo $i?></div></td>
    <td ><div align="left"><?php echo $categoria?></div></td>    
    <td ><div align="left"><?php echo $detalle?></div></td>  
    <td ><div align="left"><?php echo $tipo?></div></td>  
       
    <td align="center" nowrap="">
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $value["id"]?>')">X</button></td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
</body>
</html>
