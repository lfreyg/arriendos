<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

 $_SESSION["idObraFacturar"] = null;
 $_SESSION["idFacturaArriendo"] = null;

if(empty($_SESSION['idOrdenCompra'])){
  $_SESSION["idOrdenCompra"] = $_GET["idOC"];
  $idOC = $_GET["idOC"];
}else{
  $idOC = $_SESSION["idOrdenCompra"];
}

if($_SESSION["idOrdenCompra"] == ''){

  echo '<script>

    window.location = "obras-oc-detalle";

  </script>';

  return;

}

$hoyEEPP = $_SESSION["fechaEEPP"];
$dateReg = date_create($hoyEEPP);
$mes = date_format($dateReg,"m");
$anno = date_format($dateReg,"Y");
$nombreMes = ControladorEEPP::ctrNombreMeses($mes);

$periodo = $nombreMes.'-'.$anno;
$fechaEEPP = date_format($dateReg,"d-m-Y");


$hoy = date('Y-m-d');

$orden = ModeloOrdenCompra::mdlMostrarOCConDatos($idOC);

$idObra = $orden["idObra"];

$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$tipoCobro = $obra["tipoCobro"];

$factura = $orden["id_factura"];

$disable = '';

if($factura == null){
  $factura = 0;
}else{
  $facturacion = ModeloFacturacionEEPP::obtenerDatosFactura($factura);
  $estadoFactura = $facturacion["estado_factura"];
  
  if($estadoFactura == 7 || $estadoFactura == 13){
    $disable = 'disabled';
  }

  $_SESSION["idObraFacturar"] = $idObra;
  $_SESSION["idFacturaArriendo"] = $factura;
}


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Orden Compra <?php echo $orden["oc"]?> para <?=$nombreObra?>
    
    </h1>
    <h4>      
       <?php echo 'Periodo '.$periodo.' ('.$fechaEEPP.')'.' Tipo Cobro : '.$tipoCobro?>   
    </h4>


  </section>

  <section class="content">

    <div class="row">
     <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 col-xs-11">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
                               
           
            <div id="equipos_para_oc_eepp" align="left"></div>
                 

          </div>

        </div>


      </div>




      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-11">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">  
              <div class="box">

      <!--=====================================
      ENCABEZADO REPORT
      ======================================-->            
                           
           <div class="row">          
         
            <div class="col-lg-5 col-xs-11">                                    
                    <label for="constructora">Cliente</label>
                    <input type="text" class="form-control" name="constructora" id="constructora" value="<?php echo $orden["constructora"]?>" readonly> 
                    <input type="hidden" id="idConstructora" name="idConstructora" value="<?php echo $orden["idConstructora"]?>">  
                    <input type="hidden" id="idOC" name="idOC" value="<?php echo $orden["idOC"]?>"> 
                    <input type="hidden" id="numeroOC" name="numeroOC" value="<?php echo $orden["oc"]?>">
                    <input type="hidden" id="id_eeppOCtxt" name="id_eeppOCtxt" value="<?php echo $orden["id_eepp"]?>">
                    <input type="hidden" id="id_FacturaTxt" name="id_FacturaTxt" value="<?php echo $factura?>">
                    <input type="hidden" id="estadoFac" name="estadoFac" value="<?php echo $estadoFactura?>">
                    
                                   
            </div>    

                
            <div class="col-lg-5 col-xs-11">
                                   
                     <label for="obra">Obra</label> 
                    <input type="text" class="form-control" id="obra" name="obra" value="<?php echo $orden["obra"]?>" readonly> 
                    <input type="hidden" id="idObra" name="idObra" value="<?php echo $orden["idObra"]?>">                
            </div>  
          </div>  
          <br>  
           

      <!--=====================================
      DETALLE EQUIPOS REPORT
      ======================================-->      
               <!--  
                <h3>Equipos a agregar OC</h3>
              -->

          <div class="row">             

              <div class="col-lg-2 col-xs-11"> 
                <!--                                  
                     <label for="codigoEquipo">Código</label> 
                    <input type="text" class="form-control" id="codigoEquipo" name="codigoEquipo" value="" readonly>
                  -->  
                    <input type="hidden" id="idEEPPDetalle" name="idEEPPDetalle"> 
                    <input type="hidden" id="cantidadOrigen" name="cantidadOrigen">
                    <input type="hidden" id="precioOrigen" name="precioOrigen">
                    <input type="hidden" id="tablaOrigen" name="tablaOrigen">
              </div>
             <!--
              <div class="col-lg-6 col-xs-11">                                   
                     <label for="descripcionEquipo">Descripción</label> 
                    <input type="text" class="form-control" id="descripcionEquipo" value="" readonly>                  
              </div> 

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="precioEEPP">Precio</label> 
                    <input type="number" class="form-control" id="precioEEPP" value="" >                  
              </div> 

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="cantidadEEPP">Cantidad</label> 
                    <input type="number" class="form-control" id="cantidadEEPP" value="" >                  
              </div> 
            -->

           </div> 

                <!-- 
                  <div class="pull-right">

                        <button class="btn btn-primary" id="btnAgregaOC">Agregar a OC</button>
            
                   </div> 
                   -->      
                
                               
               <div id="divTablaDetalles" class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_detalles" align="left"></div>
                      </div>
               </div>            

              </div>

          </div>

          <div class="box-footer">                         
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolverOC">Volver a OC</button> 
             </div> 
             
          </div>

          <div class="box-footer">                         
             <div class="pull-right-container">
             <button class="btn btn-lg btn-primary btn-block text-uppercase" id="btnFacturarAhora">FACTURAR AHORA</button> 
             </div> 
             
          </div>

       

        </div>
            
      </div>



    </div>
   
  </section>

</div>


<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarFacturaDesdeOC" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Nueva Factura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body"> 

           <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

            <div class="row">          
             <div class="col-lg-11 col-xs-11">
                <label for="nuevaEmpresaOperativa">Empresa Operativa</label>
                <select class="form-control input-lg" id="EmpresaOperativa_Fac" name="EmpresaOperativa_Fac" required> 
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
               <div class="col-lg-11 col-xs-11">               
                <label for="cliente">Cliente</label> 
                <input type="text" class="form-control input-lg" name="cliente" id="cliente" autocomplete="off" readonly value="<?=$orden["constructora"]?>">
               <input type="hidden" id="id_constructora_fac" name="id_constructora_fac" value="<?=$orden["idConstructora"]?>">
                <input type="hidden" id="id_obra_fac" name="id_obra_fac" value="<?php echo $idObra?>">
                <input type="hidden" id="id_eeppFactxt" name="id_eeppFactxt" value="<?php echo $orden["id_eepp"]?>">   
                 <input type="hidden" id="id_ocFactxt" name="id_ocFactxt" value="<?php echo $idOC?>">            
              </div>         
           </div> 
           <br>
           <br>
           <div class="row">
               <div class="col-lg-11 col-xs-11"> 
                <label for="obra">Obra</label> 
                <input type="text" class="form-control input-lg" name="obra" readonly value="<?php echo $nombreObra?>" id="obra" >
              </div>
          </div> 
          <br>
           <br>
          <div class="row">
               <div class="col-lg-6 col-xs-11"> 
                <label for="obra">Fecha Factura</label> 
                <input type="date" class="form-control input-lg" name="fechaFactura" value="<?php echo $hoy?>" id="fechaFactura" >
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

          $crearGuia = new ControladorFacturacion();
          $crearGuia -> ctrCrearFacturaEEPPDesdeOC();

        ?>

      </form>

    </div>

  </div>

</div>



<script src="vistas/js/asociar_oc.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

      estadoFac = $('#estadoFac').val(); 
      if(estadoFac == 13 || estadoFac == 7){
           $('#equipos_para_oc_eepp').css("display", "none");
      }

       genera_tabla_oc();
    

   });     

  


     

</script>