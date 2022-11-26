
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION["idEEPP"] = null; 

if(empty($_SESSION["idObraEEPP"])){
  $_SESSION["idObraEEPP"] = $_GET["idObra"];
  $idObra = $_GET["idObra"];
}else{
  $idObra = $_SESSION["idObraEEPP"];
}

date_default_timezone_set('America/Santiago');
$hoy = $_SESSION['fechaEEPP'];
$idConstructora = $_SESSION['idConstructoraEEPP'];


$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];
$tipoCobro = $obra["tipoCobro"];




$dateReg = date_create($hoy);
$mes = date_format($dateReg,"m");
$anno = date_format($dateReg,"Y");
$nombreMes = ControladorEEPP::ctrNombreMeses($mes);
$periodo = $nombreMes.'-'.$anno;
$fechaEEPP = date_format($dateReg,"d-m-Y");


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       Equipos para cobro en obra<?php echo ' '.$nombreObra?>   
    </h1>
    <br>
    <h4>      
       <?php echo 'Periodo '.$periodo.' ('.$fechaEEPP.')'.' Tipo Cobro : '.$tipoCobro?>   
    </h4>

     

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="eepp">EEPP</a></li>

      <li class="obrasEEPP">Obras</li>
      
      <li class="active">Equipos EEPP</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box"> 
     
            <div class="form-row align-items-center">
              <div class="box-header with-border">
                 <div class="col-auto">
                   <button class="btn btn-success" id="btnEquiposVolverEEPP" >Volver</button>

                   <button class="btn btn-primary" id="btnEquiposProcesarEEPP" >GENERAR PRESENTE EEPP</button>
                 </div>
              </div>
             </div> 

              
               <div class="box-body">  
                       <input type="hidden" id="idObra" name="idObra" value="<?php echo $idObra?>"> 
                       <input type="hidden" id="fecha" name="fecha" value="<?php echo $hoy?>">
                       <input type="hidden" id="idConstructora" name="idConstructora" value="<?php echo $idConstructora?>"> 
                       <input type="hidden" id="tipoCobroEEPP" name="fecha" value="<?php echo $tipoCobro?>">            
                       <div class="col-lg-12 col-xs-11">  
                            <div id="equipos_cobro" align="left"></div>
                       </div>           
              </div>
               

    </div>

  </section>

</div>


<script src="vistas/js/eepp.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript"> 
  
  
  $(document).ready(function(){

    idObra = $('#idObra').val(); 
    fecha = $('#fecha').val(); 
    genera_tabla_cobro(idObra, fecha);
   

   });     

  


     

</script>