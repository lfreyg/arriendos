<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idGuiaDespachoTraslado"] = '';

if(empty($_SESSION['idPedidoInternoValidar'])){
  $_SESSION['idPedidoInternoValidar'] = $_GET["idPedido"];
  $idPedido = $_GET["idPedido"];
}else{
  $idPedido = $_SESSION['idPedidoInternoValidar'];
}

if($_SESSION['idPedidoInternoValidar'] == ''){

  echo '<script>

    window.location = "pedido-interno-validar";

  </script>';

  return;

}
$hoy = date('Y-m-d');
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
      <li><a href="pedido-interno-validar">Validar Pedido</a></li>
      
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
                       <div id="mostrar_tabla_guias_generadas_valida" align="left"></div>
                      </div>
               </div>            

              </div>

          </div>

           <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolverPedidoValidar">Volver a Lista Pedidos</button> 
             </div>              
          </div>
        </div>
            
      </div>

  

    </div>
   
  </section>

</div>




<script src="vistas/js/pedidoInternoDespachoDetalleVista.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){
    
     genera_tabla_guia_traslado_validar()
     vistaTablaPedido();

   });     

  


     

</script>