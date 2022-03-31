<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idFactura'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Facturas de Compra Equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Facturas Compras Equipos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="nuevaCompraEquipo" data-toggle="modal" data-target="#modalAgregarFacturaCompra">
          
          Nueva Compra

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaFacturasCompra" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
           <th style="width:10px">#</th>           
           <th>Proveedor </th>
           <th>N° Factura</th>
           <th>Fecha Factura</th>
           <th>Fecha Ingreso</th>
           <th>Total Factura</th>  
           <th>Adjunto</th>       
           <th>Usuario</th>             
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

<div id="modalAgregarFacturaCompra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Factura Compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="nuevaProveFac" style="width: 100%;" name="nuevaProveFac" required>
                  
                  <option value="">Selecionar Proveedor</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                  foreach ($proveedores as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA NUMERO FACTURA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoNumeroFacturaCompra" name="nuevoNumeroFacturaCompra" autocomplete="off" placeholder="Numero Factura" required>

              </div>

            </div>

            <!-- ENTRADA FECHA FACTURA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaFacturaCompra" autocomplete="off" placeholder="Fecha" required>

              </div>

            </div>                      
          
            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FACTURA</div>

              <input type="file" name="nuevoArchivoPdf" id="nuevoArchivoPdf">

              <p class="help-block">Peso máximo archivo 2MB</p>
           

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Factura</button>

        </div>

        <?php

          $crearFactura = new ControladorFacturasCompra();
          $crearFactura -> ctrCrearFacturasCompra();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarFacturaCompra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Factura Compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarProveFac" style="width: 100%;" name="editarProveFac" required>
                  
                 
                  <?php

                  $item = null;
                  $valor = null;

                  $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                  foreach ($proveedores as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>

            <!-- ENTRADA NUMERO FACTURA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" class="form-control input-lg" id="editarNumeroFacturaCompra" name="editarNumeroFacturaCompra" autocomplete="off" placeholder="Numero Factura" required>
                <input type="hidden" id="idFacturaCompraEdita" name="idFacturaCompraEdita">
                <input type="hidden" id="imagenAnteriorFactura" name="imagenAnteriorFactura">

              </div>

            </div>

            <!-- ENTRADA FECHA FACTURA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="date" class="form-control input-lg" id="editarFechaFacturaCompra" name="editarFechaFacturaCompra" autocomplete="off" placeholder="Fecha" required>

              </div>

            </div>                        

            

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FACTURA</div>

              <input type="file" name="editarArchivoPdf" id="editarArchivoPdf">
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

          $editarFactura = new ControladorFacturasCompra();
          $editarFactura -> ctrEditarFacturaCompra();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $eliminarProducto = new ControladorFacturasCompra();
  $eliminarProducto -> ctrEliminarFacturaCompra();

?>      



