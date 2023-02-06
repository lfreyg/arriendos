<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idGuiaPedidoObra'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Detalle de Pedidos para obra
    
    </h1>   

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnDespachoPedidos">
          
          Pedidos de Obras Pendientes

        </button>

      </div>
      
      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaPedidoDetalle" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>        
           <th>Constructora</th>
           <th>Obra</th>
           <th>Comuna</th>           
           <th>Pedido</th>  
           <th>Equipo</th>
           <th>Fecha</th>
           <th>Tipo</th>
           <th>Vendedor</th>
           <th>Sucursal</th>
           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>









<script src="vistas/js/despacharPedidoEquipos.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

         
     verDetalle();

   });     

  


     

</script>