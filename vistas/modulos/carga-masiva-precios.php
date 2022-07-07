<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}



?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Carga Masiva Precios Clientes
    
    </h1>
    <br>
    <h4><strong>Para actualizar precios en convenio.</strong></h4>
    <ul>
      <li>Descargue la plantilla, en el botón DESCARGAR PLANTILLA.</li>
      <li>Ingrese los precios en convenio para el cliente y guarde los cambios. 
      <li>Seleccione el cliente y la o las obras a las cuales realizará el convenio de precios.</li>
      <li>Haga clic en el botón SELECCIONAR ARCHIVO.</li>
      <li>Seleccione el archivo en el cual actualizó los precios en convenio.</li>
      <li>Haga clic en el botón REALIZAR CARGA</li>
    </ul>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Carga Masiva Precios Clientes</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="row">

<div class="col-lg-7 col-xs-11">
   <div class="box-header with-border">
  
      <div class="form-group">
              
              <div class="input-group col-lg-6">
              
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="cmbconstructoraID" name="cmbconstructoraID" required>  

                <option value="">Seleccionar Cliente</option>             
                  
                  <?php                 

                  $cliente = ControladorConstructoras::ctrMostrarConstructorasActivas();

                 foreach ($cliente as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }                  
                          

                  ?>

                </select>

              </div>

            </div>

     

      <div class="box-body">
        
          <div class="form-group row">
                      <div class="col-lg-12" style="padding-right:0px">
                       <div id="obras_seleccionar" align="left"></div>
                      </div>
          </div>

     
           </div>
       </div>

    </div>

     <div class="col-lg-5 col-xs-11">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
                 <div class="form-group">                      
                   <div class="input-group">
                     <button class="btn btn-warning" id="btnDescargaPlantilla">Descargar Plantilla</button>                       
                   </div>
                 </div>

                 <div class="form-group">                      
                   <div class="input-group">
                        <label for="archvioCarga">Cargar Archivo</label>
                        <input type="file" name="archivoCarga" id="archivoCarga">
                   </div>
                 </div>

                 <div class="form-group">                      
                     <div class="input-group">                      
                        <button type="submit" id="btnRealizaCarga" class="btn btn-success">Realizar Carga</button>
                     </div>
                 </div>          
           
         
        </div>

        </div>


    </div>



  </div>
    
  </section>

</div>


<script src="vistas/js/cargaMasivaPrecios.js?v=<?php echo(rand());?>"></script>
