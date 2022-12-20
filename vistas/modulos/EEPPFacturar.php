
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}


if(empty($_SESSION["idObraFacturar"])){
  $_SESSION["idObraFacturar"] = $_GET["idObra"];
  $idObra = $_GET["idObra"];
}else{
  $idObra = $_SESSION["idObraFacturar"];
}

if(empty($_SESSION["idFacturaArriendo"])){
  $_SESSION["idFacturaArriendo"] = $_GET["idFactura"];
  $idFacturaEEPP = $_GET["idFactura"];
}else{
  $idFacturaEEPP = $_SESSION["idFacturaArriendo"];
}

 

$facturacion = ModeloFacturacionEEPP::obtenerDatosFactura($idFacturaEEPP);
$estadoFactura = $facturacion["estado_factura"];




$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$tipoCobro = $obra["tipoCobro"];
$idConstructora = $obra["id_constructoras"];





?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       EEPP para facturar en obra<?php echo ' '.$nombreObra?>   
    </h1>
    <br>
         

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="factura-eepp-constructora">Facturar EEPP</a></li>

      <li class="obrasFacturacionEEPP">Obras</li>
      
      <li class="active">Facturar EEPP</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row"> 
     
            <div class="form-row align-items-center">
              <div class="box-header with-border">
                 <div class="col-auto">
                   <button class="btn btn-success" id="btnEEPPFacturarVolver" >Volver</button>
                 </div>
              </div>
             </div> 

          <div class="col-lg-8 col-xs-11"> 
             <div class="box box-warning"> 
               <div class="box-header with-border"></div>
                 <div class="box-body">  
                       <input type="hidden" id="idObra" name="idObra" value="<?php echo $idObra?>">                      
                       <input type="hidden" id="idConstructora" name="idConstructora" value="<?php echo $idConstructora?>">   
                        <input type="hidden" id="idFacturaEEPP" name="idFacturaEEPP" value="<?php echo $idFacturaEEPP?>"> 
                        <input type="hidden" id="estadoFacturaPrevia" name="estadoFacturaPrevia" value="<?php echo $estadoFactura?>">                                  
                         

                            <div id="eepp_para_facturar" align="left"></div>
                                  
              </div>
            </div>
          </div> 

          <div class="col-lg-4 col-xs-11"> 
             <div class="box box-warning"> 
               <div class="box-header with-border"></div>
                 <div class="box-body">                
                         
                            <div id="eepp_seleccionados" align="left"></div>
                                  
              </div>
            </div>

             <div class="pull-right-container">
             <button class="btn btn-lg btn-danger btn-block text-uppercase" id="btnContinuarFactura">CONTINUAR FACTURACIÓN</button> 
             </div> 
            

    </div>
               

    </div>

  </section>

</div>


<script src="vistas/js/facturacionEEPP.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript"> 
  
  
  $(document).ready(function(){

    idObra = $('#idObra').val(); 
   
    genera_tabla_eepp_facturar();
    genera_tabla_EEPP_Seleccionado();
   

   });     

  
</script>