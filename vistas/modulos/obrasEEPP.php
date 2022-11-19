
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idObraEEPP'] = '';
$_SESSION["idEEPP"] = '';

if(empty($_SESSION["idConstructoraEEPP"])){
  $_SESSION["idConstructoraEEPP"] = $_GET["idConstructora"];
  $valorIdConstructora = $_GET["idConstructora"];
}else{
  $valorIdConstructora = $_SESSION["idConstructoraEEPP"];
}

date_default_timezone_set('America/Santiago');
$hoy = $_SESSION['fechaEEPP'];


$constructora = ControladorConstructoras::ctrMostrarConstructoras("id",$valorIdConstructora);
$nombreConstructora = $constructora["nombre"];


$dateReg = date_create($hoy);

$periodo = date_format($dateReg,"M-Y");
$fechaEEPP = date_format($dateReg,"d-M-Y");



?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       <?php echo $nombreConstructora.' Periodo '.$periodo.' ('.$fechaEEPP.')'?>   
    </h1>

     

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="eepp">EEPP</a></li>
      
      <li class="active">Obras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">      

      <div class="box-header with-border">
        <button class="btn btn-success" id="btnObraVolverEEPP" >Volver</button>
      </div>

       <div class="box-body">
           <div class="row"> 
               <div class="col-lg-6 col-xs-11">  
                 <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
                   
                  <thead style="background-color: #ccc;color: black; font-weight: bold;">
                   
                   <tr>
                     <th style="width: 60%;">Nombre Obra</th>           
                     <th style="width: 10%;">Vista EEPP</th>
                   </tr> 

                  </thead> 
               <tbody>

        <?php
        
           
           $respuestaObra = ModeloEEPP::mdlMostrarObrasEEPP($valorIdConstructora,$hoy);

            foreach ($respuestaObra as $key => $value) {
           
            echo ' <tr>
                    <td class="text-uppercase">'.$value["nombre"].'</td>';
                    echo '<td><button class="btn btn-success btn-xs btnProcesaEEPP" idObra="'.$value["id"].'">Vista EEPP</button></td>';
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


<script src="vistas/js/eepp.js?v=<?php echo(rand());?>"></script>