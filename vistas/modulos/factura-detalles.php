<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idFactura"])){
  $_SESSION["idFactura"] = $_GET["idFactura"];
  $idFactura = $_GET["idFactura"];
}else{
  $idFactura = $_SESSION["idFactura"];
}

if($_SESSION["idFactura"] == ''){

  echo '<script>

    window.location = "facturas_compra_equipos";

  </script>';

  return;

}


$facturas = ModeloFacturasCompra::mdlMostrarFacturasCompra("facturas_compra_equipos","id",$idFactura,"desc");

$idProveedor = $facturas["id_proveedor"];
$proveedor = ModeloProveedores::mdlMostrarProveedores("proveedores","id",$idProveedor);

   $date = date_create($facturas["fecha_factura"]);
   $fechaFactura = date_format($date,"d-M-Y");


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Detalle Factura <?php echo $facturas["numero_factura"]?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="facturas-compra-equipos">Facturas Compra</a></li>      
      <li class="active">Detalle Factura Compra</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-7 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">
  
              <div class="box">

                           
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoProveedorFactura" value="<?php echo $proveedor["nombre"];?>" readonly>

                    <input type="hidden" id="idProveedorFactura" name="idProveedorFactura" value="<?php echo $facturas["id_proveedor"]; ?>">

                    <input type="hidden" id="idFacturaCompra" name="idFacturaCompra" value="<?php echo $idFactura; ?>">

                  </div>

                </div> 

                <div class="form-group">                
                  <div class="input-group">                    
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                    <input type="text" class="form-control" id="nuevoFechaFactura" value="<?php echo $fechaFactura; ?>" readonly>
                  </div>
                </div> 
                 <hr>            

                <div class="form-group">
                    <div class="form-group">                
                      <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                         <input type="text" class="form-control" id="compraDetalleMarca" value="" readonly>                 
                     </div>
                   </div> 
                </div>
                <div class="form-group">
                    <div class="form-group">                
                      <div class="input-group">                    
                       <span class="input-group-addon"><i class="fa fa-th"></i></span>  
                         <input type="text" class="form-control" id="compraDetalleDescripcion" value="" readonly> 
                         <input type="hidden" id="idEquipoDetalle" name="idEquipoDetalle">                
                     </div>
                   </div> 
                </div>
                <div class="form-group">
                    <div class="form-group">                
                      <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                         <input type="text" class="form-control" id="compraDetalleModelo" value="" readonly>                 
                     </div>
                   </div> 
                </div>

                <div class="form-group row"> 
                        <div class="col-xs-4" style="padding-right:0px">
                          <div class="form-group">
                            <div class="form-group">   
                              <label>Serie Equipo</label>              
                                <div class="input-group">                    
                                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                                   <input type="text" class="form-control" autocomplete="off" id="compraDetalleSerie" value="">                 
                               </div>
                             </div> 
                          </div>
                        </div>

                        <div class="col-xs-4" style="padding-right:0px">
                           <div class="form-group">
                              <div class="form-group">   
                                 <label>Código Equipo</label>              
                                   <div class="input-group">                    
                                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                                      <input type="text" class="form-control" autocomplete="off" id="compraDetalleCodigo" value="">                 
                                   </div>
                              </div> 
                            </div>
                        </div>

                        <div class="col-xs-3" style="padding-right:0px">
                           <div class="form-group">
                                  <div class="form-group"> 
                                     <label>Precio Neto Unitario</label>               
                                      <div class="input-group">                    
                                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                                           <input type="number" class="form-control" autocomplete="off" id="compraDetallePrecio" value="">                 
                                     </div>
                                 </div> 
                           </div>
                        </div>
                </div>

                 <div class="form-group row">
                      <div class="col-xs-4" style="padding-right:0px">
                        <div class="form-group">              
                           <div class="form-group">               
                                <label>Sucursal</label>  
                                    <select class="form-control" id="sucursalCompra" name="sucursalCompra" required>
                                      
                                          <option value="">Seleccionar sucursal</option>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    $sucursales = ControladorSucursales::ctrMostrarSucursales($item, $valor);

                                    foreach ($sucursales as $key => $value) {
                                      
                                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                    }

                                    ?>
  
                                        </select>
                              </div>
                          </div> 
                        </div>


                        <div class="col-xs-5" style="padding-right:0px">
                           <div class="form-group">
                                  <div class="form-group"> 
                                     <label>Total Neto Compra</label>               
                                      <div class="input-group">                    
                                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                                           <input type="text" class="form-control bg-warning text-right" id="totalCompra" disabled>                 
                                     </div>
                                 </div> 
                           </div>
                        </div>

                 </div>

                  <div class="pull-right">
                        <button class="btn btn-primary" id="btnAgregarDetalle">Agregar Equipo</button>
                   </div>       
                
                <br/>
                <br/>
                <br/>
                
               <div class="form-group row">
                      <div class="col-xs-11" style="padding-right:0px">
                       <div id="mostrar_tabla_detalles" align="left"></div>
                      </div>
               </div>

              

               
      
              </div>

          </div>

          <div class="box-footer">
            <div class="pull-right">
             <span class="btn btn-lg btn-success btn-block text-uppercase" id="btnFinalizarFactura">Finalizar Factura</span>  
            </div>
          </div>

       

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

                     <div class="form-group">
                      
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <select class="form-control input-lg select2" id="seleccionaMarcaEquipo" name="seleccionaMarcaEquipo" required> 
                         <option value="">Seleccionar Marca</option>              
                          
                          <?php                 

                          $marca = ControladorMarcas::ctrMostrarMarcas(null,null);

                          foreach ($marca as $key => $value) {
                                      
                                      echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                                    }
                                          

                          ?>

                        </select>

                      </div>

                    </div>
            
            <table class="table table-bordered table-striped table-hover dt-responsive tablaEquiposFactura">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>
                  <th>Acciones</th>
                  <th>Marca</th>
                  <th>Descripcion</th>
                  <th>Modelo</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
           

            <!-- ENTRADA PARA RAZON SOCIAL -->            
            
               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="compraDetalleMarcaEdita" id="compraDetalleMarcaEdita" autocomplete="off" readonly>
                  </div>
               </div>  

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="compraDescripcionEdita" id="compraDescripcionEdita" autocomplete="off" readonly>
                     <input type="hidden" id="idEquipoDetalleEdita" name="idEquipoDetalleEdita">
                  </div>
               </div>  

               <div class="form-group row">              
                   <div class="input-group">              
                     <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                     <input type="text" class="form-control input-lg" name="compraModeloEdita" id="compraModeloEdita" autocomplete="off" readonly>
                  </div>
               </div> 

                <div class="form-group row">
                          <div class="col-xs-3" style="padding-right:0px">
                           <div class="form-group">
                            <div class="form-group"> 
                             <label>Precio Neto Compra</label>               
                              <div class="input-group">                    
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                                 <input type="number" class="form-control" autocomplete="off" id="editaDetallePrecio" required>                 
                             </div>
                           </div> 
                        </div>
                          </div>

                          <div class="col-xs-4" style="padding-right:0px">
                             <div class="form-group">
                            <div class="form-group">   
                            <label>Serie Equipo</label>              
                              <div class="input-group">                    
                                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                                 <input type="text" class="form-control" autocomplete="off" id="editaDetalleSerie" required>                 
                             </div>
                           </div> 
                        </div>
                          </div>

                          <div class="col-xs-4" style="padding-right:0px">
                             <div class="form-group">
                            <div class="form-group">   
                            <label>Código Equipo</label>              
                              <div class="input-group">                    
                                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                                 <input type="text" class="form-control" autocomplete="off" required id="editaDetalleCodigo">                 
                             </div>
                           </div> 
                        </div>
                      </div>
                </div>

                <div class="form-group row">
                      <div class="col-xs-6" style="padding-right:0px">
                        <div class="form-group">              
                           <div class="form-group">               
                                <label>Sucursal</label>  
                                    <select class="form-control" id="editaSucursalCompra" name="editaSucursalCompra" required>
                                    <?php

                                    $item = null;
                                    $valor = null;

                                    $sucursales = ControladorSucursales::ctrMostrarSucursales($item, $valor);

                                    foreach ($sucursales as $key => $value) {
                                      
                                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                    }

                                    ?>
  
                                        </select>
                              </div>
                          </div> 
                        </div>


                 </div>


            

  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="button" data-dismiss="modal"  id="btnGuardarEdita" class="btn btn-primary">Guardar Cambios</button>

        </div>


     

    </div>

  </div>

</div>


<script src="vistas/js/facturaDetalles.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){
    
     genera_tabla_compras();

   });     

  


     

</script>