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
      
      Permiso a Usuarios para Cambio Estado Equipo
    
    </h1>
    <br>
   
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Usuario-Estados</li>
    
    </ol>

  </section>

  <section class="content">   

 <div class="row">

<div class="col-lg-7 col-xs-11">
   <div class="box-header with-border">
  
      <div class="form-group">
              
              <div class="input-group col-lg-6">
              
              <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="cmbUsuarios" name="cmbUsuarios">  

                <option value="">Seleccionar Usuario</option>             
                  
                  <?php                 

                  $usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

                 foreach ($usuarios as $key => $value) { 
                    
                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
                    }                  
                          

                  ?>

                </select>

              </div>

            </div>

     

                  <div class="box-body">
                    
                      <div class="form-group row">
                               <div class="col-lg-12" style="padding-right:0px">                               
                                   <div id="lista_estados" align="left"></div>
                               </div>
                      </div>
                      <br>
                      <br>
                       <div class="form-group row">
                      <div class="col-lg-12" style="padding-right:0px">                        
                       <div id="estados_seleccionado" align="left"></div>
                      </div>
                 </div>

                 
                  </div>
       </div>

    </div>

    

  </div>
    
  </section>

</div>


<script src="vistas/js/usuarios_tipo_estado.js?v=<?php echo(rand());?>"></script>
