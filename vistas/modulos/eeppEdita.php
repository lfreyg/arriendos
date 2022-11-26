<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

         $_SESSION["idConstructoraEEPP"] = null;
         $_SESSION["idEEPP"] = null; 
         $_SESSION["fechaEEPP"] = null;
         $_SESSION["idObraEEPP"] = null;
         $_SESSION["editaEEPP"] = null

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Editar EEPP
    
    </h1>
    <br>
      
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar EEPP</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="box">

<div class="col-lg-12 col-xs-11">
   <div class="box-header with-border">
  
      <div class="form-group">
             
              <div class="col-lg-2 col-xs-11">                                   
                   
                           <select name="cmbMesEEPP" id="cmbMesEEPP" class="form-control">
                              <?php for($i=1;$i<=12;$i++){
                                     $nombreMes = ControladorEEPP::ctrNombreMeses($i);
                                     if(empty($_SESSION["mesEditaEEPP"])){
                                         $mesAhora = date('m');
                                       }else{
                                        $mesAhora = $_SESSION["mesEditaEEPP"];
                                       }

                                     $select = '';
                                     if($i == $mesAhora){
                                        $select = 'selected';
                                     }
                                     

                              ?>                                
                                <option value="<?php echo $i?>" <?php echo $select?>><?php echo $nombreMes?></option>
                                
                              
                             <?php } ?> 
                           </select>                    
              </div>  

                <div class="col-lg-2 col-xs-11">                                   
                   
                           <select name="CmbAnnoEEPP" id="CmbAnnoEEPP" class="form-control">
                              <?php 
                                     $annoInicio = 2022;
                                     $annoActual = date('Y');
                                for($i=$annoInicio;$i<=$annoActual;$i++){
                                     $select = '';

                                    if(empty($_SESSION["anoEditaEEPP"])){
                                         $annoSel = $annoActual;
                                       }else{
                                        $annoSel = $_SESSION["anoEditaEEPP"];
                                       }


                                     if($i == $annoSel){
                                        $select = 'selected';
                                     }
                              ?>                                
                                <option value="<?php echo $i?>" <?php echo $select?>><?php echo $i?></option>
                                
                              
                             <?php } ?> 
                           </select>                    
              </div>  

                                    

          </div>
       </div>

      <br>
      <br>

     

     <div class="box-body">
           <div class="row"> 
               <div class="col-lg-8 col-xs-11">  
                 <table class="table table-bordered table-striped table-hover dt-responsive tablaEEPPGenerados" width="100%">
                   
                  <thead style="background-color: #ccc;color: black; font-weight: bold;">
                   
                   <tr>                     
                     <th style="width: 30%;">Razón Social</th>           
                     <th style="width: 30%;">Obra</th>
                     <th style="width: 15%;">Fecha Cierre</th>
                     <th style="width: 15%;">Fecha EEPP</th>
                     <th style="width: 5%;">Editar</th>
                     <th style="width: 5%;">PDF</th>
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

   
      $('.tablaEEPPGenerados').DataTable().destroy();

      EEPPGenerados();
      $('.tablaEEPPGenerados').DataTable().ajax.reload();

   });     

  


     

</script>
