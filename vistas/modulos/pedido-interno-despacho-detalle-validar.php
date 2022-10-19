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

if(empty($_SESSION["idPedidoInternoValidar"])){
  $_SESSION["idPedidoInternoValidar"] = $_GET["idPedido"];
  $idPedido = $_GET["idPedido"];
}else{
  $idPedido = $_SESSION["idPedidoInternoValidar"];
}

if($_SESSION["idPedidoInternoValidar"] == ''){

  echo '<script>

    window.location = "pedido-interno-despacho-detalle-vista-validar";

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
      <li><a href="pedido-interno-validar">Validar Pedido</a></li>
      <li><a href="pedido-interno-despacho-detalle-vista-validar">Vista Pedido</a></li>      
      <li class="active">Guias Validar Pedido</li>
    
    </ol>

  </section>

  <section class="content">

    
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
                      <input type="hidden" id="idSucursalOrigen" name="idSucursalOrigen" value="<?php echo $guiaDespacho["sucursal_origen"]?>">

                  </div>

                </div> 
               
               
                
               <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_detalles_validar" align="left"></div>
                      </div>
               </div>            

              </div>

          </div>

           <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolverValidar">Volver Detalle Pedido</button> 
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
    
     genera_tabla_pedidos_validar();

   });     

  


     

</script>