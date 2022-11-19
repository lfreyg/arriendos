
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

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
$periodo = date_format($dateReg,"M-Y");
$fechaEEPP = date_format($dateReg,"d-M-Y");


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       Equipos para cobro en obra   
    </h1>
    <br>
    <h4>      
       <?php echo $nombreObra.' Periodo '.$periodo.' ('.$fechaEEPP.')'.' Tipo Cobro : '.$tipoCobro?>   
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