
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Transportistas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Transportistas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoChofer" data-toggle="modal" data-target="#modalAgregarChofer">
          
          Agregar Transportista

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Rut</th>
           <th>Nombre</th>
           <th>Patente</th>
           <th>Rut Empresa Transporte</th>          
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $choferes = ControladorTransportistas::ctrMostrarTransportista($item, $valor);

          foreach ($choferes as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["rut"].'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["patente"].'</td>
                    <td class="text-uppercase">'.$value["rut_empresa_transporte"].'</td>
                    

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarChofer" idChofer="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarChofer"><i class="fa fa-pencil"></i></button>                        

                          <button class="btn btn-danger btnEliminarChofer" idChofer="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        

                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarChofer" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Transportista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUT DEL CHOFER -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevaRutChofer" name="nuevaRutChofer" onkeyup="formatProveedor(this)" maxlength="12" autofocus autocomplete="off" placeholder="Rut Transportista" required>

              </div>

            </div>

            <!-- ENTRADA PARA NOMBRE CHOFER -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaNombreChofer" autocomplete="off" placeholder="Nombre Transportista" required>

              </div>

            </div>

            <!-- ENTRADA PARA PATENTE VEHICULO CHOFER -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" maxlength="6" name="nuevaPatenteChofer" autocomplete="off" placeholder="Patente vehiculo" required>

              </div>

            </div>

             <!-- ENTRADA PARA EMPRESA DE TRANSPORTES -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                 <select class="form-control input-lg" name="nuevaEmpresa" id="nuevaEmpresa">  
                  <?php
                      $item = null;
                      $valor = null;

                      $perfiles = ModeloTransportista::mdlEmpresaTransporte(null);

                     foreach ($perfiles as $key => $value) {
                    
                         echo '<option value="'.$value["rut"].'">'.$value["rut"].'</option>';
                      }

                  ?>

                </select>

              </div>

            </div>

  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Transportista</button>

        </div>

        <?php

          $crearChofer = new ControladorTransportistas();
          $crearChofer -> ctrCrearTransportista();

        ?>

      </form>

    </div>

  </div>

</div>







<!--=====================================
MODAL EDITAR CHOFER
======================================-->

<div id="modalEditarChofer" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Transportista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUT -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarRut" id="editarRut" autocomplete="off" readonly>

                 <input type="hidden"  name="idTransportista" id="idTransportista">

              </div>

            </div>

            <!-- ENTRADA PARA NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" autocomplete="off" readonly>

              </div>

            </div>

             <!-- ENTRADA PARA CONTACTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" maxlength="6" name="editarPatente" id="editarPatente" autocomplete="off" required placeholder="Patente">

              </div>

            </div>

            <!-- ENTRADA PARA TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" name="editarEmpresa" id="editarEmpresa">  
                  <?php
                      $item = null;
                      $valor = null;

                      $perfiles = ModeloTransportista::mdlEmpresaTransporte(null);

                     foreach ($perfiles as $key => $value) {
                    
                         echo '<option value="'.$value["rut"].'">'.$value["rut"].'</option>';
                      }

                  ?>

                </select>               

              </div>

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

          $editarCategoria = new ControladorTransportistas();
          $editarCategoria -> ctrEditarTransportista();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCategoria = new ControladorTransportistas();
  $borrarCategoria -> ctrBorrarTransportista();

?>


<script src="vistas/js/transportista.js?v=<?php echo(rand());?>"></script>