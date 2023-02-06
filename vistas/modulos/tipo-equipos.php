
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

if(empty($_SESSION["idCategoria"])){
  $_SESSION["idCategoria"] = $_GET["idCategoria"];
  $valoridCategoria = $_GET["idCategoria"];
}else{
  $valoridCategoria = $_SESSION["idCategoria"];
}

$categorias = ControladorCategorias::ctrMostrarCategorias("id",$valoridCategoria);
$nombreCategoria = $categorias["categoria"];

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      <?php
         echo strtoupper($nombreCategoria);
         ?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar tipo de equipos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoTipo" data-toggle="modal" data-target="#modalAgregarTipoEquipo">
          
          Agregar Tipo Equipo

        </button>

        <button class="btn btn-success" id="btnTipoEquipoVolver" >
          
          
          Volver

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
         
       <thead style="background-color: #ccc;color: black; font-weight: bold;">
         
         <tr>          
          
           <th>Marca</th>  
           <th>Modelo</th> 
           <th>Descripción</th>   
           <th>Meses Garantia</th>
           <th>Meses Vida</th>
           <th>Precio</th>         
           <th>Foto</th>   
           <th>Estado</th>        
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $tipoEquipos = ModeloTipoEquipos::mdlMostrarTipoEquiposIdCategoria("nombre_equipos", "id_categoria", $valoridCategoria, "ASC");

       foreach ($tipoEquipos as $key => $value){
            $idMarca = $value["id_marca"];
            $marca = ModeloMarcas::mdlMostrarMarcas("marcas","id",$idMarca);
                   
          echo ' <tr>   
                  <td>'.$marca["descripcion"].'</td>  
                  <td>'.$value["modelo"].'</td>            
                  <td>'.$value["descripcion"].'</td>
                  <td>'.$value["meses_garantia"].'</td>
                  <td>'.$value["vida_util"].'</td>';
          echo '  <td>'.number_format($value["precio"],0,',','.').'</td>';                  

                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }

                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivarTipoEquipo" idTipoEquipo="'.$value["id"].'" estadoTipo="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivarTipoEquipo" idTipoEquipo="'.$value["id"].'" estadoTipo="1">Desactivado</button></td>';

                  }          

                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarTipoEquipo" idTipoEquipo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarTipoEquipo"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarTipoEquipo" idTipoEquipo="'.$value["id"].'" fotoEquipo="'.$value["foto"].'"><i class="fa fa-times"></i></button>

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

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarTipoEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tipo de Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoCategoriaEquipo" name="nuevoCategoriaEquipo">               
                  
                  <?php                 

                  $categoria = ControladorCategorias::ctrMostrarCategorias("id", $valoridCategoria);

                 
                    
                    echo '<option value="'.$categoria["id"].'">'.strtoupper($categoria["categoria"]).'</option>';
                                  

                  ?>

                </select>

              </div>

            </div>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoMarcaEquipo" name="nuevoMarcaEquipo" required> 
                 <option value="">Seleccionar Marca</option>              
                  
                  <?php                 

                  $marca = ControladorMarcas::ctrMostrarMarcas(null,null);

                  foreach ($marca as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                            }
                                  

                  ?>

                </select>

              </div>

            </div>

             

            <!-- ENTRADA PARA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" autocomplete="off" placeholder="Ingresar descripción" value="<?=$nombreCategoria?>" required>

              </div>

            </div>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" autocomplete="off" placeholder="Ingresar Modelo" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevogarantia" autocomplete="off" placeholder="Meses Garantia" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoVida" autocomplete="off" placeholder="Meses Vida Util" required>

              </div>

            </div>

          

            <!-- ENTRADA PARA PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoPrecio" autocomplete="off" placeholder="Precio Arriendo" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Tipo</button>

        </div>

        <?php

          $crearUsuario = new ControladorTipoEquipos();
          $crearUsuario -> ctrCrearTipoEquipo();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarTipoEquipo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tipo Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <p class="help-block">Marca Equipo</p>
                <select class="form-control input-lg" id="editarMarcaEquipo" name="editarMarcaEquipo" required>  
                  <?php                 

                  $marca = ControladorMarcas::ctrMostrarMarcas(null,null);

                  foreach ($marca as $key => $value) {
                              
                              echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                            }
                                  

                  ?>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <p class="help-block">Descripción</p>
                <input type="text" class="form-control input-lg" id="editarNombre" placeholder="Descripción" autocomplete="off" name="editarNombre" value="" required>
                <input type="hidden" id="idTipo" name="idTipo">              

              </div>

            </div> 

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <p class="help-block">Modelo</p>
                <input type="text" class="form-control input-lg" id="editarModelo" placeholder="Modelo" autocomplete="off" name="editarModelo" value="" required>
              </div>

            </div> 

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <p class="help-block">Meses Garantia</p>
                <input type="number" class="form-control input-lg" id="editarGarantia" placeholder="Meses Garantia" autocomplete="off" name="editarGarantia" value="" required>
              </div>

            </div> 

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <p class="help-block">Meses Vida Util</p>
                <input type="number" class="form-control input-lg" id="editarVida" name="editarVida" autocomplete="off" placeholder="Meses Vida Util" required>

              </div>

            </div>

            

             <!-- ENTRADA PARA PRECIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                <p class="help-block">Precio</p>
                <input type="number" class="form-control input-lg" name="editarPrecio" id="editarPrecio" autocomplete="off" placeholder="Precio Arriendo">

              </div>

            </div>       
                                 

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

     <?php

          $editarUsuario = new ControladorTipoEquipos();
          $editarUsuario -> ctrEditarTipoEquipo();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarUsuario = new ControladorTipoEquipos();
  $borrarUsuario -> ctrBorrarTipoEquipo();

?> 


