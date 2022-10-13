<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idGuiaDespachoTraslado"])){
  $_SESSION["idGuiaDespachoTraslado"] = $_GET["idGuia"];
  $idGuia = $_GET["idGuia"];
}else{
  $idGuia = $_SESSION["idGuiaDespachoTraslado"];
}

if(empty($_SESSION["idPedidoInternoDespacho"])){
  $_SESSION["idPedidoInternoDespacho"] = $_GET["idPedido"];
  $idPedido = $_GET["idPedido"];
}else{
  $idPedido = $_SESSION["idPedidoInternoDespacho"];
}

if($_SESSION["idPedidoInternoDespacho"] == ''){

  echo '<script>

    window.location = "pedido-interno-despacho-detalle-vista";

  </script>';

  return;

}

$guiaDespacho = ModeloGuiaDespacho::mdlMostrarGuiaDespachoDetalleTraslado($idGuia);

if($guiaDespacho){
  $traeGuia = "con Guía Despacho ".$guiaDespacho["guia"];
}else{
  $traeGuia = 'Sin Guia Firmada por SII';
}

$pedido = ModeloPedidoInterno::mdlMostrarPedidoInternoDetalle($idPedido);

   
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
    Pedido N° <?php echo $idPedido." ".$traeGuia?> 
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="pedido-interno-despacho">Despacho Pedido</a></li>
      <li><a href="pedido-interno-despacho-vista">Vista Pedido</a></li>      
      <li class="active">Despacho Pedido</li>
    
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
                  <th>Seleccionar</th>  
                  <th>Categoria</th>  
                  <th>Disponible Origen</th> 
                  <th>Solicitado</th> 
                  <th>Por Despachar</th>                              
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

       <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-5 col-xs-11">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped table-hover dt-responsive tablaEquiposGuia">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                  
                  <th>Código</th>                  
                  <th>Descripcion</th>
                  <th>Selección</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>
    </div>


      <!--=====================================
      EL FORMULARIO
      ======================================-->
    <div class="row">   
      <div class="col-lg-6 col-xs-11">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">
  
              <div class="box">

                           
                <div class="form-group">
                
                  <div class="input-group">
                    <input type="hidden" id="idPedidoGenerado" name="idPedidoGenerado" value="<?php echo $idPedido; ?>">
                    <input type="hidden" id="idSucursaltxt" name="idSucursaltxt" value="<?php echo $pedido["sucursal"]; ?>">
                    <input type="hidden" id="estadoPedido" name="estadoPedido" value="<?php echo $pedido["final"]; ?>">
                    <input type="hidden" id="idGuiaGenerado" name="idGuiaGenerado" value="<?php echo $idGuia?>">
                    <input type="hidden" id="estadoGuia" name="estadoGuia" value="<?php echo $guiaDespacho["estadoGuia"]?>"> 
                    <input type="hidden" id="idEmpresaOperativa" name="idEmpresaOperativa" value="<?php echo $guiaDespacho["idEmpresa"]?>"> 
                    <input type="hidden" id="numeroGuia" name="numeroGuia" value="<?php echo $guiaDespacho["guia"]?>"> 
                    <input type="hidden" id="idCategoriaTxt" name="idCategoriaTxt" value="">
                     <input type="hidden" id="idPedidoDetalle" name="idPedidoDetalle" value="">

                  </div>

                </div> 
               
               
                
               <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_detalles" align="left"></div>
                      </div>
               </div>            

              </div>

          </div>

           <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolver">Volver Detalle Pedido</button> 
             </div> 
             <br>   
              <div class="pull-right-container">       
             <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnFinalizarGuia">FIRMAR GUIA EN SII</button>  
            </div>
          </div>
        </div>
            
      </div>

  

    </div>
   
  </section>

</div>


<script src="vistas/js/pedidoInternoDespachoDetalle.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

    if($('#estadoGuia').val() == 13){
        $('#btnFinalizarGuia').attr('disabled', true)


     }
    
     genera_tabla_pedidos();

   });     

  


     

</script>