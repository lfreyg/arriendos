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


$archivo = 'vistas/img/firmaReport/firma_'.$idReport.'.png';



$existeArchivo = is_file($archivo);


if($existeArchivo){
  $respuesta = 'El documento ya se encuentra firmado';
}else{
  $respuesta = 'Firme el documento en recuadro, luego haga clic en FIRMAR DOCUMENTO';
}


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
    <h3><strong><?php echo $respuesta?></strong></h3>
    
    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="devolucion-equipos-arriendos">Lista de Report</a></li> 
      <li><a href="devolucion-equipos-arriendos-detalle">Report Devolución</a></li>     
      <li class="active">Firma</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="row">


     <div class="col-lg-6 col-xs-12">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
                                                 
                   <div class="input-group">
                     <canvas id="pizarra"></canvas>  
                     <input type="hidden" id="idReport" name="idReport" value="<?php echo $idReport?>">

                                      
                   </div> 
             
               
                 <div class="form-group">                      
                     <div class="input-group"> 
                     
                       <div class="pull-right-container">                    
                        <button id="btnGuardaFirma" class="btn btn-lg btn-success btn-block text-uppercase">Firmar Documento</button>
                      </div>
                       <br> 

                       <div class="pull-right-container">  
                             <button id="btnVerDocumento" class="btn btn-lg btn-warning btn-block text-uppercase">Ver Documento</button>
                      </div>
                       <br> 
                       
                         <button id="btnVolverFirma" class="btn btn-lg btn-danger btn-block text-uppercase">Volver Report</button>
                       </div>
                     
                 </div> 
              </div>  
                  
                    <?php
                          if($existeArchivo){
                       ?>
                      <div class="box-footer">  
                        <img width="120" height="120" src="<?php echo $archivo?>">  
                      </div>  

                      <?php
                       }

                      ?>       

             
             



                  
           
               
         
        </div>

        </div>


    </div>



  </div>
    
  </section>

</div>


<script src="vistas/js/firma_report.js?v=<?php echo(rand());?>"></script>