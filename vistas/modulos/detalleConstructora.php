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
      
      Detalle Constructoras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Detalle Constructoras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarObra">
          
          Agregar Obra

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablasDetalles" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr> 
           <th>Nombre</th>
           <th>Contacto</th>
           <th>Dirección</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          
           $respuestaObra = ModeloObras::mdlMostrarObras("obras", "id_constructoras", $_GET["idConstructora"], "ASC");
         
           var_dump($respuestaObra);
           die();

           $constructora = ControladorConstructoras::ctrMostrarConstructoras("id",$_GET["idConstructora"]);
                  $nombreConstructora = $constructora["nombre"];

                                  
          
        if($respuestaObra){
          foreach ($respuestaObra as $key => $value) {          
                       
            echo ' <tr>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["contacto"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>
                    <td class="text-uppercase">'.$value["email"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarDetalle" idObra="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarObra"><i class="fa fa-pencil"></i></button>                        

                          <button class="btn btn-danger btnEliminarDetalle" idObra="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        

                      </div>  

                    </td>

                  </tr>';
          }
        }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarObra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Obra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

                      
           <!-- ENTRADA PARA SELECCIONAR CONSTRUCTORA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="nuevaConstructora" style="width: 100%;" name="nuevaConstructora" disabled>
                  
                  <option value="">Seleccionar Constructora</option>

                  <?php

                  $item = 'id';
                  $valor = $_GET["idConstructora"];

                  $constructoras = ControladorConstructoras::ctrMostrarConstructoras($item, $valor);

                  foreach ($constructoras as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>
           

           

            <!-- ENTRADA PARA NOMBRE OBRA -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreNuevaObra" id="nombreNuevaObra" autocomplete="off" placeholder="Nombre Obra" required>
                  </div>
               </div>

                <!-- ENTRADA PARA CONTACTO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoNuevaObra" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>

               <!-- ENTRADA PARA DIRECCION -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionNuevaObra" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>

               <!-- ENTRADA PARA TELEFONO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="telefonoNuevaObra" autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>

                <!-- ENTRADA PARA CORREO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="correoNuevaObra" autocomplete="off" placeholder="Correo">
                  </div>
               </div>

           



  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Obra</button>

        </div>

        <?php

          $crearCategoria = new ControladorObras();
          $crearCategoria -> ctrCrearObra();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarObra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Obra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA PARA SELECCIONAR CONSTRUCTORA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="editarConstructora" style="width: 100%;" name="editarConstructora" disabled>
                  
                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorConstructoras::ctrMostrarConstructoras($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>
           

           

            <!-- ENTRADA PARA NOMBRE DE OBRA -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreEditarObra" id="nombreEditarObra" autocomplete="off" placeholder="Nombre Obra" required>

                     <input type="hidden" id="idObras" name="idObras">
                  </div>
               </div>

                <!-- ENTRADA PARA CONTACTO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoEditarObra" id="contactoEditarObra" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>

               <!-- ENTRADA PARA DIRECCION -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionEditarObra" id="direccionEditarObra" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>

               <!-- ENTRADA PARA TELEFONO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="telefonoEditarObra" id="telefonoEditarObra" autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>

                <!-- ENTRADA PARA CORREO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="correoEditarObra" id="correoEditarObra" autocomplete="off" placeholder="Correo">
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

          $crearCategoria = new ControladorObras();
          $crearCategoria -> ctrEditarObra();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCategoria = new ControladorObras();
  $borrarCategoria -> ctrBorrarObra();

?>


