<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$hoy = date('Y-m-d');

$fechaMas = date("Y-m-d",strtotime($hoy."+ 3 days")); 

$fechaMenos = date("Y-m-d",strtotime($hoy."- 3 days")); 

$_SESSION['idGuiaDespachoTaller'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Guia de Despacho Taller Externo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Guía despacho taller</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevaGuia" data-toggle="modal" data-target="#modalAgregarGuia">
          
          Nueva Guía Despacho

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaGuiaDespacho" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>                      
           <th>Empresa</th>
           <th>N° Guía</th> 
           <th>Fecha Guía</th>          
           <th>Taller</th> 
           <th>Chofer</th>
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

<div id="modalAgregarGuia" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Nueva Guía Despacho</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

            <div class="row">          
             <div class="col-lg-6 col-xs-11">
                <label for="nuevaEmpresaOperativa">Empresa Operativa</label>
                <select class="form-control input-lg" id="nuevaEmpresaOperativa" name="nuevaEmpresaOperativa" required> 

               

                  <?php

                  $item = null;
                  $valor = null;
                  $tabla = "empresas_operativas";

                  $empresas = ModeloEmpresasOperativas::mdlMostrarEmpresas($tabla,$item, $valor);

                  foreach ($empresas as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["razon_social"].'</option>';
                  }

                  ?>
  
                </select>               

              </div>

            </div>

           <br>

            <!-- COMBO CLIENTE -->

           <div class="row">          
             <div class="col-lg-6 col-xs-11"> 
             <label for="nuevaGuiaConstructora">Taller Externo</label> 
                <select class="select2 input-lg" id="nuevaGuiaConstructora" style="width: 100%;" name="nuevaGuiaConstructora" required>
                  
                  <option value="">Seleccionar Taller Externo</option>

                  <?php

                  $cliente = ModeloTalleres::mdlMostrarTalleresActivos();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>

               

            </div>  

            <br>             

            <!-- ENTRADA FECHA -->

           <div class="row">          
             <div class="col-lg-4 col-xs-11"> 
              
                <label for="nuevoFechaGuia">Fecha Guía</label> 
                <input type="date" class="form-control input-lg" name="nuevoFechaGuia" value="<?php echo $hoy?>" id="nuevoFechaGuia"  min="<?=$fechaMenos?>" max="<?=$fechaMas?>"  placeholder="Fecha" required>
                <input type="hidden" name="tipoGuia" value="TA">

              </div>
           
            </div>  
            
            <br>

            <!-- ENTRADA PARA TRANSPORTISTA -->

             <div class="row">          
             <div class="col-lg-6 col-xs-11">
                <label for="nuevaTransporte">Transportista</label>
                <select class="form-control input-lg" id="nuevaTransporte" name="nuevaTransporte" required>                 
               <option value="">Seleccionar Transportista</option>

                  <?php

                  $item = null;
                 

                  $transporte = ModeloTransporteGuia::mdlMostrarTrasporteGuia($item);

                  foreach ($transporte as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["rut"]." --- ".$value["nombre"].'</option>';
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

          <button type="submit" class="btn btn-primary">Continuar</button>

        </div>

        <?php

          $crearGuia = new ControladorGuiaDespachoTaller();
          $crearGuia -> ctrCrearGuiaDespacho();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarGuiaDespacho" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Guía Despacho</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- COMBO CLIENTE -->

          <div class="row">          
             <div class="col-lg-6 col-xs-11">  
              
               <label for="editaEmpresaOperativa">Empresa Operativa</label>

                <select class="form-control input-lg" id="editaEmpresaOperativa" name="editaEmpresaOperativa" disabled>                 
               

                  <?php

                  $item = null;
                  $valor = null;
                  $tabla = "empresas_operativas";

                  $empresas = ModeloEmpresasOperativas::mdlMostrarEmpresas($tabla,$item, $valor);

                  foreach ($empresas as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["razon_social"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

           



                     
             <div class="col-lg-6 col-xs-11"> 
              
                <label for="editaNumGuia">Folio GD Emitido</label> 

                <input type="text" class="form-control input-lg" name="editaNumGuia" id="editaNumGuia" autocomplete="off" disabled>
                <input type="hidden" id="idGuiaEdita" name="idGuiaEdita">
                <input type="hidden" id="docAnteriorGuia" name="docAnteriorGuia">

              </div>
           </div>   

             <br>

            <div class="row">          
             <div class="col-lg-6 col-xs-11">  
              
                <label for="editaGuiaConstructora">Taller Externo</label>  

                <select class="form-control input-lg" id="editaGuiaConstructora" style="width: 100%;" name="editaGuiaConstructora" required>                 
              
                  <?php

                  $cliente = ModeloTalleres::mdlMostrarTalleresActivos();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>

           

                       

            </div>

            <br>

           <!-- ENTRADA FECHA -->

             <div class="row">          
             <div class="col-lg-4 col-xs-11"> 
              
                <label for="editaFechaGuia">Fecha Guía</label> 

                <input type="date" class="form-control input-lg" name="editaFechaGuia" id="editaFechaGuia" autocomplete="off" readonly placeholder="Fecha" required>

              </div>

                     
            </div>  

            <br> 

            <div class="row">          
             <div class="col-lg-6 col-xs-11">
                <label for="editaTransporte">Transportista</label>
                <select class="form-control input-lg" id="editaTransporte" name="editaTransporte" required>                               
                  <?php

                  $item = null;                  

                  $transporte = ModeloTransporteGuia::mdlMostrarTrasporteGuia($item);

                  foreach ($transporte as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["rut"]." --- ".$value["nombre"].'</option>';
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

          $editarPedido = new ControladorGuiaDespachoTaller();
          $editarPedido -> ctrEditarGuiaDespachoTaller();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $eliminarGuia = new ControladorGuiaDespachoTaller();
  $eliminarGuia -> ctrEliminarGuiaDEspachoTaller();

?>      



<script src="vistas/js/guiaDespachoTaller.js?v=<?php echo(rand());?>"></script>