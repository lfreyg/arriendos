<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idGuiaDespachoArriendo"])){
  $_SESSION["idGuiaDespachoArriendo"] = $_GET["idGuia"];
  $idGuia = $_GET["idGuia"];
}else{
  $idGuia = $_SESSION["idGuiaDespachoArriendo"];
}

if($_SESSION["idGuiaDespachoArriendo"] == ''){

  echo '<script>

    window.location = "guia-despacho-arriendos";

  </script>';

  return;

}

$guiaDespacho = ModeloGuiaDespacho::mdlMostrarGuiaDespachoDetalle($idGuia);

   
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Detalle Guía Despacho <?php echo $guiaDespacho["guia"]?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="guia-despacho-arriendos">Guía Despacho</a></li>      
      <li class="active">Detalle Guía Despacho </li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-7 col-xs-11">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
        

            <div class="box-body">  
              <div class="box">

          <div class="row"> 
               <div class="col-lg-4 col-xs-11">
                 <div class="form-group">                
                  <div class="input-group">                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <input type="text" class="form-control" id="empresaOperativa" value="<?php echo $guiaDespacho["empresa"]; ?>" readonly>
                  </div>
                </div> 
              </div>
                           
                
            <div class="col-lg-4 col-xs-11">
                <div class="form-group">                
                  <div class="input-group">                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="constructoraGuia" value="<?php echo $guiaDespacho["constructora"];?>" readonly>   
                    <input type="hidden" id="idPedidoGenerado" name="idGuiaGenerado" value="<?php echo $idGuia; ?>">
                  </div>
                </div> 
            </div>    

                
            <div class="col-lg-4 col-xs-11">
                <div class="form-group">                
                  <div class="input-group">                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <input type="text" class="form-control" id="obraPedido" value="<?php echo $guiaDespacho["obra"]; ?>" readonly>
                  </div>
                </div> 
            </div>  
          </div>    

           <div class="row">
               <div class="col-lg-4 col-xs-11">
                 <div class="form-group">                
                  <div class="input-group">                    
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                    <input type="date" class="form-control" id="fechaGuia" value="<?php echo $guiaDespacho["fecha"]; ?>" readonly>
                  </div>
                </div> 
              </div>
           </div>     

                 <hr>            
                <h2>Equipos Guia</h2>
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

                   <div class="col-xs-8" style="padding-right:0px">
                     <div class="form-group">
                    <div class="form-group">   
                    <label>Detalles</label>              
                      <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                        <textarea cols="50" rows="5" id="detalleEquipo"></textarea>
                                        
                     </div>
                   </div> 
                </div>
                  </div>

                  <div class="col-xs-3" style="padding-right:0px">
                   <div class="form-group">
                    <div class="form-group"> 
                     <label>Tipo</label>               
                      <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                         <select class="form-control" id="pedidoTipo" style="width: 100%;" name="pedidoTipo" required> 
                           <option value="<?php echo ARRIENDO?>">ARRIENDO</option>   
                           <option value="<?php echo CAMBIO?>">CAMBIO</option>
                         </select>            
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
             <span class="btn btn-lg btn-success btn-block text-uppercase" id="btnFinalizarPedido">Finalizar Pedido</span>  
            </div>
          </div>

       

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-5 col-xs-11">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

                     <div class="form-group">
                      
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <select class="form-control input-lg select2" id="seleccionaMarcaEquipo" name="seleccionaMarcaEquipo"> 
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
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Marca</th>
                  <th>Descripcion</th>
                  <th>Modelo</th>
                  <th>Acciones</th>
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

               
                 
                   <div class="form-group">
                    <div class="form-group"> 
                     <label>Detalles</label>               
                      <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                         <input type="text" class="form-control" autocomplete="off" id="editaDetalles">
                     </div>
                   </div> 
                </div>

                <div class="form-group">
                    <div class="form-group"> 
                     <label>Tipo</label>               
                      <div class="input-group">                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                         <select class="form-control" id="pedidoTipoEdita" style="width: 100%;" name="pedidoTipoEdita" required> 
                           <option value="<?php echo ARRIENDO?>">ARRIENDO</option>   
                           <option value="<?php echo CAMBIO?>">CAMBIO</option>
                         </select>            
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


<script src="vistas/js/pedidoEquiposDetalle.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){
    
     genera_tabla_compras();

   });     

  


     

</script>