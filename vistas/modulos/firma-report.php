<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if($_SESSION["idReportDevolucion"] == ''){

  echo '<script>

    window.location = "devolucion-equipos-arriendos";

  </script>';

  return;

}

$idReport = $_SESSION["idReportDevolucion"];

$archivo = 'http://localhost/arriendos/vistas/img/firmaReport/firma_'.$idReport.'.png';



$existeArchivo = is_file($archivo);


?>

<style>
    canvas {
        width: 300px;
        height: 300px;
        background-color: #FFFF00;
    } 
</style>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
    Firmar Documento N° <?php echo $idReport?>
    
    </h1>
    
    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="devolucion-equipos-arriendos">Lista de Report</a></li> 
      <li><a href="devolucion-equipos-arriendos-detalle">Report Devolución</a></li>     
      <li class="active">Firma</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="row">


     <div class="col-lg-4 col-xs-6">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
                                                 
                   <div class="input-group">
                     <canvas id="pizarra"></canvas>  
                     <input type="hidden" id="idReport" name="idReport" value="<?php echo $idReport?>">                      
                   </div>                 
                
             
               
                 <div class="form-group">                      
                     <div class="input-group"> 
                      <div class="col">                     
                        <button type="submit" id="btnGuardaFirma" class="btn btn-success">Firmar Documento</button>

                        <button type="submit" id="btnVerDocumento" class="btn btn-warning">Ver Documento</button>
                       
                         <button type="submit" id="btnVolverFirma" class="btn btn-danger">Volver Report</button>
                       </div>
                     </div>
                 </div> 
              </div>   
             
              <img src="<?php echo $archivo?>">  

                  
           
               
         
        </div>

        </div>


    </div>



  </div>
    
  </section>

</div>


<script src="vistas/js/firma_report.js?v=<?php echo(rand());?>"></script>