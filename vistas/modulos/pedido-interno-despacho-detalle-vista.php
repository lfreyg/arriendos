<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idGuiaDespachoTraslado"] = '';

if(empty($_SESSION["idPedidoInternoDespacho"])){
  $_SESSION["idPedidoInternoDespacho"] = $_GET["idPedido"];
  $idPedido = $_GET["idPedido"];
}else{
  $idPedido = $_SESSION["idPedidoInternoDespacho"];
}

if($_SESSION["idPedidoInternoDespacho"] == ''){

  echo '<script>

    window.location = "pedido-interno-despacho";

  </script>';

  return;

}
$hoy = date('Y-m-d');


$fechaMas = date("Y-m-d",strtotime($hoy."+ 3 days")); 

$fechaMenos = date("Y-m-d",strtotime($hoy."- 3 days")); 

$pedido = ModeloPedidoInterno::mdlMostrarPedidoInternoDetalle($idPedido);

$hacerNuevaGuia = ModeloPedidoInterno::mdlValidarHacerNuevaGuiaPedido($idPedido);

   
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Vista Pedido Interno N° <?php echo $idPedido?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="pedido-interno-despacho">Despacho Pedido</a></li>
      
      <li class="active">Vista Pedido Interno </li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-6 col-xs-11">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
                
            
            <table class="table table-bordered table-striped table-hover dt-responsive tablaVistaPedido">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                     
                  <th>Categoria</th>  
                  <th>Stock Destino</th> 
                  <th>Solicitado</th> 
                  <th>Por Despachar</th>                              
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-6 col-xs-11">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">
  
              <div class="box">

                           
                <div class="form-group">
                
                  <div class="input-group">
                  <div class="col-xs-6">  
                   <label for="solicitaPedido">Solicitado por</label> 
                    <input type="text" class="form-control" id="solicitaPedido" value="<?php echo $pedido["usuario"];?>" readonly>   
                  </div>
                   <div class="col-xs-6">
                    <label for="solicitaPedido">Sucursal Destino</label> 
                    <input type="text" class="form-control" id="sucursalPedido" value="<?php echo $pedido["nombreSucursal"];?>" readonly>
                     <input type="hidden" id="idPedido" name="idPedido" value="<?php echo $idPedido; ?>">
                   </div>                  

                    

                  </div>

                </div> 
               
                 <hr>          
              
                <label>Guías asociadas</label>
               <div class="form-group row">

                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_guias_generadas" align="left"></div>
                      </div>
               </div>            

              </div>

          </div>

           <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolverPedido">Volver a Lista Pedidos</button> 
             </div> 
             <br> 
           <?php
             if(!$hacerNuevaGuia){
           ?>    
              <div class="pull-right-container">       
             <button class="btn btn-lg btn-success btn-block text-uppercase" data-toggle="modal" data-target="#modalGenerarGúia" id="btnGenerarGuia">Generar Guía Despacho</button>  
            </div>
           <?php
             }
           ?> 
          </div>
        </div>
            
      </div>

  

    </div>
   
  </section>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalGenerarGúia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generar Guia traslado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
                <div class="row">          
             <div class="col-lg-8 col-xs-11">
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

            <div class="row">          
             <div class="col-lg-8 col-xs-11"> 
              
                <label for="nuevoFechaGuia">Fecha Guía</label> 
                <input type="date" class="form-control input-lg" name="nuevoFechaGuia" value="<?php echo $hoy?>" id="nuevoFechaGuia" min="<?=$fechaMenos?>" max="<?=$fechaMas?>" autocomplete="off" placeholder="Fecha" required>
                <input type="hidden" name="tipoGuia" value="T">
                <input type="hidden" id="idPedidoGenerado" name="idPedidoGenerado" value="<?php echo $idPedido; ?>">
                    <input type="hidden" id="idSucursaltxt" name="idSucursaltxt" value="<?php echo $pedido["sucursal"]; ?>">
                    <input type="hidden" id="estadoPedido" name="estadoPedido" value="<?php echo $pedido["final"]; ?>">

              </div>
            </div>
            <br>

             <!-- ENTRADA PARA TRANSPORTISTA -->

             <div class="row">          
             <div class="col-lg-8 col-xs-11">
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

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

         <button type="submit" class="btn btn-primary">Continuar</button>

        </div>

        <?php

          $crearGuia = new ControladorGuiaDespacho();
          $crearGuia -> ctrCrearGuiaDespachoTraslado();

        ?>

      </form>


     

    </div>

  </div>

</div>


<script src="vistas/js/pedidoInternoDespachoDetalleVista.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){
    
     genera_tabla_guia_traslado()
     vistaTablaPedido();

   });     

  


     

</script>