<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idConstructoraEEPP"] = null;

if(empty($_SESSION["fechaEEPP"])){
  $hoy = date('Y-m-d');
}else{
  $hoy = $_SESSION['fechaEEPP'];
}


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Generar EEPP
    
    </h1>
    <br>
    <h4><strong>Para generar EEPP, debe seleccionar la fecha de corte</strong></h4>
    
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">EEPP</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="box">

<div class="col-lg-12 col-xs-11">
   <div class="box-header with-border">
  
      <div class="form-group">
             
              <div class="col-lg-2 col-xs-11">                                   
                   
                    <input type="date" class="form-control" id="fechaCorte" value="<?php echo $hoy?>" >                  
              </div>              

          </div>
       </div>

      <br>
      <br>

     

     <div class="box-body">
           <div class="row"> 
               <div class="col-lg-5 col-xs-11">  
                 <table class="table table-bordered table-striped table-hover dt-responsive constructorasDisponibles" width="100%">
                   
                  <thead style="background-color: #ccc;color: black; font-weight: bold;">
                   
                   <tr>
                     
                     <th style="width: 30%;">Rut</th>  
                     <th style="width: 60%;">Razón Social</th>           
                     <th style="width: 10%;">Seleccionar</th>
                     
                     
                   </tr> 

                  </thead>      

                 </table>
               </div>
            </div>
      </div>





      

    </div>

     



  </div>
    
  </section>

</div>


<script src="vistas/js/eepp.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

    fecha = $('#fechaCorte').val(); 
         $('.constructorasDisponibles').DataTable().destroy();

      llenaClientesEEPP(fecha);
      $('.constructorasDisponibles').DataTable().ajax.reload();

   });     

  


     

</script>
