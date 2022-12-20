<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idObraFacturar"] = null;

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Facturar EEPP
    
    </h1>
    <br>
       
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Facturar EEPP</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="row">

<div class="col-lg-12 col-xs-11">
     <div class="box-body">
           <div class="row"> 
               <div class="col-lg-6 col-xs-11">  
                 <table class="table table-bordered table-striped table-hover dt-responsive constructorasFacturacion" width="100%">
                   
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


<script src="vistas/js/facturacionEEPP.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

   
         $('.constructorasFacturacion').DataTable().destroy();

      llenaConstructoraFacturacionEEPP();
      $('.constructorasFacturacion').DataTable().ajax.reload();

   }); 
       

  


     

</script>
