<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$hoy = date('Y-m-d');

$_SESSION['idReportDevolucion'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Retiro de equipos en arriendo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Retiro de equipos en arriendo</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoReport" data-toggle="modal" data-target="#modalAgregarRetiro">
          
          Nuevo Report

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaReportDevolucion" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           <th>N° Report</th> 
           <th>Fecha Report</th>          
           <th>Cliente</th>
           <th>Obra</th> 
           <th>Adjunto</th>
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

<div id="modalAgregarRetiro" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Nuevo Report Retiro</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">           

           

            <!-- COMBO CLIENTE -->

           <div class="row" id="idDivConstructora">          
             <div class="col-lg-8 col-xs-11"> 
             <label for="nuevaConstructoraReport">Cliente</label> 
                <select class="select2" id="nuevaConstructoraReport" style="width: 100%;" name="nuevaConstructoraReport" required>
                  
                  <option value="">Seleccionar Constructora</option>

                  <?php

                  $cliente = ControladorConstructoras::ctrMostrarConstructoraSoloConArriendosActivos();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>
          </div>
          
          <br>
          <br>
          <!-- COMBO OBRA -->
          <div class="row">  
               <div class="col-lg-8 col-xs-11">  
                  <label>Obra</label>         
                   <div id="nueva_obras_combo"></div>               
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

          $crearGuia = new ControladorReportDevolucion();
          $crearGuia -> ctrCrearReportDevolucion();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarReport" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Report Retiro</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- COMBO CLIENTE -->

          <div class="row">       
                       
             <div class="col-lg-6 col-xs-11"> 
              
                <label for="editaIdReport">Folio Report Emitido</label> 
                <input type="text" class="form-control input-lg" name="editaIdReport" id="editaIdReport" autocomplete="off" readonly>
                <input type="hidden" id="idReport" name="idReport">
                <input type="hidden" id="docAnteriorReport" name="docAnteriorReport">

              </div>
           </div>   

             <br>

            <div class="row" id="mostrarConstructora">
             <div class="col-lg-8 col-xs-11"> 
             <label for="editaConstructoraReport">Cliente</label> 
                <select class="form-control input-lg" id="editaConstructoraReport" style="width: 100%;" name="editaConstructoraReport" required>
                                    
                  <?php

                  $cliente = ControladorConstructoras::ctrMostrarConstructoraSoloConArriendosActivos();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>
              </div>          
         </div>
           <br>

             <!-- COMBO OBRA -->
         <div class="row" id="mostrarObra"> 
            <div class="col-lg-6 col-xs-11">               
                <label>Destino</label>              
                   <div id="edita_obras_combo"></div>               
              </div>
          </div>

            <br>

            

            <div class="row">   
            <!-- ENTRADA PARA ADJUNTO -->

             <div class="col-lg-8 col-xs-11">              
               <label for="editaReportDoc">Adjuntar Report Firmado</label>
              <input type="file" name="editaReportDoc" id="editaReportDoc">
              <p class="help-block">Peso máximo archivo 2MB</p>

             
           

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

          $editarReport = new ControladorReportDevolucion();
          $editarReport -> ctrEditarReportDevolucion();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $eliminarGuia = new ControladorReportDevolucion();
  $eliminarGuia -> ctrEliminarReportDevolucion();

?>      



<script src="vistas/js/reportDevolucion.js?v=<?php echo(rand());?>"></script>