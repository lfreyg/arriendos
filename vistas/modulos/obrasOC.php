
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idObraOC"] = null;

if(empty($_SESSION["idConstructoraOC"])){
  $_SESSION["idConstructoraOC"] = $_GET["idConstructora"];
  $valorIdConstructora = $_GET["idConstructora"];
}else{
  $valorIdConstructora = $_SESSION["idConstructoraOC"];
}
 

$constructora = ControladorConstructoras::ctrMostrarConstructoras("id",$valorIdConstructora);
$nombreConstructora = $constructora["nombre"];


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       Orden Compra <?php echo $nombreConstructora?>   
    </h1>
        

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="asociar-oc">Asociar OC</a></li>
      
      <li class="active">Obra OC</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">      

      <div class="box-header with-border">
        <button class="btn btn-success" id="btnObraVolverOC" >Volver</button>
      </div>

       <div class="box-body">
           <div class="row"> 
               <div class="col-lg-6 col-xs-11">  
                 <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
                   
                  <thead style="background-color: #ccc;color: black; font-weight: bold;">
                   
                   <tr>
                     <th style="width: 60%;">Nombre Obra</th>           
                     <th style="width: 10%;">Selecciona</th>
                   </tr> 

                  </thead> 
               <tbody>

        <?php
           
           $respuestaObra  = ControladorObras::ctrMostrarObrasSoloConEquiposActivos($valorIdConstructora);
           
          
            foreach ($respuestaObra as $key => $value) {
           
            echo ' <tr>
                    <td class="text-uppercase">'.$value["nombre"].'</td>';
                    echo '<td><button class="btn btn-success btn-xs btnVerOC" idObra="'.$value["id"].'">Seleccionar</button></td>';
             echo '</tr>';
          }
        

        ?>

        </tbody>     

                 </table>
               </div>
            </div>
      </div>

    </div>

  </section>

</div>


<script src="vistas/js/asociar_oc.js?v=<?php echo(rand());?>"></script>