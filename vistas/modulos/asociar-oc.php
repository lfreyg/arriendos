<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idConstructoraOC"] = null;
$_SESSION["idObraOC"] = null;


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
    Asociar Orden Compra
    
    </h1>
    <br>
  
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Asociar OC</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="box">

<div class="col-lg-12 col-xs-11">
     <div class="box-body">
           <div class="row"> 
               <div class="col-lg-8 col-xs-11">  
                 <table class="table table-bordered table-striped table-hover dt-responsive constructorasArriendosOC" width="100%">
                   
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


<script src="vistas/js/asociar_oc.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

       $('.constructorasArriendosOC').DataTable().destroy();

      llenaConstrutoraOC();
      $('.constructorasArriendosOC').DataTable().ajax.reload();

    
     

   });     

  


     

</script>
