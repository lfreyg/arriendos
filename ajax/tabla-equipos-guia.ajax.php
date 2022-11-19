<?php

require_once "../modelos/guiaDespachoDetalles.modelo.php";

$idGuia = $_POST['id'];

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo4 {font-size: 14px; }
-->
</style>
</head>

<body>
<table class="table-bordered table-striped table-hover dt-responsive" width="100%" id="tablaCompraDespliega"> 
   <thead style="background-color: #ccc;color: black; font-weight: bold;">

                 <tr>   
                  <th><div align="center">Código</div></th>              
                  <th><div align="center">Equipo</div></th>
                  <th><div align="center">precio</div></th>
                  <th><div align="center">Fecha</div></th>
                  <th><div align="center">Mov/Cant</div></th>                                    
                  <th><div align="center">Acciones</div></th>
                </tr>

    </thead>
     <tbody>
   
  <?php
            
            $productos = ModeloGuiaDespachoDetalles::mdlGuiaDespachoPorId($idGuia);


         foreach ($productos as $key => $value){



           $codigo = $value["codigo"];
           $equipo = $value["equipo"];
           $modelo = $value["modelo"];
           $marca = $value["marca"];
           $precio = $value["precio"];          
           $movimiento = $value["movimiento"];
           $guia = $value["guia"];

           $dateReg = date_create($value["fecha"]);
           $fecha = date_format($dateReg,"d-m-Y");
           
           $disabled = '';
           $disabled_valida = "";


           if($value["devuelto"] == 1){
              $disabled = "disabled";
              $disabled_valida = "disabled";
             
           }

           if($value["validado"] == 0){
              $disabled = "disabled";
           }

            if($value["match_cambio"] != null){
              $disabled = "disabled";
              $disabled_valida = "disabled";
           }

           if($guia == null){
            $disabled_valida = "disabled";
           }
           


           $arriendo = $equipo." ".$modelo." ".$marca;

           $precio = "$ " . number_format($precio,0,"",".")
            
  ?>
  <tr>
    <td ><div align="left"><?php echo $codigo?></div></td>
    <td ><div align="left"><?php echo $arriendo?></div></td>
    <td ><div align="right"><?php echo $precio?></div></td>  
    <td ><div align="center"><?php echo $fecha?></div></td>  
    <td ><div align="left"><?php echo $movimiento?></div></td>  

       
    <td align="center" nowrap=""><span class="btn btn-warning btn-xm" title="Editar" onclick="editar('<?php echo $value["idRegistro"]?>')">E</span>
      <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsulta('<?php echo $value["idRegistro"]?>','<?php echo $value["idEquipo"]?>')">X</button>
      <?php
      if($value["validado"] == 1) {
      ?>  
           <button class="btn btn-success btn-xm" title="Validar Entrega" <?php echo $disabled_valida?> onclick="validarEquipoRecepcionado('<?php echo $value["idRegistro"]?>','<?php echo $value["idEquipo"]?>')">V</button>
      <?php
      }else{
      ?>
          <button class="btn btn-info btn-xm" title="Quitar Validación entrega" <?php echo $disabled_valida?> onclick="quitarvalidarEquipoRecepcionado('<?php echo $value["idRegistro"]?>','<?php echo $value["idEquipo"]?>')">OK</button>
       <?php
      }     
      ?>

    </td>
      
  </tr>
  <?php
            


            }  

               $materiales = ModeloGuiaDespachoDetalles::mdlMaterialesGuiaDespacho($idGuia);


                   foreach ($materiales as $key => $value){

                     $idRegistroMaterial = $value["idRegistro"];
                     $idMaterial = $value["idMaterial"];
                     $codigoMaterial = $value["codigoMaterial"];
                     $material = $value["material"];
                     $precioMaterial = $value["precioMaterial"];          
                     $cantidad = number_format($value["cantidad"],0,"",".");
                     $precioMaterial = "$ " . number_format($precioMaterial,0,"",".");
                     $seCobra = $value["cobro"];
                     $guia = $value["guia"];
                     $cobro = '';

                     if($seCobra == 1){
                       $cobro = ' (Cobro)';                       
                     }else{
                       $precioMaterial = '$ 1';
                     }



                     $dateReg = date_create($value["fecha"]);
                     $fechaMaterial = date_format($dateReg,"d-m-Y");
                     
                     $disabled = '';
                     $disabled_valida = '';

                     if($value["eepp"] != null){
                      $disabled = "disabled";
                     }
                     
                     if($value["validado"] == 0){
                        $disabled = "disabled";
                     }

                     if($guia == null){
                      $disabled_valida = "disabled";
                     }

                     $estilo = 'style="background-color: rgb(102, 255, 153)"';

                             
  ?>

              <tr >
                  <td <?php echo $estilo?>><div align="left"><?php echo $codigoMaterial?></div></td <?php echo $estilo?>>
                  <td <?php echo $estilo?>><div align="left"><?php echo $material.$cobro?></div></td>
                  <td <?php echo $estilo?>><div align="right"><?php echo $precioMaterial?></div></td>  
                  <td <?php echo $estilo?>><div align="center"><?php echo $fechaMaterial?></div></td>  
                  <td <?php echo $estilo?>><div align="center"><?php echo $cantidad?></div></td>  

                     
                  <td align="center" nowrap=""><button class="btn btn-warning btn-xm" title="Editar" onclick="editarMaterialGuia('<?php echo $idRegistroMaterial?>')">E</button>
                    <button class="btn btn-danger btn-xm" title="Eliminar" <?php echo $disabled?> onclick="eliminarConsultaMaterial('<?php echo $idRegistroMaterial?>','<?php echo $value["idMaterial"]?>')">X</button>
                    <?php
                    if($value["validado"] == 1) {
                    ?>  
                         <button class="btn btn-success btn-xm" title="Validar Entrega" <?php echo $disabled_valida?> onclick="validarMaterialRecepcionado('<?php echo $idRegistroMaterial?>')">V</button>
                    <?php
                    }else{
                    ?>
                        <button class="btn btn-info btn-xm" title="Quitar Validación entrega" <?php echo $disabled_valida?> onclick="quitarvalidarMaterialRecepcionado('<?php echo $idRegistroMaterial?>')">OK</button>
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
</body>
</html>
