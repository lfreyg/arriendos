<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$_SESSION['idFacturaNC'] = null;
$_SESSION['idFacturaND'] = null;
$_SESSION['idND'] = null;

$idEmpresa = 0;
if(isset($_GET["idEmpresa"])){
  $idEmpresa = $_GET["idEmpresa"];
}

$hoy = date('Y-m-d');



?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Nota Crédito - Nota Débito
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">NC - ND</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

    <div class="box-body">

       <div class="row">          
             <div class="col-lg-6 col-xs-11">
                <label for="nuevaEmpresaOperativa">Empresa Operativa</label>
                 <select name="nuevaEmpresaOperativa" id="nuevaEmpresaOperativa" class="form-control">
                              

                  <?php

                  $item = null;
                  $valor = null;
                  $tabla = "empresas_operativas";

                  $empresas = ModeloEmpresasOperativas::mdlMostrarEmpresas($tabla,$item, $valor);

                  echo '<option value="0" selected>Seleccione Empresa</option>';

                  foreach ($empresas as $key => $value) {

                                    if($idEmpresa == $value["id"]){
                                        $select = 'selected';
                                     }
                    
                    echo '<option value="'.$value["id"].'"'.$select.'>'.$value["razon_social"].'</option>';
                  }

                  ?>
  
                </select>               

              </div>

            </div>
            <br>
            <br>
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablaFacturaNCND" width="100%">
         
        <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>                      
           <th>Empresa</th>
           <th>N° Factura</th> 
           <th>Fecha Factura</th> 
           <th>Neto</th>   
           <th>Rut</th>      
           <th>Razón Social</th>
           <th>Destino</th>            
           <th>Estado</th>
           <th>NC</th>
           <th>ND</th>
           
         </tr> 

        </thead>      

       </table>

     
      </div>

    </div>

  </section>

</div>





<script src="vistas/js/facturaNCND.js?v=<?php echo(rand());?>"></script>

<script type="text/javascript">
  
  
  
  $(document).ready(function(){

   
     id = $('#nuevaEmpresaOperativa').val();
        
      $('.tablaFacturaNCND').DataTable().destroy();

      recargaTablaFacturaNCND(id);
      $('.tablaFacturaNCND').DataTable().ajax.reload();

   });     

  


     

</script>