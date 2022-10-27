
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


$obra = ControladorObras::ctrMostrarObrasPorId($idObra);
$nombreObra = $obra["nombre"];

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
       <?php echo $nombreObra.' Periodo '.$periodo.' ('.$fechaEEPP.')'?>   
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

      <div class="box-header with-border">
        <button class="btn btn-success" id="btnEquiposVolverEEPP" >Volver</button>
      </div>

       <div class="box-body">  
               <input type="hidden" id="idObra" name="idObra" value="<?php echo $idObra?>"> 
               <input type="hidden" id="fecha" name="fecha" value="<?php echo $hoy?>">          
               <div class="col-lg-12 col-xs-11">  
                    <div id="equipos_cobror" align="left"></div>
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