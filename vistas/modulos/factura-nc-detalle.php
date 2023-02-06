<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION['idNC'])){
    $_SESSION['idNC'] = $_GET['idNC'];
    $idNC = $_GET['idNC'];
}else{
    $idNC = $_SESSION["idNC"];
}

  


if($_SESSION["idNC"] == ''){

  echo '<script>

    window.location = "factura-nota-credito-listado";

  </script>';

  return;

}



$hoy = date('Y-m-d');

$notaCredito = ModeloFacturacionNCND::mdlMostrarNC($idNC);

if($notaCredito["numero_nc"] == 0){
    $numNotaCredito = 'EN PROCESO';
}else{
    $numNotaCredito = $notaCredito["numero_nc"];
}

$tipoNC = $notaCredito["tipoNC"];
$numFactura = $notaCredito['numero_factura'];
$netoFactura = $notaCredito['neto_factura'];
$idTipoNC = $notaCredito["tipo_nota"];
$idFactura = $notaCredito["idFactura"];
$estadoNC = $notaCredito["idEstadoNota"];
$idEmpresa = $notaCredito["idEmpresaOperativa"];


$NC = ModeloFacturacionNCND::mdlTotalNCPorFactura($idFactura);
$netoNC = $NC['neto'];

$netoOriginal = $netoFactura - $netoNC;





$read = '';
$descripcion = '';
$readTexto = 'readonly';
if($idTipoNC == 1){
    $descripcionDetalle = 'NOTA DE CRÉDITO ANULA FACTURA '.$numFactura;
    $read = 'readonly';
}

if($idTipoNC == 2){
    $descripcionDetalle = 'NOTA DE CRÉDITO CORRIGE MONTOS DE FACTURA '.$numFactura;
    $netoFactura = 0;
    $read = 'readonly';
}

if($idTipoNC == 3){
    $descripcionDetalle = 'NOTA DE CRÉDITO CORRIGE TEXTOS DE FACTURA '.$numFactura;
    $netoFactura = 0;
    $read = 'readonly';
    $readTexto = '';
}



?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Detalle Nota de Crédito <?php echo $numNotaCredito?>
    
    </h1>
    <h4>
      
      <?php echo $tipoNC?>
    
    </h4>

    
  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-8 col-xs-11">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">  
              <div class="box">

      <!--=====================================
      ENCABEZADO GUIA DESPACHO
      ======================================-->       

          <div class="row"> 
               <div class="col-lg-5 col-xs-11">  
                     <label for="empresaOperativa">Empresa</label> 
                    <input type="text" class="form-control" id="empresaOperativa" value="<?=$notaCredito['empresa']?>" readonly> 
                    <input type="hidden" id="idFacturaNC" name="idFacturaNC" value="<?=$idFactura?>">
                    <input type="hidden" id="estadoNC" name="estadoNC" value="<?=$estadoNC?>"> 
                    <input type="hidden" id="idEmpresaOperativa" name="idEmpresaOperativa" value="<?=$idEmpresa?>"> 
                    <input type="hidden" id="idNC" name="idNC" value="<?=$idNC?>"> 
                    <input type="hidden" id="idTipoNC" name="idTipoNC" value="<?=$idTipoNC?>">     
                    <input type="hidden" id="netoOriginal" name="netoOriginal" value="<?=$netoOriginal?>">            
                
              </div>

               <div class="col-lg-3 col-xs-11">                                   
                     <label for="fechaNC">Fecha NC</label> 
                    <input type="date" class="form-control" id="fechaNC" value="<?=$notaCredito["fecha_nota"]?>" readonly>                  
              </div>
              
          </div> 
          <br>   
                           
           <div class="row"> 
            
            <div class="col-lg-2 col-xs-11">                                    
                    <label for="rutConstructoraGuia">Rut Cliente</label>
                    <input type="text" class="form-control" id="rutConstructoraNC" value="<?php echo str_replace(".","",$notaCredito["rutConstructora"])?>" readonly> 
                    <input type="hidden" id="idConstructora" name="idConstructora" value="">
                                   
            </div> 


            <div class="col-lg-5 col-xs-11">                                    
                    <label for="constructoraGuia">Cliente</label>
                    <input type="text" class="form-control" id="constructoraNC" value="<?php echo $notaCredito["constructora"]?>" <?=$readTexto?>>   
                                   
            </div>    

                
            <div class="col-lg-5 col-xs-11">
                                   
                     <label for="obraPedido">Destino</label> 
                    <input type="text" class="form-control" id="obraPedido" value="<?php echo $notaCredito["obra"]?>" readonly> 
                    <input type="hidden" id="idObra" name="idObra" value="">                
            </div>  
          </div>  
          <br>  

          <div class="row">             

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="telefonoNC">Teléfono</label> 
                    <input type="text" class="form-control" id="telefonoNC" value="<?php echo $notaCredito["telefono"]?>" <?=$readTexto?>>                  
              </div>
               

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="contactoNC">Contacto</label> 
                    <input type="text" class="form-control" id="contactoNC" value="<?php echo $notaCredito["contacto_cobranza"]?>" <?=$readTexto?>>                  
              </div>
             </div>

           <div class="row">             

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="transporteGuia">Dirección</label> 
                    <input type="text" class="form-control" id="direccionNC" value="<?php echo $notaCredito["direccion"]?>" <?=$readTexto?>>                  
              </div>
               

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="patenteGuia">Comuna</label> 
                    <input type="text" class="form-control" id="comunaNC" value="<?php echo $notaCredito["comuna"]?>" <?=$readTexto?>>                  
              </div>
             </div>
             
              <div class="row">  

                  <div class="col-lg-6 col-xs-11">                                   
                         <label for="rutChoferGuia">Ciudad</label> 
                        <input type="text" class="form-control" id="ciudadNC" value="<?php echo $notaCredito["ciudad"]?>" <?=$readTexto?>>                  
                  </div>
               

                  <div class="col-lg-6 col-xs-11">                                   
                         <label for="choferGuia">Actividad</label> 
                         <select class="form-control input-xs" id="cmbActividadNC" name="cmbActividadNC" >  
                          <?php
                             $actividad = ModeloConstructoras::mdlMostrarActividadesSII();
                          foreach ($actividad as $key => $value) {    
                               if($value["codigo"] == $notaCredito["codigo_actividad"]){                        
                                echo '<option value="'.$value["codigo"].'" selected>'.$value["actividad"].'</option>';
                            }else{
                                echo '<option value="'.$value["codigo"].'">'.$value["actividad"].'</option>';
                            }
                          }
                          ?>
                        </select>
                                         
                  </div>


             </div> 
            
         

          <div class="row">             
             

           </div> 

           <br>

         
            <div class="row">             

              <div class="col-lg-8 col-xs-11">                                   
                     <label for="detalleEquipo">Descripción NC</label> 
                    <input type="text" class="form-control" id="detalleNC" value="<?=$descripcionDetalle?>">                  
              </div>
                       

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="detalleEquipo">Total Neto NC</label> 
                    <input type="number" class="form-control" <?=$read?> id="netoNC" value="<?=$netoFactura?>">     

              </div>
                            

           </div>          
           <br>
            <div class="row">       

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="detalleEquipo">Saldo Neto Factura</label> 
                    <input type="text" class="form-control" readonly id="saldoNetoFac" value="<?='$ '.number_format($netoOriginal,0,'','.')?>">     

              </div>
                            

           </div>         
                  

              </div>

          </div>

          <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolverNC">Volver a Lista</button> 
             </div> 
             <br>   
              <div class="pull-right-container">       
             <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnTimbrarNC">TIMBRAR NC</button>  
            </div>
          </div>

       

        </div>
            
      </div>










  <?php if($idTipoNC == 2){?>

        <div class="col-lg-4 col-xs-11">
        
        <div class="box box-danger">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">  
              <div class="box">

      <!--=====================================
      ENCABEZADO GUIA DESPACHO
      ======================================-->       

          <div class="row"> 
               <div class="col-lg-12 col-xs-11">  
                   <div id="equipos_en_factura" align="left"></div>              
                
              </div>
          </div> 
          <br> 
          <br>
          <br>
          <br>
          <br>
          <br>  
                           
           <div class="row"> 
            
             <div class="col-lg-12 col-xs-11">  
                   <div id="equipos_en_nc" align="left"></div>              
                
              </div>
           
          </div>  
          <br>  

                  

              </div>

          </div>


        </div>
            
      </div>

   <?php
      }
   ?>   
     



    </div>
   
  </section>

</div>













<script src="vistas/js/facturaNCND.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">

     $(document).ready(function(){

                tipoNC = $('#idTipoNC').val();

                if(tipoNC != 3){
                    $('#cmbActividadNC').attr('disabled', true); 
                }
               


              
                 if($('#estadoNC').val() == 13){
                    $('#btnTimbrarNC').attr('disabled', true);
                    $('#detalleNC').attr('disabled', true);

                 }
              
              if($('#idTipoNC').val() == 2){
                 recargaFacturaSII();
                 recargaRegistrosNC();
                 totalNC();
             }
     

   });     
    
   

          

</script>