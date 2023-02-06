<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}


$_SESSION['idFacturaArriendo'] = null;


if(empty($_SESSION["idObraFacturar"])){
  $_SESSION["idObraFacturar"] = $_GET["idObra"];
  $idObra = $_GET["idObra"];
}else{
  $idObra = $_SESSION["idObraFacturar"];
}

$hoy = date('Y-m-d');

$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$idConstructora = $obra['id_constructoras'];
$nombreConstructora = $obra["constructora"];

$usuario = $_SESSION["nombre"];

$eeppCobro = ModeloFacturacionEEPP::mdlMostrarEEPPFacturacionPrevia($idObra);
$FacturaExiste = ModeloFacturacionEEPP::mdlExisteFacturaSinTerminar($idObra);
$disable = '';
$mensaje = '';


if(!$eeppCobro){
  $disable = 'disabled';
  $mensaje = 'No existen EEPP para Facturar';
}

if($FacturaExiste){
  $disable = 'disabled';
  $mensaje = 'Debe Terminar Factura en proceso o borrador';
}


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Listado Facturas <?php echo $nombreObra?>
    
    </h1>

  </section>

  <section class="content">

     <div class="row"> 

       <div class="box-header with-border">
        <button class="btn btn-success" id="btnListaFacVolver" >Volver</button>
      </div>

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-lg" <?=$disable?> id="btnNuevoFactura" data-toggle="modal" data-target="#modalAgregarFactura">
          
          Nueva Factura

        </button>
          <h4><?=$mensaje?></h4>

              <input type="hidden" id="idObra_global" name="idObra_global" value="<?php echo $idObra?>">                      
             <input type="hidden" id="idConstructora_global" name="idConstructora_global" value="<?php echo $idConstructora?>">

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaObraListaFac" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           <th>Empresa</th> 
           <th>N° Factura</th>  
           <th>Neto</th>        
           <th>Fecha Factura</th>
           <th>Cliente</th> 
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

<div id="modalAgregarFactura" class="modal fade" role="dialog">
  
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
                <input type="text" class="form-control input-lg" name="cliente" id="cliente" autocomplete="off" readonly value="<?php echo $nombreConstructora?>">
               <input type="hidden" id="id_constructora_fac" name="id_constructora_fac" value="<?php echo $idConstructora?>">
                <input type="hidden" id="id_obra_fac" name="id_obra_fac" value="<?php echo $idObra?>">
                <input type="hidden" id="usuario_fac" name="usuario_fac" value="<?php echo $usuario?>">
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
          $crearGuia -> ctrCrearFacturaEEPP();

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





<script src="vistas/js/facturacionEEPP.js?v=<?php echo(rand());?>"></script>

