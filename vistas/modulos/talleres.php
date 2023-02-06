
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
      
      Administrar Talleres Externos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Talleres</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoTaller" data-toggle="modal" data-target="#modalAgregarTaller">
          
          Nuevo Taller

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>           
           
           <th>Rut</th>
           <th>Razón Social</th>
           <th>Dirección</th>
           <th>Teléfono</th>
           <th>Correo</th>
           <th>Contacto</th>
           <th>Comuna</th>
           <th>Ciudad</th>           
           <th>Estado</th>           
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $id = null;
         

          $talleres = ModeloTalleres::mdlMostrarTalleres($id);

          foreach ($talleres as $key => $value) {                
                    
            echo ' <tr>                    
                    <td class="text-uppercase">'.$value["rut"].'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td> 
                    <td class="text-uppercase">'.$value["direccion"].'</td> 
                    <td class="text-uppercase">'.$value["telefono"].'</td>
                    <td class="text-uppercase">'.$value["correo"].'</td>
                    <td class="text-uppercase">'.$value["contacto"].'</td>
                    <td class="text-uppercase">'.$value["comuna"].'</td>                    
                    <td class="text-uppercase">'.$value["ciudad"].'</td>';


              if($value["activo"] == true){

                    echo '<td><button class="btn btn-success btn-xs btnActivarTaller" idTaller="'.$value["id"].'" estadoTaller="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivarTaller" idTaller="'.$value["id"].'" estadoTaller="1">Desactivado</button></td>';

                  }                                  

            echo'  <td width="150" height="21" nowrap="nowrap">

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarTaller" title="Editar" idTaller="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarTaller"><i class="fa fa-pencil"></i></button>                        

                          <button class="btn btn-danger btnEliminarTaller" title="Eliminar" idTaller="'.$value["id"].'"><i class="fa fa-times"></i></button>                        

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
MODAL AGREGAR TALLER
======================================-->

<div id="modalAgregarTaller" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Nuevo Taller Externo</h4>

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
                     <input type="text" class="form-control input-lg" name="rutTaller" onkeyup="formatTaller(this)" maxlength="12" autofocus autocomplete="off" id="rutTaller" placeholder="Rut" required>
                  </div>
             </div>         

           

              
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreTaller" autocomplete="off" placeholder="Razón Social" required>
                  </div>
               </div>       

             
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionTaller" autocomplete="off" placeholder="Dirección" required>
                  </div>
               </div>      

                   
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" name="telefonoTaller" data-inputmask="'mask':'999999999'" data-mask autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>   

                <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="correoTaller" autocomplete="off" placeholder="Correo">
                  </div>
               </div>   

                      
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoTaller" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>    

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-times"></i></span> 
                     <input type="text" class="form-control input-lg" name="comunaTaller" autocomplete="off" placeholder="Comuna" required>
                  </div>
               </div> 

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-times"></i></span> 
                     <input type="text" class="form-control input-lg" name="ciudadTaller" autocomplete="off" placeholder="Ciudad" required>
                  </div>
               </div>  

                

           </div>
  
          </div>

        

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Taller</button>

        </div>

        <?php

          $crearCategoria = new ControladorTalleres();
          $crearCategoria -> ctrCrearTaller();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarTaller" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Taller Externo</h4>

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
                     <input type="text" class="form-control input-lg" name="rutTallerE" id="rutTallerE" disabled>
                     <input type="hidden"  name="idTallerTxt" id="idTallerTxt">
                  </div>
             </div>
           

           

            <!-- ENTRADA PARA RAZON SOCIAL -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreTallerE" id="nombreTallerE" autocomplete="off" placeholder="Razón Social" required>
                  </div>
               </div>       

             
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionTallerE" id="direccionTallerE" autocomplete="off" placeholder="Dirección" required>
                  </div>
               </div>      

                   
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" name="telefonoTallerE" id="telefonoTallerE" data-inputmask="'mask':'999999999'" data-mask autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>   

                <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="correoTallerE" id="correoTallerE" autocomplete="off" placeholder="Correo">
                  </div>
               </div>   

                      
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoTallerE" id="contactoTallerE" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>    

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-times"></i></span> 
                     <input type="text" class="form-control input-lg" name="comunaTallerE" id="comunaTallerE" autocomplete="off" placeholder="Comuna" required>
                  </div>
               </div> 

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-times"></i></span> 
                     <input type="text" class="form-control input-lg" name="ciudadTallerE" id="ciudadTallerE" autocomplete="off" placeholder="Ciudad" required>
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

          $crearCategoria = new ControladorTalleres();
          $crearCategoria -> ctrEditarTaller();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCategoria = new ControladorTalleres();
  $borrarCategoria -> ctrBorrarConstructora();

?>


<script src="vistas/js/talleres.js?v=<?php echo(rand());?>"></script>