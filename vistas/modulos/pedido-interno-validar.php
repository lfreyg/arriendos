<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idPedidoInternoValidar'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Validar Pedido Interno de equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Validar Pedido Interno</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaValidarPedido" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
           <th style="width:12px">N° Pedido</th>  
           <th style="width:20px">Fecha Pedido</th>           
           <th style="width:60px">Solicitado Por</th>
           <th style="width:60px">Estado</th>
           <th style="width:10px">Validar</th>
           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>



<script src="vistas/js/pedidoInterno.js?v=<?php echo(rand());?>"></script>