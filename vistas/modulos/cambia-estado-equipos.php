<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$idUsuario = $_SESSION["id"];

$hoy = date('Y-m-d');


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cambia Estado de Equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>          
      <li class="active">Cambia Estado de Equipos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
   

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->
      
             <div class="box-body">
               <div class="col-lg-6 col-xs-4">    
                     <div class="form-group">
                      
                      <div class="input-group">
                      <input type="hidden" id="idSucursalActual" name="idSucursalActual" value='<?= $_SESSION['idSucursalParaUsuario']?>'>
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <select class="form-control input-lg select2" id="seleccionaTipoEquipoCambio" name="seleccionaTipoEquipoCambio"> 
                         <option value="0">Seleccionar Tipo de Equipo</option>  
                         <option value="">TODOS LOS TIPOS DE EQUIPOS</option>            
                          
                          <?php                 

                          $marca = ControladorTipoEquipos::ctrMostrarTipoEquipoConMarca();

                          foreach ($marca as $key => $value) {
                                      
                                      echo '<option value="'.$value["id"].'">'.$value["descripcion"]." ".$value["modelo"]." ".$value["marca"].'</option>';
                                    }
                                          

                          ?>

                        </select>

                      </div>

                    </div>
                    <br>

                      <label for="codigotxt">Buscar por Código</label>
                      <div class="form-inline">
                        <div class="form-group mb-2">     
                        <div class="form-group mx-sm-3 mb-2">
                        
                          <input type="text" class="form-control" id="codigotxt" placeholder="Código">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" id="btnBuscarCodigo">Buscar por Código</button>
                      </div>
                      <br>
                      <br>


                </div>
            </div>
                   

        <div class="box-body"> 
           <div class="col-lg-12 col-xs-12">       
            <table class="table table-bordered table-striped table-hover dt-responsive tablaEquiposMantenedor" width="100%">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                  
                  <th style="width: 10%;">Código</th>     
                  <th style="width: 10%;">Serie</th>             
                  <th style="width: 40%;">Descripcion</th>
                  <th style="width: 30%;">Estado Actual</th>                 
                  <th style="width: 5%;">Cambio</th>
                  <th style="width: 5%;">Historia</th>
                </tr>

              </thead>

            </table>           
          </div>
      </div>

        


     

    </div>
   
  </section>

</div>







<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalCambioEstadoEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cambiar Estado Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div class="row">             

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="ecodigoEquipo">Código</label> 
                    <input type="text" class="form-control" id="eCodigoEquipo" readonly>
                     <input type="hidden" id="idEquipo" name="idEquipo"> 
                     <input type="hidden" id="idTipoEquipo" name="idTipoEquipo">
                    <input type="hidden" id="idUsuarioMan" name="idUsuarioMan" value='<?php echo $_SESSION["id"]?>'>
                    <input type="hidden" id="idEstadoActual" name="idEstadoActual">
                    <input type="hidden" id="idGuiaDetalleTxt" name="idGuiaDetalleTxt">


              </div>

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="ecodigoEquipo">Serie</label> 
                    <input type="text" class="form-control" id="eSerieEquipo" readonly>                                       
              </div>
             </div> 

            <div class="row"> 
              <div class="col-lg-11 col-xs-11">                                   
                     <label for="edescripcionEquipo">Descripción</label> 
                    <input type="text" class="form-control" id="edescripcionEquipo" readonly>                  
              </div>                            

           </div> 

           <br>

            <!--=====================================
            PRECIO Y DETALLE EQUIPOS GUIA DESPACHO
            ======================================--> 

            <div class="row">   


              <div class="col-lg-5 col-xs-11">                                   
                     <label for="estado">Estado Actual</label> 
                    <input type="text" class="form-control" autocomplete="off" id="estado" name="estado" readonly>                  
              </div>           

              <div class="col-xs-5" style="padding-right:0px">
                        <div class="form-group">              
                           <div class="form-group">               
                                <label>Nuevo Estado</label>  
                                    <select class="form-control" id="nuevoEstado" name="nuevoEstado" required>

                                      <option value="">Seleccione nuevo estado</option>
                                    
                                    <?php
                                  
                                    $estados = ModeloEstados::mdlEstadosSeleccionados($idUsuario);

                                    foreach ($estados as $key => $value) {
                                      
                                      echo '<option value="'.$value["id_estado"].'">'.$value["descripcion"].'</option>';
                                    }

                                    ?>
  
                                        </select>
                              </div>
                          </div> 
                        </div>
              
                            

           </div>      


            <div class="row">  
              <div class="col-lg-5 col-xs-11">                                   
                     <label for="motivo">Motivo</label> 
                   <textarea id="motivo" class="form-control" rows="3" cols="50" maxlength="150"></textarea>                  
              </div>    
           </div>     


            <div id="divArrendado" class="row"> 
              <h4>El estado Actual del equipo es ARRENDADO, por ende, debe indicar la fecha que dara termino al arriendo</h4>
              <div class="col-lg-5 col-xs-11">                                   
                     <label for="estado">Fecha Termino</label> 
                    <input type="date" class="form-control" value="" id="fecha" name="fecha">                  
              </div>   
           </div>                  
           

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarEdita" class="btn btn-primary">Guardar Cambios</button>

        </div>


     

    </div>

  </div>

</div>

<!--
  ==========================
   MODAL HISTORIAL
  ========================-->

<div id="modalHistoricoCambio" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Historia de Cambios Estados</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

              <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_historica" align="left"></div>
                      </div>
               </div> 

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
         
        </div>


     

    </div>

  </div>

</div>



<script src="vistas/js/cambioEstados.js?v=<?php echo(rand());?>"></script>

