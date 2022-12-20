
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

        
  $_SESSION["idObraFacturar"] = null;
  $valorIdConstructora = $_GET["idConstructora"];





$constructora = ControladorConstructoras::ctrMostrarConstructoras("id",$valorIdConstructora);
$nombreConstructora = $constructora["nombre"];


?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>      
       Facturar Obras de <?php echo $nombreConstructora?>   
    </h1>
        

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="factura-eepp-constructora">Facturar EEPP</a></li>
      
      <li class="active">Obras Facturar</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">      

      <div class="box-header with-border">
        <button class="btn btn-success" id="btnObraVolverFacturacion" >Volver</button>
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
        
           
           $respuestaObra = ControladorFacturacion::ctrMostrarObrasFactura($valorIdConstructora);

            foreach ($respuestaObra as $key => $value) {
           
            echo ' <tr>
                    <td class="text-uppercase">'.$value["nombre"].'</td>';
                    echo '<td><button class="btn btn-success btn-xs btnVerEEPPFacturar" idObra="'.$value["id"].'">Seleccionar</button></td>';
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


<script src="vistas/js/facturacionEEPP.js?v=<?php echo(rand());?>"></script>