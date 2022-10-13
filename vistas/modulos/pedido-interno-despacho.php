<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idPedidoInternoDespacho'] = '';
$_SESSION["idGuiaDespachoTraslado"] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Despacho Pedido Interno de equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Despacho Pedido</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaDespachoPedido" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
           <th style="width:12px">N° Pedido</th>  
           <th style="width:20px">Fecha Pedido</th>           
           <th style="width:60px">Solicitado Por</th>
           <th style="width:60px">Sucursal</th>           
           <th style="width:10px">Despachar</th>
           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>









<script src="vistas/js/pedidoInternoDespacho.js?v=<?php echo(rand());?>"></script>