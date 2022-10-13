<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idPedidoInterno"])){
  $_SESSION["idPedidoInterno"] = $_GET["idPedido"];
  $idPedido = $_GET["idPedido"];
}else{
  $idPedido = $_SESSION["idPedidoInterno"];
}

if($_SESSION["idPedidoInterno"] == ''){

  echo '<script>

    window.location = "pedido-interno";

  </script>';

  return;

}

$pedido = ModeloPedidoInterno::mdlMostrarPedidoInternoDetalle($idPedido);

   
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Detalle Pedido Interno N° <?php echo $idPedido?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="pedido-interno">Pedido Interno</a></li>
      
      <li class="active">Detalle Pedido Interno </li>
    
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
                
            
            <table class="table table-bordered table-striped table-hover dt-responsive tablaCategoriasEquipos">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr> 
                  <th>Acciones</th>  
                  <th>Categoria</th>                                   
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
                    
                   <label for="solicitaPedido">Solicitado por</label> 
                    <input type="text" class="form-control" id="solicitaPedido" value="<?php echo $pedido["usuario"];?>" readonly>                    

                    <input type="hidden" id="idPedidoGenerado" name="idPedidoGenerado" value="<?php echo $idPedido; ?>">
                    <input type="hidden" id="idSucursaltxt" name="idSucursaltxt" value="<?php echo $pedido["sucursal"]; ?>">
                    <input type="hidden" id="estadoPedido" name="estadoPedido" value="<?php echo $pedido["final"]; ?>">

                  </div>

                </div> 
               
                 <hr>            
                <h2>Detalle Pedido</h2> 
                     <div class="row">
                         <div class="col-xs-8" style="padding-right:0px"> 
                                     <label for="solicitaPedido">Equipo</label> 
                                     <input type="text" class="form-control" id="DetalleDescripcion" value="" readonly> 
                                     <input type="hidden" id="idCategoria" name="idCategoria"> 
                            </div>
                      </div>
                      <br/>
            <div class="row">
                      <div class="col-xs-2" style="padding-right:0px"> 
                                      
                            <div class="input-group">                    
                               <label for="solicitaPedido">Tengo</label>  
                               <input type="text" class="form-control" id="tengo" value="" readonly>                 
                           </div>
                          
                      </div>

                      <div class="col-xs-2" style="padding-right:0px"> 
                                      
                            <div class="input-group">                    
                               <label for="solicitaPedido">Disponibles</label>  
                               <input type="text" class="form-control" id="stockDisponible" value="" readonly>                 
                           </div>
                          
                      </div>

                      <div class="col-xs-2" style="padding-right:0px"> 
                                      
                            <div class="input-group">                    
                               <label for="solicitaPedido">En revisión</label>  
                               <input type="text" class="form-control" id="enRevision" value="" readonly>                 
                           </div>
                          
                      </div>
             
                    <div class="col-xs-2" style="padding-right:0px"> 
                            <div class="input-group"> 
                               <label>Cantidad Solicitar</label>  
                               <input type="number" class="form-control" autocomplete="off" id="cantidad">                 
                           </div>
                    </div>
             </div>

              <br/>
                     <div class="row">
                         <div class="col-xs-8" style="padding-right:0px"> 
                                     <label for="solicitaPedido">Detalles</label> 
                                     <input type="text" class="form-control" id="detalles">
                            </div>
                      </div>
            

                  <div class="pull-right">

                        <button class="btn btn-primary" id="btnAgregarDetalle">Agregar Equipo</button>
            
                   </div>       
                
                <br/>
                <br/>
                <br/>
                
               <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_detalles" align="left"></div>
                      </div>
               </div>            

              </div>

          </div>

           <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolver">Volver a Lista Pedidos</button> 
             </div> 
             <br>   
              <div class="pull-right-container">       
             <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnFinalizarPedido">Finalizar Pedido</button>  
            </div>
          </div>
        </div>
            
      </div>

  

    </div>
   
  </section>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

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
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="solicitaPedido">Equipo</label> 
                             <input type="text" class="form-control" id="DetalleDescripcionEdita" value="" readonly> 
                             <input type="hidden" id="idCategoriaEdita" name="idCategoriaEdita"> 
                            </div>
                </div>
                      <br/>
                
                <div class="row">
                   <div class="col-xs-4" style="padding-right:0px"> 
                            <div class="input-group"> 
                               <label>Cantidad Solicitar</label>  
                               <input type="number" class="form-control" autocomplete="off" id="cantidadEdita" name="cantidadEdita">
                           </div>
                    </div>
                </div> 

                <br>
                 
                 
                   <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                                     <label for="solicitaPedido">Detalles</label> 
                                     <input type="text" class="form-control" id="detallesEdita" name="detallesEdita">
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


<script src="vistas/js/pedidoInternoDetalle.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){
    
     genera_tabla_pedidos();

   });     

  


     

</script>