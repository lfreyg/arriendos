<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idPedidoEquipo'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Pedido de equipos para obra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Pedido de equipos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoPedido" data-toggle="modal" data-target="#modalAgregarPedido">
          
          Nuevo Pedido

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaPedido" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
           <th style="width:10px">#</th>           
           <th>Constructora </th>
           <th>Obra</th>
           <th>Sucursal</th>           
           <th>OC</th>   
           <th>Documento</th>        
           <th>Fecha Pedido</th>
           <th>Estado</th>
           <th>Acciones</th>
           
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

          <h4 class="modal-title">Agregar Pedido</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- COMBO CLIENTE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="nuevaPedidoConstructora" style="width: 100%;" name="nuevaPedidoConstructora" required>
                  
                  <option value="">Seleccionar Constructora</option>

                  <?php

                  $cliente = ControladorConstructoras::ctrMostrarConstructorasActivas();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>

            </div>
          

          <!-- COMBO OBRA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span>                
                   <div id="nueva_obras_combo_pedido"></div>               
              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SUCURSAL -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaSucursalPedido" name="nuevaSucursalPedido" required>
                  
                  <option value="">Seleccionar sucursal</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $sucursales = ControladorSucursales::ctrMostrarSucursales($item, $valor);

                  foreach ($sucursales as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

           

            <!-- ENTRADA ORDEN COMPRA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPedidoOC" id="nuevoPedidoOC" autocomplete="off" placeholder="Orden Compra">

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

          $crearPedido = new ControladorPedidoEquipo();
          $crearPedido -> ctrCrearPedidoEquipo();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarPedidoEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Pedido</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editaPedidoConstructora" style="width: 100%;" name="editaPedidoConstructora" required>                 
              
                  <?php

                  $cliente = ControladorConstructoras::ctrMostrarConstructorasActivas();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>

            </div>

             <!-- COMBO OBRA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span>                
                   <div id="edita_obras_combo_pedido"></div>               
              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SUCURSAL -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editaSucursalPedido" name="editaSucursalPedido" required>
                  
                
                  <?php

                  $item = null;
                  $valor = null;

                  $sucursales = ControladorSucursales::ctrMostrarSucursales($item, $valor);

                  foreach ($sucursales as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA ORDEN COMPRA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editaPedidoOC" id="editaPedidoOC" autocomplete="off" placeholder="Orden Compra">
                <input type="hidden" id="idPedidoEquipoEdita" name="idPedidoEquipoEdita">
                <input type="hidden" id="docAnteriorPedido" name="docAnteriorPedido">

              </div>

            </div>   


            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR DOCUMENTO</div>

              <input type="file" name="editaPedidoDoc" id="editaPedidoDoc">
              <p class="help-block">Peso máximo archivo 2MB</p>

             
           

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php

          $editarPedido = new ControladorPedidoEquipo();
          $editarPedido -> ctrEditarPedidoEquipo();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $eliminarProducto = new ControladorPedidoEquipo();
  $eliminarProducto -> ctrEliminarPedidoEquipo();

?>      



<script src="vistas/js/pedidoEquipos.js?v=<?php echo(rand());?>"></script>