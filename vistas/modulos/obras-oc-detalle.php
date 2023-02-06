<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}


$_SESSION['idOrdenCompra'] = null;
$_SESSION["idFacturaArriendo"] = null;
$_SESSION["idObraFacturar"] = null;
 


$idEEPP = $_SESSION["idEEPP"];
$idObra = $_SESSION["idObraEEPP"];

$hoyEEPP = $_SESSION["fechaEEPP"];
$dateReg = date_create($hoyEEPP);
$mes = date_format($dateReg,"m");
$anno = date_format($dateReg,"Y");
$nombreMes = ControladorEEPP::ctrNombreMeses($mes);

$periodo = $nombreMes.'-'.$anno;
$fechaEEPP = date_format($dateReg,"d-m-Y");


$hoy = date('Y-m-d');

$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$tipoCobro = $obra["tipoCobro"];
$idConstructora = $obra['id_constructoras'];

$usuario = $_SESSION["nombre"];


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
     Listado Ordenes de compra <?php echo $nombreObra?>    
    </h1>
     <h4>      
       <?php echo 'Periodo '.$periodo.' ('.$fechaEEPP.')'.' Tipo Cobro : '.$tipoCobro?>   
    </h4>

   
  </section>

  <section class="content">

    <div class="box">

       <div class="box-header with-border">
        <button class="btn btn-success" id="btnListaOCVolver" >Volver</button>
      </div>

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoOC" data-toggle="modal" data-target="#modalAgregarOC">
          
          Nueva Orden Compra

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaObraListaOC" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           <th>N° Orden</th> 
           <th>Fecha Orden</th>          
           <th>Fecha Ingreso</th>
           <th>Factura</th> 
           <th>Neto</th>           
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

<div id="modalAgregarOC" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Nueva Orden Compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">  

            
           <div class="row">
               <div class="col-lg-6 col-xs-11">               
                <label for="nuevoNumeroOC">Número OC</label> 
                <input type="text" class="form-control input-lg" name="nuevoNumeroOC" value="" id="nuevoNumeroOC" autocomplete="off" placeholder="Número OC" required>
                <input type="hidden" id="id_constructora_oc" name="id_constructora_oc" value="<?php echo $idConstructora?>">
                <input type="hidden" id="id_obra_oc" name="id_obra_oc" value="<?php echo $idObra?>">
                <input type="hidden" id="id_eepp" name="id_eepp" value="<?php echo $idEEPP?>">
                <input type="hidden" id="usuario_oc" name="usuario_oc" value="<?php echo $usuario?>">
              </div>         
           </div> 
           <br>
           <br>
           <div class="row">
               <div class="col-lg-6 col-xs-11"> 
                <label for="nuevoFechaOC">Fecha OC</label> 
                <input type="date" class="form-control input-lg" name="nuevoFechaOC" value="<?php echo $hoy?>" id="nuevoFechaOC" autocomplete="off" placeholder="Fecha" required>
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

          $crearGuia = new ControladorOrdenCompra();
          $crearGuia -> ctrCrearOrdenCompra();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarOC" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Orden de Compra</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
             
             <div class="row">
               <div class="col-lg-6 col-xs-11">               
                <label for="nuevoNumeroOCE">Número OC</label> 
                <input type="text" class="form-control input-lg" name="nuevoNumeroOCE" value="" id="nuevoNumeroOCE" autocomplete="off" placeholder="Número OC" required>
                <input type="hidden" id="idRegistro" name="idRegistro">
              </div>         
           </div> 
           <br>
           <br>
           <div class="row">
               <div class="col-lg-6 col-xs-11"> 
                <label for="nuevoFechaOCE">Fecha OC</label> 
                <input type="date" class="form-control input-lg" name="nuevoFechaOCE" value="<?php echo $hoy?>" id="nuevoFechaOCE" autocomplete="off" placeholder="Fecha" required>
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

          $editarReport = new ControladorOrdenCompra();
          $editarReport -> ctrEditarOC();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $eliminarOC = new ControladorOrdenCompra();
  $eliminarOC -> ctrEliminarOC();

?>      


<script src="vistas/js/asociar_oc.js?v=<?php echo(rand());?>"></script>

