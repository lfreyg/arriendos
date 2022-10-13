<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idPedidoInterno'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Pedido Interno de equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Pedido Interno de equipos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoPedido" data-toggle="modal" data-target="#modalAgregarPedido">
          
          Nuevo Pedido Interno

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaPedido" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
           <th style="width:12px">N° Pedido</th>  
           <th style="width:20px">Fecha Pedido</th>           
           <th style="width:60px">Solicitado Por</th>
           <th style="width:60px">Estado</th>
           <th style="width:10px">Acciones</th>
           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarPedido" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Pedido Interno</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           

            <!-- ENTRADA PARA SELECCIONAR SUCURSAL -->

             <div class="form-group">
              
              <div class="input-group">
                 
                 <input type="hidden" name="sucursales" id="sucursales" value="1">

                  <h3>Se agregará un nuevo pedido interno de equipos, para generarlo haga clic en CONTINUAR, si desea cancelar, cierre con el botón SALIR</h3>

              </div>

            </div>
        

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Continuar</button>

        </div>

        <?php

          $crearPedido = new ControladorPedidoInterno();
          $crearPedido -> ctrCrearPedidoInterno();

        ?>

      </form>

    </div>

  </div>

</div>




<?php

  $eliminarPedido = new ControladorPedidoInterno();
  $eliminarPedido -> ctrEliminarPedidoInterno();

?>      



<script src="vistas/js/pedidoInterno.js?v=<?php echo(rand());?>"></script>