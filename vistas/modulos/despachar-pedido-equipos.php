<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idGuiaDespachoArriendo'] = '';
$hoy = date('Y-m-d');

$fechaMas = date("Y-m-d",strtotime($hoy."+ 3 days")); 

$fechaMenos = date("Y-m-d",strtotime($hoy."- 3 days")); 

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Despachar Pedido de equipos para obra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Despachar Pedido de equipos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnVerDetalleDespachoPedidos">
          
             Ver Detalle Pedidos de Obras Pendientes

        </button>

      </div>
      
      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaPedido" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>        
           <th>Constructora</th>
           <th>Obra</th>
           <th>Comuna</th>           
           <th>Pendientes</th>  
           <th>Generar Guía</th>
           
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

<div id="modalAgregarGuiaDespachar" class="modal fade" role="dialog">
  
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
                <input type="hidden" name="tipoGuia" value="A">
                <input type="hidden" name="nuevaGuiaConstructora" id="nuevaGuiaConstructora">
                <input type="hidden" name="comboObras" id="comboObras">
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

            <!-- ENTRADA FECHA -->

           <div class="row">          
             <div class="col-lg-4 col-xs-11"> 
              
                <label for="nuevoFechaGuia">Fecha Guía</label> 
                <input type="date" class="form-control input-lg" name="nuevoFechaGuia" value="<?php echo $hoy?>" id="nuevoFechaGuia" min="<?=$fechaMenos?>" max="<?=$fechaMas?>"  placeholder="Fecha" required>
                

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

          $crearGuia = new ControladorGuiaDespacho();
          $crearGuia -> ctrCrearGuiaDespachoPedidoObra();

        ?>

      </form>

    </div>

  </div>

</div>





<script src="vistas/js/despacharPedidoEquipos.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

         
     pedidos();

   });     

  


     

</script>