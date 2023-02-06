<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION['idND'])){
    $_SESSION['idND'] = $_GET['idND'];
    $idND = $_GET['idND'];
}else{
    $idND = $_SESSION["idND"];
}

  


if($_SESSION["idND"] == ''){

  echo '<script>

    window.location = "factura-nota-credito-listado";

  </script>';

  return;

}



$hoy = date('Y-m-d');

$notaCredito = ModeloFacturacionNCND::mdlMostrarND($idND);

if($notaCredito["numero_nd"] == 0){
    $numNotaCredito = 'EN PROCESO';
}else{
    $numNotaCredito = $notaCredito["numero_nd"];
}

$tipoND = $notaCredito["tipoND"];
$numFactura = $notaCredito['numero_factura'];
$netoFactura = $notaCredito['neto_factura'];
$idTipoND = $notaCredito["tipo_nota"];
$idFactura = $notaCredito["idFactura"];
$estadoND = $notaCredito["idEstadoNota"];
$idEmpresa = $notaCredito["idEmpresaOperativa"];


$read = '';
$descripcion = '';
$readTexto = 'readonly';


if($idTipoND == 1){
    $descripcionDetalle = 'NOTA DE DÉBITO CORRIGE MONTOS DE FACTURA '.$numFactura;
    $netoFactura = 0;
    $read = 'readonly';
}




?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Detalle Nota de Débito <?php echo $numNotaCredito?>
    
    </h1>
    <h4>
      
      <?php echo $tipoND?>
    
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
                    <input type="hidden" id="idFacturaND" name="idFacturaND" value="<?=$idFactura?>">
                    <input type="hidden" id="estadoND" name="estadoND" value="<?=$estadoND?>"> 
                    <input type="hidden" id="idEmpresaOperativa" name="idEmpresaOperativa" value="<?=$idEmpresa?>"> 
                    <input type="hidden" id="idND" name="idND" value="<?=$idND?>"> 
                    <input type="hidden" id="idTipoND" name="idTipoND" value="<?=$idTipoND?>">                 
                
              </div>

               <div class="col-lg-3 col-xs-11">                                   
                     <label for="fechaND">Fecha ND</label> 
                    <input type="date" class="form-control" id="fechaND" value="<?=$notaCredito["fecha_nota"]?>" readonly>                  
              </div>
              
          </div> 
          <br>   
                           
           <div class="row"> 
            
            <div class="col-lg-2 col-xs-11">                                    
                    <label for="rutConstructoraGuia">Rut Cliente</label>
                    <input type="text" class="form-control" id="rutConstructoraND" value="<?php echo str_replace(".","",$notaCredito["rutConstructora"])?>" readonly> 
                                                      
            </div> 


            <div class="col-lg-5 col-xs-11">                                    
                    <label for="constructoraGuia">Cliente</label>
                    <input type="text" class="form-control" id="constructoraND" value="<?php echo $notaCredito["constructora"]?>" <?=$readTexto?>>   
                                   
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
                    <input type="text" class="form-control" id="telefonoND" value="<?php echo $notaCredito["telefono"]?>" <?=$readTexto?>>                  
              </div>
               

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="contactoNC">Contacto</label> 
                    <input type="text" class="form-control" id="contactoND" value="<?php echo $notaCredito["contacto_cobranza"]?>" <?=$readTexto?>>                  
              </div>
             </div>

           <div class="row">             

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="transporteGuia">Dirección</label> 
                    <input type="text" class="form-control" id="direccionND" value="<?php echo $notaCredito["direccion"]?>" <?=$readTexto?>>                  
              </div>
               

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="patenteGuia">Comuna</label> 
                    <input type="text" class="form-control" id="comunaND" value="<?php echo $notaCredito["comuna"]?>" <?=$readTexto?>>                  
              </div>
             </div>
             
              <div class="row">  

                  <div class="col-lg-6 col-xs-11">                                   
                         <label for="rutChoferGuia">Ciudad</label> 
                        <input type="text" class="form-control" id="ciudadND" value="<?php echo $notaCredito["ciudad"]?>" <?=$readTexto?>>                  
                  </div>
               

                  <div class="col-lg-6 col-xs-11">                                   
                         <label for="choferGuia">Actividad</label> 
                         <select class="form-control input-xs" id="cmbActividadND" name="cmbActividadND" >  
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

      <!--=====================================
      DETALLE EQUIPOS GUIA DESPACHO
      ======================================-->       

                 <hr> 

      <!--=====================================
           DIV SELECCION DE EQUIPOS
       ======================================-->             
         

          <div class="row">             
             

           </div> 

           <br>

            <!--=====================================
            PRECIO Y DETALLE EQUIPOS GUIA DESPACHO
            ======================================--> 

            <div class="row">             

              <div class="col-lg-8 col-xs-11">                                   
                     <label for="detalleEquipo">Descripción ND</label> 
                    <input type="text" class="form-control" id="detalleND" value="<?=$descripcionDetalle?>">                  
              </div>
                       

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="detalleEquipo">Neto ND</label> 
                    <input type="number" class="form-control" <?=$read?> id="netoND" value="<?=$netoFactura?>">                  
              </div>
                            

           </div>             
                  

              </div>

          </div>

          <div class="box-footer">
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolverND">Volver a Lista</button> 
             </div> 
             <br>   
              <div class="pull-right-container">       
             <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnTimbrarND">TIMBRAR ND</button>  
            </div>
          </div>

       

        </div>
            
      </div>



       <?php if($idTipoND == 1){?>

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
                   <div id="equipos_en_nd" align="left"></div>              
                
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

                
                    $('#cmbActividadND').attr('disabled', true); 
                
               


              
                 if($('#estadoND').val() == 13){
                    $('#btnTimbrarND').attr('disabled', true);
                    $('#detalleND').attr('disabled', true);

                 }

                 if($('#idTipoND').val() == 1){
                   recargaFacturaSIIND();
                   recargaRegistrosND();
                   totalND();
             }
     

   });     
    
   

          

</script>