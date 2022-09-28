<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$hoy = date('Y-m-d');

$_SESSION['idReportDevolucion'] = '';

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Validación equipos retirados de obra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Validación equipos retirados</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaReportDevolucion" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           <th>N° Report</th> 
           <th>Fecha Report</th>          
           <th>Cliente</th>
           <th>Obra</th> 
           <th>Adjunto</th>
           <th>Retira</th>
           <th>Acciones</th>           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>



<script src="vistas/js/validarReportDevolucion.js?v=<?php echo(rand());?>"></script>