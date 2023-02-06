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
      
      Aprobación Cambio de Estados
    
    </h1>
    <br>
   
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Aprobación Estados</li>
    
    </ol>

  </section>

  <section class="content">   

     <div class="box">

          <div class="box-body"> 
           <div class="col-lg-12 col-xs-12">       
            <table class="table table-bordered table-striped table-hover dt-responsive tablaAprobarEstados" width="100%">
              
             <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                  
                  <th style="width: 6%;">Código</th> 
                  <th style="width: 25%;">Descripción</th>
                  <th style="width: 10%;">Estado Actual</th>   
                  <th style="width: 10%;">Estado Solicitado</th> 
                  <th style="width: 10%;">Fecha Sol</th> 
                  <th style="width: 30%;">Motivo</th>    
                  <th style="width: 10%;">Solicitante</th>            
                  <th style="width: 5%;">Aprobar</th>
                  <th style="width: 5%;">Rechazar</th>
                </tr>

              </thead>

            </table>           
          </div>
      </div>




    </div>  

 
    
  </section>

</div>


<script src="vistas/js/cambioEstados.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

   
    tablaAprobarEstados();

   });     

  


     

</script>
