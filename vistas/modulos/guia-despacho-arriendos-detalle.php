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

$hoy = date('Y-m-d');

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

      <!--=====================================
      ENCABEZADO GUIA DESPACHO
      ======================================-->       

          <div class="row"> 
               <div class="col-lg-5 col-xs-11">  
                     <label for="empresaOperativa">Empresa</label> 
                    <input type="text" class="form-control" id="empresaOperativa" value="<?php echo $guiaDespacho["empresa"]?>" readonly> 
                    <input type="hidden" id="idGuiaGenerado" name="idGuiaGenerado" value="<?php echo $idGuia?>">
                    <input type="hidden" id="estadoGuia" name="estadoGuia" value="<?php echo $guiaDespacho["estadoGuia"]?>"> 
                    <input type="hidden" id="idEmpresaOperativa" name="idEmpresaOperativa" value="<?php echo $guiaDespacho["idEmpresa"]?>">                 
                
              </div>

               <div class="col-lg-2 col-xs-11">                                   
                     <label for="fechaGuia">Fecha Guía</label> 
                    <input type="date" class="form-control" id="fechaGuia" value="<?php echo $guiaDespacho["fecha"]?>" readonly>                  
              </div>

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="ordenCompra">Orden Compra</label> 
                    <input type="text" class="form-control" id="ordenCompra" value="<?php echo $guiaDespacho["oc"]?>" readonly>                  
              </div>            

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="fechaTerminoGuia">Fecha Termino</label> 
                    <input type="date" class="form-control" id="fechaTerminoGuia" value="<?php echo $guiaDespacho["fechaTermino"]?>" readonly>                  
              </div>
              
          </div> 
          <br>   
                           
           <div class="row"> 
            
            <div class="col-lg-2 col-xs-11">                                    
                    <label for="rutConstructoraGuia">Rut Cliente</label>
                    <input type="text" class="form-control" id="rutConstructoraGuia" value="<?php echo str_replace(".","",$guiaDespacho["rutConstructora"])?>" readonly> 
                    <input type="hidden" id="idConstructora" name="idConstructora" value="<?php echo $guiaDespacho["idConstructora"]?>">
                                   
            </div> 


            <div class="col-lg-5 col-xs-11">                                    
                    <label for="constructoraGuia">Cliente</label>
                    <input type="text" class="form-control" id="constructoraGuia" value="<?php echo $guiaDespacho["constructora"]?>" readonly>   
                                   
            </div>    

                
            <div class="col-lg-5 col-xs-11">
                                   
                     <label for="obraPedido">Destino</label> 
                    <input type="text" class="form-control" id="obraPedido" value="<?php echo $guiaDespacho["obra"]?>" readonly> 
                    <input type="hidden" id="idObra" name="idObra" value="<?php echo $guiaDespacho["idObra"]?>">                
            </div>  
          </div>  
          <br>  

           <div class="row">
              

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="transporteGuia">Transporte</label> 
                    <input type="text" class="form-control" id="transporteGuia" value="<?php echo $guiaDespacho["rutTransporte"]?>" readonly>                  
              </div>

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="patenteGuia">Patente</label> 
                    <input type="text" class="form-control" id="patenteGuia" value="<?php echo $guiaDespacho["patente"]?>" readonly>                  
              </div>

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="rutChoferGuia">Rut Chofer</label> 
                    <input type="text" class="form-control" id="rutChoferGuia" value="<?php echo $guiaDespacho["rutChofer"]?>" readonly>                  
              </div>

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="choferGuia">Nombre Chofer</label> 
                    <input type="text" class="form-control" id="choferGuia" value="<?php echo $guiaDespacho["chofer"]?>" readonly>                  
              </div>


           </div> 

      <!--=====================================
      DETALLE EQUIPOS GUIA DESPACHO
      ======================================-->       

                 <hr>            
                <h2>Equipos en esta Guía</h2>

          <div class="row">             

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="codigoEquipo">Código</label> 
                    <input type="text" class="form-control" id="codigoEquipo" value="" readonly>
                     <input type="hidden" id="idEquipoDetalle" name="idEquipoDetalle">                  
              </div>

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="codigoEquipo">Serie</label> 
                    <input type="text" class="form-control" id="serieEquipo" value="" readonly>                  
              </div>

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="descripcionEquipo">Descripción</label> 
                    <input type="text" class="form-control" id="descripcionEquipo" value="" readonly>                  
              </div>

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="modeloEquipo">Modelo</label> 
                    <input type="text" class="form-control" id="modeloEquipo" value="" readonly>                  
              </div>              

           </div> 

           <br>

            <!--=====================================
            PRECIO Y DETALLE EQUIPOS GUIA DESPACHO
            ======================================--> 

            <div class="row">    

             <div class="col-lg-2 col-xs-11">                                   
                     <label for="precioEquipo">Precio</label> 
                    <input type="text" class="form-control" id="precioEquipo" value="" readonly>
                    <input type="hidden" class="form-control" id="precioEquipoSinFormato" readonly>                  
              </div> 

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="fechaArriendo">Fecha Arriendo</label> 
                    <input type="date" class="form-control" id="fechaArriendo" value="<?php echo $hoy?>">                  
              </div>           

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="guiaTipoMovimiento">Movimiento</label> 
                    <select class="form-control" id="guiaTipoMovimiento" style="width: 100%;" name="guiaTipoMovimiento" required>
                           <option value="<?php echo ARRIENDO?>">ARRIENDO</option>   
                           <option value="<?php echo CAMBIO?>">CAMBIO</option>
                     </select>                    
              </div>

              <div class="col-lg-6 col-xs-11">                                   
                     <label for="detalleEquipo">Detalle</label> 
                    <input type="text" class="form-control" id="detalleEquipo" value="">                  
              </div>
                            

           </div>               
                
           <br>

                  <div class="pull-right">

                        <button class="btn btn-primary" id="btnAgregarEquipo">Agregar Equipo</button>
            
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
             <div class="pull-right-container">
             <button class="btn btn-lg btn-warning btn-block text-uppercase" id="btnVolver">Volver a Lista</button> 
             </div> 
             <br>   
              <div class="pull-right-container">       
             <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnFinalizarGuia">Enviar a SII</button>  
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

                        <select class="form-control input-lg select2" id="seleccionaTipoEquipo" name="seleccionaTipoEquipo"> 
                         <option value="">Seleccionar Tipo de Equipo</option>              
                          
                          <?php                 

                          $marca = ControladorTipoEquipos::ctrMostrarTipoEquipo(null,null);

                          foreach ($marca as $key => $value) {
                                      
                                      echo '<option value="'.$value["id"].'">'.$value["descripcion"]." ".$value["modelo"].'</option>';
                                    }
                                          

                          ?>

                        </select>

                      </div>

                    </div>
            
            <table class="table table-bordered table-striped table-hover dt-responsive tablaEquiposGuia">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                  
                  <th>Código</th>                  
                  <th>Descripcion</th>
                  <th>Selección</th>
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
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

     

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Arriendo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div class="row">             

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="ecodigoEquipo">Código</label> 
                    <input type="text" class="form-control" id="ecodigoEquipo" value="" readonly>
                     <input type="hidden" id="eidArriendo" name="eidArriendo">                  
              </div>


              <div class="col-lg-6 col-xs-11">                                   
                     <label for="edescripcionEquipo">Descripción</label> 
                    <input type="text" class="form-control" id="edescripcionEquipo" value="" readonly>                  
              </div>                            

           </div> 

           <br>

            <!--=====================================
            PRECIO Y DETALLE EQUIPOS GUIA DESPACHO
            ======================================--> 

            <div class="row">   


              <div class="col-lg-2 col-xs-11">                                   
                     <label for="efechaArriendo">Fecha Arriendo</label> 
                    <input type="date" class="form-control" id="efechaArriendo">                  
              </div>           

              <div class="col-lg-2 col-xs-11">                                   
                     <label for="eguiaTipoMovimiento">Movimiento</label> 
                    <select class="form-control" id="eguiaTipoMovimiento" style="width: 100%;" name="eguiaTipoMovimiento" required>
                           <option value="<?php echo ARRIENDO?>">ARRIENDO</option>   
                           <option value="<?php echo CAMBIO?>">CAMBIO</option>
                     </select>                    
              </div>

              <div class="col-lg-7 col-xs-11">                                   
                     <label for="edetalleEquipo">Detalle</label> 
                    <input type="text" class="form-control" autocomplete="off" id="edetalleEquipo" value="">                  
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


<script src="vistas/js/guiaDespachoDetalle.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

     if($('#estadoGuia').val() == 13){
        $('#btnFinalizarGuia').attr('disabled', true)


     }
    
     genera_tabla_arriendos();

   });     

  


     

</script>