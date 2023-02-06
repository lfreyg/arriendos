
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


  $idFacturaEEPP = $_SESSION["idFacturaArriendo"];

  $idOC = $_SESSION["idOrdenCompra"];

  $hoyEEPP = $_SESSION["fechaEEPP"];
  $dateReg = date_create($hoyEEPP);
  $mes = date_format($dateReg,"m");
  $anno = date_format($dateReg,"Y");
  $nombreMes = ControladorEEPP::ctrNombreMeses($mes);

  $periodo = $nombreMes.'-'.$anno;
  $fechaEEPP = date_format($dateReg,"d-m-Y");

  $orden = ModeloOrdenCompra::mdlMostrarOCConDatos($idOC);



$facturacion = ModeloFacturacionEEPPOC::obtenerDatosFactura($idFacturaEEPP);
$estadoFactura = $facturacion["estado_factura"];
$idEmpresa = $facturacion["id_empresa"];


$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$tipoCobro = $obra["tipoCobro"];
$idConstructora = $obra["id_constructoras"];





?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       Facturar Orden Compra <?=$orden["oc"]?> para <?=$nombreObra?>   
    </h1>
    <h4>      
       <?php echo 'Periodo '.$periodo.' ('.$fechaEEPP.')'.' Tipo Cobro : '.$tipoCobro?>   
    </h4>
    
         
   
  </section>

  <section class="content">

    <div class="row"> 
     
            <div class="form-row align-items-center">
              <div class="box-header with-border">
                 <div class="col-lg-6 col-xs-11"> 
                   <button class="btn btn-success" id="btnEEPPFacturarSelVolver" >Volver Orden Compra</button>
                   <input type="hidden" id="idObra" name="idObra" value="<?php echo $idObra?>">
                   <input type="hidden" id="idConstructora" name="idConstructora" value="<?php echo $idConstructora?>"> 
                   <input type="hidden" id="idEmpresaOperativa" name="idEmpresaOperativa" value="<?php echo $idEmpresa?>">  
                   <input type="hidden" id="idFacturaEEPPSel" name="idFacturaEEPPSel" value="<?php echo $idFacturaEEPP?>">  
                   <input type="hidden" id="estadoFactura" name="estadoFactura" value="<?php echo $estadoFactura?>"> 
                   <input type="hidden" id="idOrdenCompra" name="idOrdenCompra" value="<?php echo $idOC?>"> 

                </div>
              </div>
             </div> 

          <div id="contenedorEEPP" class="col-lg-8 col-xs-11"> 
             <div class="box box-warning"> 
               <div class="box-header with-border"></div>
                 <div class="box-body">                   
                            <div id="eepp_para_facturar_sel" align="left"></div>
                                               
                 </div>
                 <br>
                 <br>
                             <div class="col-lg-8 col-xs-11"> 
                                  <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnConfirmaFormaFactura">CONFIRMAR</button> 
                              </div>  
              </div>
           </div> 


           <div id="contenedorFactura" class="col-lg-8 col-xs-11"> 
             <div class="box box-warning"> 
               <div class="box-header with-border"></div>
                     <div class="box-body">                           
                            <div id="eepp_facturado" align="left"></div>
                     </div>
                     <br>
                     <br>
                              <div class="col-lg-8 col-xs-11"> 
                                  <button class="btn btn-lg btn-danger btn-block text-uppercase" id="btnAnularFormaFactura">ANULAR FORMA FACTURAR</button> 
                              </div> 
                                
             </div>
           </div> 

        




          <div class="col-lg-4 col-xs-11"> 
             <div class="box box-danger"> 
               <div class="box-header with-border"></div>
                 <div class="box-body"> 

                   <div id="contenedorCheck"> 
                        <div class="form-check">
                            <input class="form-check-input" onclick="genera_tabla_eepp_facturar_seleccion()" type="radio" name="mostrarEEPP" id="mostrarEEPP1" value="1" checked>
                            <label class="form-check-label" for="mostrarEEPP1">
                              MOSTRAR EEPP RESUMEN
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" onclick="genera_tabla_eepp_agrupado()" type="radio" name="mostrarEEPP" id="mostrarEEPP2" value="2">
                            <label class="form-check-label" for="mostrarEEPP2">
                              MOSTRAR EEPP AGRUPA EQUIPOS
                            </label>
                          </div>
                          <div class="form-check disabled">
                            <input class="form-check-input" onclick="genera_tabla_eepp_detalle()" type="radio" name="mostrarEEPP" id="mostrarEEPP3" value="3">
                            <label class="form-check-label" for="mostrarEEPP3">
                              MOSTRAR EEPP DETALLES
                            </label>
                        </div>                        
                     </div> 
                        <br>  

               <div id="contenedorText"> 
                     <div class="row">
                          <div class="col-lg-8 col-xs-11"> 
                            <label for="cmbReferencias">Referencias</label> 
                              <select class="form-control" id="cmbReferencias" name="cmbReferencias"> 

                                  <?php

                                  $referencias = ModeloFacturacionEEPP::mdlReferencias();

                                  foreach ($referencias as $key => $value) {
                                    
                                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                                  }

                                  ?>

                                </select>
                                <br>
                        </div>
                        <br>
                          <div class="col-lg-8 col-xs-11"> 
                            <label for="numeroRef">Numero Documento</label> 
                            <input type="text" class="form-control" name="numeroRef" id="numeroRef" >
                        </div>
                     
                      <br>
                     
                        <div class="col-lg-8 col-xs-11"> 
                            <label for="fechaRef">Fecha Documento</label> 
                            <input type="date" class="form-control" name="fechaRef" id="fechaRef" >
                        </div>

                         <br>
                      
                          <div class="col-lg-8 col-xs-11"> 
                            <label for="montoOCFactura">Neto Factura</label> 
                            <input type="text" class="form-control" readonly align="right" name="montoOCFacturaFormato" id="montoOCFacturaFormato" >
                            <input type="hidden" class="form-control" name="montoOCFactura" id="montoOCFactura" >
                         </div>
                     
                      <br>
                           <div class="col-lg-2 col-xs-11">
                            <button class="btn btn-success btn-xm text-uppercase" id="btnAgregaReferencia">Agregar</button> 
                         </div>
                   </div>      
               </div>    
                    <br>
             
                    <div class="row">
                        <div class="col-lg-11 col-xs-11">
                           <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVisualizarFactura">VISUALIZAR FACTURA</button> 
                        </div>
                     </div>   
                        <br>
                      <div class="row">
                        <div class="col-lg-11 col-xs-11">
                           <button class="btn btn-lg btn-danger btn-block text-uppercase" id="btnEliminarFactura">ELIMINAR FACTURA</button> 
                        </div>
                     </div>   
                        <br>   
                      <div class="row">   
                      <div class="col-lg-11 col-xs-11">
                           <button class="btn btn-lg btn-primary btn-block text-uppercase" id="btnTimbrarFactura">TIMBRAR FACTURA</button> 
                        </div>
                    </div>  

                     <br>
                     <br>
                      <div class="row">   
                      <div class="col-lg-11 col-xs-11">                     
                            <div id="detalle_facturado" align="left"></div>    
                     </div>
                    </div>  
                    <br>
                     <br>
                      <div class="row">   
                      <div class="col-lg-11 col-xs-11">                     
                            <div id="referencia_factura" align="left"></div>    
                     </div>
                    </div> 


                    

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

<div id="modalEditarSII" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Registro Factura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div class="row">             

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="codigoSII">Código</label> 
                    <input type="text" readonly class="form-control" id="codigoSII" value="">
                     <input type="hidden" id="idRegistroSII" name="idRegistroSII"> 
                     
              </div>


              <div class="col-lg-6 col-xs-11">                                   
                     <label for="descripcionSII">Descripción</label> 
                    <input type="text" readonly class="form-control" id="descripcionSII" value="">                  
              </div>                            

           </div>            
             <br>

            <!--=====================================
            PRECIO Y DETALLE EQUIPOS GUIA DESPACHO
            ======================================--> 

            <div class="row">  

              <div class="col-lg-4 col-xs-11">                                   
                     <label for="cantidadSII">Cantidad</label> 
                    <input type="number" readonly class="form-control" id="cantidadSII" value="">                  
              </div>

               <div class="col-lg-4 col-xs-11">                                   
                     <label for="precioSII">Precio</label> 
                    <input type="number" readonly class="form-control" id="precioSII" value="">
                               
              </div> 

           </div>  
            <br>
            <br>
           <div class="row">             
              
              <div class="col-lg-11 col-xs-11">   
                     <textarea name="glosaSII" id="glosaSII" rows="4" cols="50"></textarea>
              </div>
                  

           </div>              
           

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarRegistroSII" class="btn btn-primary">Guardar Cambios</button>

        </div>


     

    </div>

  </div>

</div>


<script src="vistas/js/facturacionEEPPOC.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript"> 
  
  
  $(document).ready(function(){
    
   estado_factura = $('#estadoFactura').val();

   if(estado_factura == 12){ 
         $('#contenedorEEPP').css("display", "block");
         $('#contenedorCheck').css("display", "block");

         $('#contenedorFactura').css("display", "none");
         $('#contenedorText').css("display", "none");
         $('#btnTimbrarFactura').css("display", "none");
          genera_tabla_eepp_facturar_seleccion();
   }

   if(estado_factura == 7){ 
         $('#contenedorEEPP').css("display", "none");
         $('#contenedorCheck').css("display", "none");


          $('#contenedorFactura').css("display", "block");
          $('#contenedorText').css("display", "block");
          $('#btnTimbrarFactura').css("display", "block");

         genera_tabla_factura_sii();
   }   


   if(estado_factura == 13){ 
         $('#contenedorEEPP').css("display", "none");
         $('#contenedorCheck').css("display", "none");
         $('#btnAnularFormaFactura').attr("disabled", 'disabled');
         $('#btnEliminarFactura').attr("disabled", 'disabled');
         $('#btnAgregaReferencia').attr("disabled", 'disabled');

         


          $('#contenedorFactura').css("display", "block");
          $('#contenedorText').css("display", "block");
          $('#btnTimbrarFactura').css("display", "none");

         genera_tabla_factura_sii();
   } 
   
   genera_tabla_detalle_facturacion();
   obtenerTotalesFacturacion();


   });     

  
</script>