<?php
require_once "../controladores/obras.controlador.php";
require_once "../modelos/obras.modelo.php";
require_once "../modelos/cargaMasivaPrecios.modelo.php";

 
$id = $_GET['id'];

$obrasConstructoras = ModeloCargaMasivaPrecios::mdlObrasConstructora($id);

?>

<form role="form" method="post" id="formdata">

  <input type="checkbox" checked onClick="seleccionaTodosCheck(this)" />Todas las obras
  <br>
  <br>
  <div class="form-group">                      
   <?php if($obrasConstructoras){?>               
  <span class="btn btn-warning" id="btnDescargaConvenio" title="Descargar convenios" onclick="descargaConveniosRealizados('<?php echo $id?>')">Descargar Convenios</span>
  <br>
  <br>
  <?php
            }
      ?>
<table class="table-bordered table-striped table-hover dt-responsive" id="tablasObrasExiste"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>                 
                  <th width="5%">Sel</th>
                  <th width="40%">Obra</th>   
                  <th width="20%">Contacto</th>    
                  <th width="10%">Teléfono</th>
                  <th width="20%">Correo</th> 
                  <th width="5%">Eliminar</th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $obras = ControladorObras::ctrMostrarObrasSeleccion($id);
                               
            for($i = 0; $i < count($obras); $i++){   

              $idObra = $obras[$i]["id"];

              $buscaExistePrecios = ModeloCargaMasivaPrecios::mdlObrasConConvenio($idObra);
              
              if($buscaExistePrecios){
                $checked = '';
              }else{
                $checked = 'checked';
              }

            
            $nombre = $obras[$i]["nombre"];
            $contacto = $obras[$i]["contacto"];
            $telefono = $obras[$i]["telefono"];
            $correo = $obras[$i]["email"];
  ?>
  <tr>
    <td ><div align="center"><input type="checkbox" class="checkBoxGroup" value="<?php echo $idObra?>" name="idObrabox[]" id="idObrabox" <?php echo $checked?>/></div></td>
    <td ><div align="left"><?php echo $nombre?></div></td> 
    <td ><div align="left"><?php echo $contacto?></div></td> 
    <td ><div align="left"><?php echo $telefono?></div></td> 
    <td ><div align="left"><?php echo $correo?></div></td>   
    <td align="center">
      <?php if($buscaExistePrecios){?>      
      <span class="btn btn-danger btn-xs" id="btnEliminarConvenio" title="Eliminar Precios" onclick="ValidaeliminarPrecios('<?php echo $obras[$i]["id"]?>')"><i class='fa fa-th'></i></span>
      <?php
            }
      ?>      

    </td>
    
  </tr>
  <?php
            


            }  

  ?>
   </tbody>
</table>
<br>
<br>
                     
                   


   

</form>


