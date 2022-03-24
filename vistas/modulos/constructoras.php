
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
session_start();
$_SESSION['idConstructora'] = null;

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Constructoras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Constructoras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevaConstructora" data-toggle="modal" data-target="#modalAgregarConstructora">
          
          Agregar Constructora

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
           <th>Contacto Cobranza</th>
           <th>Teléfono Cobranza</th>
           <th>Correo Cobranza</th>
           <th>Forma Pago</th>
           <th>Estado</th>           
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $Constructoras = ControladorConstructoras::ctrMostrarConstructoras($item, $valor);

          foreach ($Constructoras as $key => $value) { 

                                             

          $formaPagoId = ControladorPerfiles::ctrMostrarFormaPagoId("id",$value["forma_pago_id"]);                   
          $nombreFormaPago = $formaPagoId["descripcion"];

         
          if($value["forma_pago_id"] == 7 || $value["forma_pago_id"] == 8){
            if(!empty($value["banco"]) || $value["banco"] != 0){
                $bancoId = ControladorPerfiles::ctrMostrarBancosId("id",$value["banco"]);
                $banco = " (".$bancoId["nombre"].")";
          }else{
                $banco = "";
          }
        }else{
            $banco = ""; 
        }

           
            echo ' <tr>                    
                    <td class="text-uppercase">'.$value["rut"].'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td> 
                    <td class="text-uppercase">'.$value["direccion"].'</td> 
                    <td class="text-uppercase">'.$value["telefono"].'</td>
                    <td class="text-uppercase">'.$value["contacto_cobranza"].'</td>
                    <td class="text-uppercase">'.$value["telefono_cobranza"].'</td>
                    <td class="text-uppercase">'.$value["email_cobranza"].'</td>
                    <td class="text-uppercase">'.$nombreFormaPago.$banco.'</td>';


              if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivarConstructora" idConstructora="'.$value["id"].'" estadoConstructora="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivarConstructora" idConstructora="'.$value["id"].'" estadoConstructora="1">Desactivado</button></td>';

                  }                                  

            echo'  <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarConstructora" title="Editar" idConstructora="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarConstructora"><i class="fa fa-pencil"></i></button>                        

                          <button class="btn btn-danger btnEliminarConstructora" title="Eliminar" idConstructora="'.$value["id"].'"><i class="fa fa-times"></i></button>

                          <button class="btn btn-info btnDetalleConstructora" title="Obras" idConstructora="'.$value["id"].'">
                        <i class="fa fa-th"></i></button>

                        

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

<div id="modalAgregarConstructora" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Constructora</h4>

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
                     <input type="text" class="form-control input-lg" name="rutNuevaConstructora" onkeyup="formatConstructora(this)" maxlength="12" autofocus autocomplete="off" id="rutNuevaConstructora" placeholder="Rut" required>
                  </div>
             </div>         

           

              
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreNuevaConstructora" autocomplete="off" placeholder="Razón Social" required>
                  </div>
               </div>       

             
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" name="direccionNuevaConstructora" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>      

                   
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" name="telefonoNuevaConstructora" data-inputmask="'mask':'999999999'" data-mask autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>   

                      
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" name="contactoNuevaConstructora" autocomplete="off" placeholder="Contacto Cobranza">
                  </div>
               </div>    

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" data-inputmask="'mask':'999999999'" data-mask name="cobraTeleNuevaConstructora" autocomplete="off" placeholder="Teléfono Cobranza">
                  </div>
               </div>    

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" name="cobraMailNuevaConstructora" autocomplete="off" placeholder="Correo Cobranza">
                  </div>
               </div>   

                <div class="form-group row">              
                  <div class="input-group">                      
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                      <select class="form-control input-lg" id="formaPagoNuevaConstructora" name="formaPagoNuevaConstructora" required>                          
                           <option value="">Seleccionar Forma Pago</option>
                          <?php                           

                            $formaPago = ControladorPerfiles::ctrMostrarFormaPago();

                            foreach ($formaPago as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                            }

                          ?>
                      </select>
                  </div>
                </div>

               <div id = "mostrarBanco">
                 <div class="form-group">              
                      <div class="input-group">                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                        <select class="form-control input-lg" id="bancoNuevaConstructora" name="bancoNuevaConstructora">                         
                          <option value="">Seleccionar Banco</option>
                          <?php
                            $bancos = ControladorPerfiles::ctrMostrarBancos();
                          foreach ($bancos as $key => $value) {                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }
                          ?>
                        </select>
                      </div>
                   </div>                
               </div>  

          

           </div>
  
          </div>

        

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Constructora</button>

        </div>

        <?php

          $crearCategoria = new ControladorConstructoras();
          $crearCategoria -> ctrCrearConstructora();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarConstructora" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Constructora</h4>

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
                     <input type="text" class="form-control input-lg" name="rutEditarConstructora" id="rutEditarConstructora" disabled>
                     <input type="hidden"  name="idConstructoras" id="idConstructoras">
                  </div>
             </div>
           

           

            <!-- ENTRADA PARA RAZON SOCIAL -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="nombreEditarConstructora" id="nombreEditarConstructora" autocomplete="off" placeholder="Razón Social" required>
                  </div>
               </div>  


              <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                     <input type="text" class="form-control input-lg" id="direccionEditarConstructora" name="direccionEditarConstructora" autocomplete="off" placeholder="Dirección">
                  </div>
               </div>      

                   
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" id="telefonoEditarConstructora" name="telefonoEditarConstructora" data-inputmask="'mask':'999999999'" data-mask autocomplete="off" placeholder="Teléfono">
                  </div>
               </div>   

                      
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                     <input type="text" class="form-control input-lg" id="contactoEditarConstructora" name="contactoEditarConstructora" autocomplete="off" placeholder="Contacto Cobranza">
                  </div>
               </div>    

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                     <input type="text" class="form-control input-lg" id="cobraTeleEditarConstructora" name="cobraTeleEditarConstructora" autocomplete="off" data-inputmask="'mask':'999999999'" data-mask placeholder="Teléfono Cobranza">
                  </div>
               </div>    

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                     <input type="email" class="form-control input-lg" id="cobraMailEditarConstructora" name="cobraMailEditarConstructora" autocomplete="off" placeholder="Correo Cobranza">
                  </div>
               </div>   

                <div class="form-group row">              
                  <div class="input-group">                      
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                      <select class="form-control input-lg" id="formaPagoEditarConstructora" name="formaPagoEditarConstructora" required>                        
                          
                          <?php                           

                            $formaPago = ControladorPerfiles::ctrMostrarFormaPago();

                            foreach ($formaPago as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                            }

                          ?>
                      </select>
                  </div>
                </div>

               <div id = "mostrarBancoEditar">
                <div class="form-group">              
                      <div class="input-group">                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                        <select class="form-control input-lg" id="bancoEditarConstructora" name="bancoEditarConstructora">                      
                          <option value="">Seleccionar Banco</option>
                          <?php
                            $bancos = ControladorPerfiles::ctrMostrarBancos();
                          foreach ($bancos as $key => $value) {                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }
                          ?>
                        </select>
                      </div>
                   </div>       
               </div>            
           
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Constructora</button>

        </div>

        <?php

          $crearCategoria = new ControladorConstructoras();
          $crearCategoria -> ctrEditarConstructora();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCategoria = new ControladorConstructoras();
  $borrarCategoria -> ctrBorrarConstructora();

?>


