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
      
     Carga Masiva Precios Lista
    
    </h1>
    <br>
    <h4><strong>Para actualizar precios de listas.</strong></h4>
    <ul>
      <li>Descargue la plantilla, en el botón DESCARGAR PLANTILLA.</li>
      <li>Ingrese los precios nuevos de lista y guarde los cambios del archivo.      
      <li>Haga clic en el botón SELECCIONAR ARCHIVO.</li>
      <li>Seleccione el archivo en el cual actualizó los precios.</li>
      <li>Haga clic en el botón REALIZAR CARGA</li>
    </ul>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Carga Masiva Precios Lista</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="row">


     <div class="col-lg-5 col-xs-11">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
              <div class="col-lg-5">
                 <div class="form-group">                      
                   <div class="input-group">
                     <button class="btn btn-warning" id="btnDescargaPlantilla">Descargar Plantilla</button>                       
                   </div>
                 </div>
               </div>    
             
               <div class="col-lg-5">
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



  </div>
    
  </section>

</div>


<script src="vistas/js/cargaMasivaPreciosLista.js?v=<?php echo(rand());?>"></script>
