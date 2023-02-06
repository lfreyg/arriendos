<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idND'] = null;

if(empty($_SESSION["idFacturaND"])){
  $_SESSION["idFacturaND"] = $_GET["idFactura"];
  $idFactura = $_GET["idFactura"];
}else{
  $idFactura = $_SESSION["idFacturaND"];
}



$facturacion = ModeloFacturacionEEPPOC::obtenerDatosFactura($idFactura);
$estadoFactura = $facturacion["estado_factura"];
$idEmpresa = $facturacion["id_empresa"];
$numFactura = $facturacion['numero_factura'];
$idConstructora = $facturacion['id_constructora'];
$idObra = $facturacion['id_obra'];

$validarND = ModeloFacturacionNCND::mdlNDFinalizada($idFactura);

$hoy = date('Y-m-d');

$fechaMas = date("Y-m-d",strtotime($hoy."+ 3 days")); 

$fechaMenos = date("Y-m-d",strtotime($hoy."- 3 days")); 

$disable = '';
$mensaje = '';
if($estadoFactura == 14){
  $disable = 'disabled';  
  $mensaje = 'Factura se encuentra anulada, no se puede agregar ND';
}

if($validarND){
  $disable = 'disabled';
  $mensaje = 'Debe Terminar ND en proceso o borrador';
}


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Notas de Débito Factura <?php echo $numFactura?>
    
    </h1>

  </section>

  <section class="content">

     <div class="row"> 

       <div class="box-header with-border">
        <button class="btn btn-success" id="btnListaNDVolver" >Volver</button>
      </div>

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-lg" <?=$disable?> id="btnNuevoND" data-toggle="modal" data-target="#modalAgregarND">
          
          Nueva Nota Débito

        </button>
         <h4><?=$mensaje?></h4>
        <input type="hidden" id="idEmpresaGral" name="idEmpresaGral" value="<?=$idEmpresa?>">
        <input type="hidden" id="idFacturaGral" name="idFacturaGral" value="<?=$idFactura?>">
        
              
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaListaND" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           <th>Empresa</th> 
           <th>N° Nota Débito</th> 
           <th>Fecha Nota Débito</th>          
           <th>Neto</th> 
           <th>Tipo Nota Débito</th>
           <th>Cliente</th> 
           <th>Destino</th>
           <th>Estado</th>           
           <th>Acciones</th>           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarND" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Nueva Nota Débito</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body"> 

           <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

            <div class="row">          
             <div class="col-lg-11 col-xs-11">
                <label for="tipoND">Tipo Nota Débito</label>
                <select class="form-control input-lg" id="tipoND" name="tipoND" required> 
                  <?php

                 $tipo_nc = ModeloFacturacionNCND::mdlListarTipoNotaDebito();

                  foreach ($tipo_nc as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                  }

                  ?>
  
                </select>               

              </div>

            </div>

               <input type="hidden" id="idConstructora" name="idConstructora" value="<?=$idConstructora?>">
                <input type="hidden" id="idObra" name="idObra" value="<?=$idObra?>">
                <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?=$idEmpresa?>">
                <input type="hidden" id="idFactura" name="idFactura" value="<?=$idFactura?>">
                
           <br>
           <br>          
          <div class="row">
               <div class="col-lg-6 col-xs-11"> 
                <label for="fechaND">Fecha NC</label> 
                <input type="date" class="form-control input-lg" min="<?=$fechaMenos?>" max="<?=$fechaMas?>" name="fechaND" value="<?=$hoy?>" id="fechaND" >
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

          $crearGuia = new ControladorFacturaND();
          $crearGuia -> ctrCrearND();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarFac" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Factura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           <div class="row">
               <div class="col-lg-6 col-xs-11"> 
                <label for="fechaFacEdita">Fecha Factura</label> 
                <input type="date" class="form-control" name="fechaFacEdita"  id="fechaFacEdita" autocomplete="off" placeholder="Fecha" required>
                <input type="hidden" id="idRegistro" name="idRegistro">
              </div>
          </div>    
           



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php

          $editarFac = new ControladorFacturacion();
          $editarFac -> ctrEditarFacturaEEPP();

        ?>

      </form>

    </div>

  </div>

</div>





<script src="vistas/js/facturaNCND.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

              
      $('.tablaListaND').DataTable().destroy();

      recargaTablaListadoND();
      $('.tablaListaND').DataTable().ajax.reload();

   });     

  


     

</script>

