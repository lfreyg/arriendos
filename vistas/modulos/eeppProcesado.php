<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idObraOC"] = null;

if(empty($_SESSION["idEEPP"])){
  $_SESSION["idEEPP"] = $_GET["idEEPP"];
  $idEEPP = $_GET["idEEPP"];
}else{
  $idEEPP = $_SESSION["idEEPP"];
}

if(empty($_SESSION["fechaEEPP"])){
  $_SESSION["fechaEEPP"] = $_GET["fechaEEPP"];
  $hoy = $_GET["fechaEEPP"];
}else{
  $hoy = $_SESSION["fechaEEPP"];
}

if(empty($_SESSION["idObraEEPP"])){
  $_SESSION["idObraEEPP"] = $_GET["idObraEEPP"];
  $idObra = $_GET["idObraEEPP"];
}else{
  $idObra = $_SESSION["idObraEEPP"];
}

$edita = 0;
$btnFinaliza = 'FINALIZAR';
if(empty($_SESSION["editaEEPP"])){
     if(isset($_GET["edita"])){   
      $_SESSION["editaEEPP"] = $_GET["edita"];
      $edita = $_GET["idObraEEPP"];
    }
}else{        
      $edita = $_SESSION["editaEEPP"];    
}

if($edita == 1){
    $btnFinaliza = 'VOLVER SELECCIÓN';
}



date_default_timezone_set('America/Santiago');


$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$tipoCobro = $obra["tipoCobro"];
$idConstructora = $obra["id_constructoras"];

$dateReg = date_create($hoy);
$mes = date_format($dateReg,"m");
$anno = date_format($dateReg,"Y");
$nombreMes = ControladorEEPP::ctrNombreMeses($mes);

$periodo = $nombreMes.'-'.$anno;
$fechaEEPP = date_format($dateReg,"d-m-Y");

$ultimoEEPP = ModeloEEPP::mdlUltimoEEPP($idObra);

$ultimoEEPP = $ultimoEEPP['id'];

if($idEEPP == $ultimoEEPP){
    $ultimo = 1;
}else{
    $ultimo = 0;
}

if($edita == 0){
   $titulo = 'EEPP Generado';
}else{
   $titulo = 'Edita EEPP Generado'; 
}   


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       <?php echo $titulo.' '.$nombreObra?>   
    </h1>
    <br>
    <h4>      
       <?php echo 'Periodo '.$periodo.' ('.$fechaEEPP.')'.' Tipo Cobro : '.$tipoCobro?>   
    </h4>
    <br>
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="eepp">EEPP</a></li>

      <li class="obrasEEPP">Obras</li>

      <li class="equiposEEPP">Equipos EEPP</li>
      
      <li class="active">Equipos EEPP</li>
    
    </ol>

  </section>

  <section class="content">   

    <div class="box">
            <div class="box-header with-border">
               <div class="col-lg-12 col-xs-8"> 
                  <button class="btn btn-success" id="btnEEPPGeneradoVolver" ><?php echo $btnFinaliza ?></button>
                  <button class="btn btn-warning" id="btnEEPPGeneradoDescuento" data-toggle="modal" data-target="#modalAgregarDescuento" >Agregar Descuento</button>
                  <button class="btn btn-default" id="btnEEPPGeneradoAgregar" data-toggle="modal" data-target="#modalAgregarExtra" >Agregar Cobro Extra</button>
                 <button class="btn btn-danger" id="btnEEPPDiasDescuento" data-toggle="modal" data-target="#modalDiasDescuentos" >Días a Descontar</button>
                  <button class="btn btn-info" id="btnEEPP_PDF" >Generar PDF</button>
                  <button class="btn btn-primary" id="btnEEPP_Excel" >Generar Excel</button>
                  <button class="btn btn-success" id="btnEEPP_OC" >Asociar OC</button>
              </div> 
             <div  align="right">                    
                  <button class="btn btn-danger" id="btnEEPPGeneradoAnular" >ANULAR EEPP</button>
             </div> 
             </div> 
    </div>      


     <div class="box-body"> 
                  <input type="hidden" id="idEEPPCobro" name="idEEPPCobro" value="<?php echo $idEEPP?>">
                  <input type="hidden" id="idConstructora" value="<?php echo $idConstructora?>">
                  <input type="hidden" id="idObraEEPP" name="idObraEEPP" value="<?php echo $idObra?>">
                  <input type="hidden" id="ultimoEEPP" name="ultimoEEPP" value="<?php echo $ultimo?>">
                  <input type="hidden" id="fechaEEPPEdita" value="<?php echo $hoy?>">
                  <input type="hidden" id="tipoCobroTxt" value="<?php echo $tipoCobro?>">
                  <input type="hidden" id="esEditar" value="<?php echo $edita?>">


                  <div class="col-lg-12 col-xs-8">  
                            <div id="equipos_cobrados_eepp" align="left"></div>
                  </div>                   
        </div>

        <div class="box-body"> 
                  <div class="col-lg-4 col-xs-4">  
                            <div id="dias_descuento_eepp" align="left"></div>
                  </div> 
        </div>  
        
         <div class="box-body"> 
                  <div class="col-lg-8 col-xs-8">  
                            <div id="materiales_cobrados_eepp" align="left"></div>
                  </div> 
        </div>   
        
         <div class="box-body"> 
                  <div class="col-lg-8 col-xs-11">  
                            <div id="descuentos_extras_eepp" align="left"></div>
                  </div> 
        </div>  
            
          
      
   

     



  
    
  </section>

</div>

<!--=====================================
MODAL AGREGAR DESCUENTO 
======================================-->

<div id="modalAgregarDescuento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Descuento EEPP</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           
               
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="motivoDescuentoEEPP_Txt">Descripcion Descuento</label> 
                             <input type="text" class="form-control" autocomplete="off" id="motivoDescuentoEEPP_Txt" required>
                             <input type="hidden" id="tipoDescuento" value="D">
                             <input type="hidden" id="idDescuento" value="0">
                            </div>
                </div>  
               <br>
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="montoDescuentoEEPP_Txt">Monto a descontar</label> 
                             <input type="number" class="form-control" autocomplete="off" id="montoDescuentoEEPP_Txt" required>
                            </div>
                </div>                     

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarDescuentoEEPP" class="btn btn-primary">Guardar Descuento</button>

        </div>


     

    </div>

  </div>

</div>



<!--=====================================
MODAL AGREGAR COBRO EXTRA 
======================================-->

<div id="modalAgregarExtra" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cobro Extra EEPP</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           
               
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="motivoExtraEEPP_Txt">Descripcion Cobro Extra</label> 
                             <input type="text" class="form-control" autocomplete="off" id="motivoExtraEEPP_Txt" required>
                             <input type="hidden" id="tipoExtra" value="E">
                             <input type="hidden" id="idExtra" value="0">
                            </div>
                </div>  
                <br>
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="montoExtraEEPP_Txt">Monto Cobro Extra</label> 
                             <input type="number" class="form-control" autocomplete="off" id="montoExtraEEPP_Txt" required>
                            </div>
                </div>                     

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarExtraEEPP" class="btn btn-primary">Guardar Cobro</button>

        </div>


     

    </div>

  </div>

</div>






<!--=====================================
MODAL EDITAR EEPP EQUIPOS
======================================-->

<div id="modalEditarEquipos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Equipo EEPP</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           
               
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="equipoEEPPtxt">Código</label> 
                             <input type="text" class="form-control" autocomplete="off" id="codigoEquipoEEPPtxt" readonly>
                             <input type="hidden" id="idRegitroEdita">
                             <input type="hidden" id="idEEPPEdita" >
                             <input type="hidden" id="idGuiaEEPPEdita">


                            </div>

                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="equipoEEPPtxt">Equipo</label> 
                             <input type="text" class="form-control" autocomplete="off" id="equipoEEPPtxt" readonly>                            
                            </div>
                </div>  
                <br>
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="montoExtraEEPP_Txt">Precio</label> 
                             <input type="number" class="form-control" autocomplete="off" id="precioEquiposEEPP" required>
                            </div>

                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="fechaDesdeEditaEquipo">Fecha Desde</label> 
                             <input type="date" class="form-control" autocomplete="off" id="fechaDesdeEditaEquipo" required>
                         </div>   

                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="fechaHastaEditaEquipo">Fecha Hasta</label> 
                             <input type="date" class="form-control" id="fechaHastaEditaEquipo" required>
                         </div> 
                </div>                     

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarEditaEquipoEEPP" class="btn btn-primary">Guardar Cambios</button>

        </div>


     

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR EEPP EQUIPOS
======================================-->

<div id="modalEditarMaterialesEEPP" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Material EEPP</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           
               
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="equipoEEPPtxt">Código</label> 
                             <input type="text" class="form-control" autocomplete="off" id="codigoMaterialEEPPtxt" readonly>
                             <input type="hidden" id="idRegitroEditaMaterial">
                             <input type="hidden" id="idEEPPEditaMaterial" >
                             <input type="hidden" id="idGuiaEEPPEditaMaterial">


                            </div>

                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="equipoEEPPtxt">Material / Insumo</label> 
                             <input type="text" class="form-control" autocomplete="off" id="materialEEPPtxt" readonly>                            
                            </div>
                </div>  
                <br>
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="precioMaterialEEPP_Txt">Precio</label> 
                             <input type="number" class="form-control" autocomplete="off" id="precioMaterialEEPP_Txt" required>
                            </div>
                                                
                </div>                     

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarEditaMaterialEEPP" class="btn btn-primary">Guardar Cambios</button>

        </div>


     

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR DESCUENTO 
======================================-->

<div id="modalDiasDescuentos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Días a Descontar</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           
               
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="motivoDescuentoEEPP_Txt">Desde</label> 
                             <input type="date" class="form-control" max="<?php echo $hoy?>" value="<?php echo $hoy?>" id="diaDescuentoDesde" required>                            
                        </div>
                </div>  
               <br>
               <div class="row">
                         <div class="col-xs-10" style="padding-right:0px"> 
                             <label for="montoDescuentoEEPP_Txt">Hasta</label> 
                             <input type="date" class="form-control" max="<?php echo $hoy?>" value="<?php echo $hoy?>" id="diaDescuentoHasta" required>
                            </div>
                </div>                     

              
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarDiaDescuento" class="btn btn-primary">Guardar Descuento</button>

        </div>


     

    </div>

  </div>

</div>



<script src="vistas/js/eepp.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

     if($('#ultimoEEPP').val() == 0){
        $('#btnEEPPGeneradoAnular').attr('disabled', true);
     }

     if($('#esEditar').val() == 0){
         $('#btnEEPP_OC').css("display", "none");
     }

    var idEEPP = $('#idEEPPCobro').val(); 
    llenaEquiposProcesados(idEEPP);
    llenaDiasDescuentos(idEEPP);
    llenaMaterialesProcesados(idEEPP);
    llenaDescuentosExtras(idEEPP);
     

   });     

  


     

</script>
