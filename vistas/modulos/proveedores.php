
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
      
      Administrar Proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoProveedor" data-toggle="modal" data-target="#modalAgregarProveedor">
          
          Agregar Proveedor

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>           
           
           <th>Rut</th>
           <th>Razón Social</th>
           <th>Contacto</th>
           <th>Dirección</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $Proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

          foreach ($Proveedores as $key => $value) {
           
            echo ' <tr>                    
                    <td class="text-uppercase">'.$value["rut"].'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["contacto"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>
                    <td class="text-uppercase">'.$value["email"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fa fa-pencil"></i></button>                        

                          <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        

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
MODAL AGREGAR PROVEEDOR
======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUT -->
            
            <div class="form-group row">                             
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                     <input type="text" class="form-control input-lg" name="rutNuevaProveedor" onkeyup="formatProveedor(this)" maxlength="12" autofocus autocomplete="off" id="rutNuevaProveedor" placeholder="Rut" required>
                  </div>
             </div>
           

           

            <!-- ENTRADA PARA RAZON SOCIAL -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreNuevaProveedor" autocomplete="off" placeholder="Razón Social" required>
                  </div>
               </div>

                <!-- ENTRADA PARA CONTACTO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoNuevaProveedor" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>

               <!-- ENTRADA PARA DIRECCION -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionNuevaProveedor" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>

               <!-- ENTRADA PARA TELEFONO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" data-inputmask="'mask':'999999999'" data-mask name="telefonoNuevaProveedor" autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>

                <!-- ENTRADA PARA CORREO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="correoNuevaProveedor" autocomplete="off" placeholder="Correo">
                  </div>
               </div>

           



  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Proveedor</button>

        </div>

        <?php

          $crearCategoria = new ControladorProveedores();
          $crearCategoria -> ctrCrearProveedor();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUT -->
            
            <div class="form-group row">                             
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                     <input type="text" class="form-control input-lg" name="rutEditarProveedor" id="rutEditarProveedor" disabled>
                     <input type="hidden"  name="idProveedores" id="idProveedores">
                  </div>
             </div>
           

           

            <!-- ENTRADA PARA RAZON SOCIAL -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreEditarProveedor" id="nombreEditarProveedor" autocomplete="off" placeholder="Razón Social" required>
                  </div>
               </div>

                <!-- ENTRADA PARA CONTACTO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoEditarProveedor" id="contactoEditarProveedor" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>

               <!-- ENTRADA PARA DIRECCION -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionEditarProveedor" id="direccionEditarProveedor" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>

               <!-- ENTRADA PARA TELEFONO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" data-inputmask="'mask':'999999999'" data-mask name="telefonoEditarProveedor" id="telefonoEditarProveedor" autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>

                <!-- ENTRADA PARA CORREO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="correoEditarProveedor" id="correoEditarProveedor" autocomplete="off" placeholder="Correo">
                  </div>
               </div>

           



  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Proveedor</button>

        </div>

        <?php

          $crearCategoria = new ControladorProveedores();
          $crearCategoria -> ctrEditarProveedor();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCategoria = new ControladorProveedores();
  $borrarCategoria -> ctrBorrarProveedor();

?>


