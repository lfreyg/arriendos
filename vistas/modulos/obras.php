
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idConstructora"])){
  $_SESSION["idConstructora"] = $_GET["idConstructora"];
  $valorIdConstructora = $_GET["idConstructora"];
}else{
  $valorIdConstructora = $_SESSION["idConstructora"];
}


$constructora = ControladorConstructoras::ctrMostrarConstructoras("id",$valorIdConstructora);
$nombreConstructora = $constructora["nombre"];

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
      Administrar Obras de <?php echo $nombreConstructora;?>   
    </h1>

     

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="constructoras">Constructoras</a></li>
      
      <li class="active">Administrar Obras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">      

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevaObra" data-toggle="modal" data-target="#modalAgregarObra">

          
          Agregar Obra

        </button>

        <button class="btn btn-success" id="btnObraVolver" >
          
          
          Volver

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
         
       <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>           
           
          
           <th>Nombre Obra</th>
           <th>Bodeguero</th>
           <th>Dirección</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Cobro</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
        
           
           $respuestaObra = ModeloObras::mdlMostrarObrasIdConstructoras("obras", "id_constructoras", $valorIdConstructora, "ASC");

            foreach ($respuestaObra as $key => $value) {
                  
                 $formaCobroId = ControladorPerfiles::ctrMostrarFormaCobroId("id",$value["forma_cobro_id"]);                   
                 $nombreFormaCobro = $formaCobroId["descripcion"]; 
           
            echo ' <tr>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["contacto"].'</td>
                    <td class="text-uppercase">'.$value["direccion"].'</td>
                    <td class="text-uppercase">'.$value["telefono"].'</td>
                    <td class="text-uppercase">'.$value["email"].'</td>
                    <td class="text-uppercase">'.$nombreFormaCobro.'</td>';

                    if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivarObra" idObra="'.$value["id"].'" estadoObra="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivarObra" idObra="'.$value["id"].'" estadoObra="1">Desactivado</button></td>';

                  }      

             echo '       <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarObra" idObra="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarObra"><i class="fa fa-pencil"></i></button>                        

                          <button class="btn btn-danger btnEliminarObra" idObra="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        

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

                <select class="form-control input-lg" id="nuevaConstructoraId" name="nuevaConstructoraId">               
                  
                  <?php                 

                  $cliente = ControladorConstructoras::ctrMostrarConstructoras("id", $valorIdConstructora);

                 
                    
                    echo '<option value="'.$cliente["id"].'">'.$cliente["nombre"].'</option>';
                                  

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
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoNuevaObra" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>

               <!-- ENTRADA PARA DIRECCION -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionNuevaObra" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>

               <!-- ENTRADA PARA TELEFONO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" name="telefonoNuevaObra" data-inputmask="'mask':'999999999'" data-mask autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>

                <!-- ENTRADA PARA CORREO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="correoNuevaObra" autocomplete="off" placeholder="Correo">
                  </div>
               </div>

                <div class="form-group row">              
                  <div class="input-group">                      
                    <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                      <select class="form-control input-lg" id="formaCobroNuevaObra" name="formaCobroNuevaObra" required>                          
                           <option value="">Seleccionar Forma Cobro</option>
                          <?php                           

                            $formaPago = ControladorPerfiles::ctrMostrarFormaCobro();

                            foreach ($formaPago as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
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

                <select class="form-control input-lg" id="editarConstructoraId" disabled name="editarConstructoraId">                 
                  

                  <?php

                  $item = null;
                  $valor = null;

                  $cliente = ControladorConstructoras::ctrMostrarConstructoras($item, $valor);

                   foreach ($cliente as $key => $value) {
                    
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
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoEditarObra" id="contactoEditarObra" autocomplete="off" placeholder="Contacto">
                  </div>
               </div>

               <!-- ENTRADA PARA DIRECCION -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionEditarObra" id="direccionEditarObra" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>

               <!-- ENTRADA PARA TELEFONO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" data-inputmask="'mask':'999999999'" data-mask name="telefonoEditarObra" id="telefonoEditarObra" autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>

                <!-- ENTRADA PARA CORREO -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="correoEditarObra" id="correoEditarObra" autocomplete="off" placeholder="Correo">
                  </div>
               </div>

               <div class="form-group row">              
                  <div class="input-group">                      
                    <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                      <select class="form-control input-lg" id="formaCobroEditarObra" name="formaCobroEditarObra" required>                          
                           <option value="">Seleccionar Forma Cobro</option>
                          <?php                           

                            $formaPago = ControladorPerfiles::ctrMostrarFormaCobro();

                            foreach ($formaPago as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
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

          <button type="submit" class="btn btn-primary">Guardar Obra</button>

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


