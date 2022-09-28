<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idReportDevolucion"])){
  $_SESSION["idReportDevolucion"] = $_GET["idReport"];
  $idReport = $_GET["idReport"];
}else{
  $idReport = $_SESSION["idReportDevolucion"];
}

if($_SESSION["idReportDevolucion"] == ''){

  echo '<script>

    window.location = "validacion-equipos-retiro";

  </script>';

  return;

}

$hoy = date('Y-m-d');

$report = ModeloReportDevolucionDetalles::mdlMostrarReportDevolucionDetalle($idReport);


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Report Devolución N° <?php echo $report["numReport"]?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="validacion-equipos-retiro">Lista de Report</a></li>      
      <li class="active">Report Devolución </li>
    
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
      ENCABEZADO REPORT
      ======================================-->            
                           
           <div class="row">          
         
            <div class="col-lg-5 col-xs-11">                                    
                    <label for="constructora">Cliente</label>
                    <input type="text" class="form-control" id="constructora" value="<?php echo $report["constructora"]?>" readonly> 
                    <input type="hidden" id="idConstructora" name="idConstructora" value="<?php echo $report["idConstructora"]?>">  
                    <input type="hidden" id="idReport" name="idReport" value="<?php echo $report["numReport"]?>"> 
                    <input type="hidden" id="idEstadoReport" name="idEstadoReport" value="<?php echo $report["estado"]?>"> 
                                   
            </div>    

                
            <div class="col-lg-5 col-xs-11">
                                   
                     <label for="obraPedido">Obra</label> 
                    <input type="text" class="form-control" id="obra" value="<?php echo $report["obra"]?>" readonly> 
                    <input type="hidden" id="idObra" name="idObra" value="<?php echo $report["idObra"]?>">                
            </div>  
          </div>  
          <br>  
           

      <!--=====================================
      DETALLE EQUIPOS REPORT
      ======================================-->      
                
               

            <!--=====================================
            DETALLE EQUIPOS DEVOLUCIÓN
            ======================================--> 

                 
                
           <br>
                
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
             <button class="btn btn-lg btn-success btn-block text-uppercase" id="btnFinalizarReport">VER  REPORT</button>  
            </div>
          </div>

       

        </div>
            
      </div>



    </div>
   
  </section>

</div>


<script src="vistas/js/validarReportDevolucionDetalle.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

     genera_tabla_validacion();

   });     

  


     

</script>