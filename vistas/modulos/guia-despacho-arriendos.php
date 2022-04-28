<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$hoy = date('Y-m-d');

$_SESSION['idGuiaDespachoArriendo'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Guia de Despacho para arriendos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Guía despacho arriendos</li>
    
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
           <th>Cliente</th>
           <th>Destino</th>  
           <th>OC</th>         
           <th>Guía Firmada</th>
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
  
  <div class="modal-dialog">

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

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

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

            <!-- COMBO CLIENTE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="nuevaGuiaConstructora" style="width: 100%;" name="nuevaGuiaConstructora" required>
                  
                  <option value="">Seleccionar Constructora</option>

                  <?php

                  $cliente = ControladorConstructoras::ctrMostrarConstructorasActivas();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>

            </div>
          

          <!-- COMBO OBRA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span>                
                   <div id="nueva_obras_combo"></div>               
              </div>

            </div>      

            <!-- ENTRADA FECHA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaGuia" value="<?php echo $hoy?>" id="nuevoFechaGuia" autocomplete="off" placeholder="Fecha" required>
                <input type="hidden" name="tipoGuia" value="A">

              </div>

            </div>             


            <!-- ENTRADA ORDEN COMPRA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoGuiaOC" id="nuevoGuiaOC" autocomplete="off" placeholder="Orden Compra">

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

          $crearGuia = new ControladorGuiaDespacho();
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
  
  <div class="modal-dialog">

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

             <div class="form-group">
              
              <div class="input-group">   
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

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

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editaNumGuia" id="editaNumGuia" autocomplete="off" disabled>
                <input type="hidden" id="idGuiaEdita" name="idGuiaEdita">
                <input type="hidden" id="docAnteriorGuia" name="docAnteriorGuia">

              </div>

            </div>  

            <div class="form-group">
              
              <div class="input-group">  
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editaGuiaConstructora" style="width: 100%;" name="editaGuiaConstructora" required>                 
              
                  <?php

                  $cliente = ControladorConstructoras::ctrMostrarConstructorasActivas();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }    

                  ?>
  
                </select>

              </div>

            </div>

             <!-- COMBO OBRA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span>                
                   <div id="edita_obras_combo"></div>               
              </div>

            </div>

           <!-- ENTRADA FECHA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editaFechaGuia" value="<?php echo $hoy?>" id="editaFechaGuia" autocomplete="off" placeholder="Fecha" required>

              </div>

            </div>             


            <!-- ENTRADA ORDEN COMPRA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editaGuiaOC" id="editaGuiaOC" autocomplete="off" placeholder="Orden Compra">

              </div>

            </div>    

           


            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR GUIA FIRMADA</div>

              <input type="file" name="editaGuiaDoc" id="editaGuiaDoc">
              <p class="help-block">Peso máximo archivo 2MB</p>

             
           

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

          $editarPedido = new ControladorGuiaDespacho();
          $editarPedido -> ctrEditarGuiaDespacho();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $eliminarGuia = new ControladorGuiaDespacho();
  $eliminarGuia -> ctrEliminarGuiaDEspacho();

?>      



<script src="vistas/js/guiaDespacho.js?v=<?php echo(rand());?>"></script>