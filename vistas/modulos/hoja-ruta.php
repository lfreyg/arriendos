
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
      
      Hoja de Ruta Diaria
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Hoja Ruta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
       
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="60%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>
           
          
           <th style="width:30%">Rut</th>
           <th style="width:60%">Nombre</th>                    
           <th style="width:10%">Hoja</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $choferes = ControladorTransportistas::ctrMostrarTransportista($item, $valor);

          foreach ($choferes as $key => $value) {
           
            echo ' <tr>

                    <td class="text-uppercase">'.$value["rut"].'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>                    
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-success btnHoja" idChofer="'.$value["id"].'">HR</button>   

                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>



<script src="vistas/js/transportista.js?v=<?php echo(rand());?>"></script>