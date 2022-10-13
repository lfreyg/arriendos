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
      
      Mantenedor de Equipos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>          
      <li class="active">Mantenedor de Equipos</li>
    
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
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <select class="form-control input-lg select2" id="seleccionaTipoEquipo" name="seleccionaTipoEquipo"> 
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
                </div>
            </div>
                   

        <div class="box-body"> 
           <div class="col-lg-10 col-xs-4">       
            <table class="table table-bordered table-striped table-hover dt-responsive tablaEquiposMantenedor" width="100%">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                  
                  <th style="width: 10%;">Código</th>     
                  <th style="width: 10%;">Serie</th>             
                  <th style="width: 40%;">Descripcion</th>
                  <th style="width: 10%;">Precio Compra</th>
                  <th style="width: 15%;">Sucursal Actual</th>
                  <th style="width: 5%;">Editar</th>
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

<div id="modalEditarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div class="row">             

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="ecodigoEquipo">Código</label> 
                    <input type="text" class="form-control" id="eCodigoEquipo" value="">
                     <input type="hidden" id="idEquipo" name="idEquipo"> 
                     <input type="hidden" id="idTipoEquipo" name="idTipoEquipo">
                    <input type="hidden" id="idUsuarioMan" name="idUsuarioMan" value='<?php echo $_SESSION["id"]?>'>

              </div>

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="ecodigoEquipo">Serie</label> 
                    <input type="text" class="form-control" id="eSerieEquipo" value="">                                       
              </div>
             </div> 

            <div class="row"> 
              <div class="col-lg-11 col-xs-11">                                   
                     <label for="edescripcionEquipo">Descripción</label> 
                    <input type="text" class="form-control" id="edescripcionEquipo" value="" readonly>                  
              </div>                            

           </div> 

           <br>

            <!--=====================================
            PRECIO Y DETALLE EQUIPOS GUIA DESPACHO
            ======================================--> 

            <div class="row">   


              <div class="col-lg-3 col-xs-11">                                   
                     <label for="ePrecioEquipo">Precio Compra</label> 
                    <input type="number" class="form-control" autocomplete="off" id="ePrecioEquipo" name="ePrecioEquipo" value="">                  
              </div>           

              <div class="col-xs-4" style="padding-right:0px">
                        <div class="form-group">              
                           <div class="form-group">               
                                <label>Sucursal</label>  
                                    <select class="form-control" id="sucursalCompra" name="sucursalCompra" required>
                                    
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

<div id="modalHistorico" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Historia Modificaciones</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

              <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_equipos_inicio" align="left"></div>
                      </div>
               </div> 

               <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_equipos_historia" align="left"></div>
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



<script src="vistas/js/mantenedorEquipos.js?v=<?php echo(rand());?>"></script>

