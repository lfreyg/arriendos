<?php

$item = null;
$valor = null;
$orden = "id";

$productos = ControladorEquipos::ctrMostrarEquipoDiez($item, $valor);

 ?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Equipos comprados reciente</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php

    for($i = 0; $i < count($productos); $i++){        
     

       $date = date_create($productos[$i]["fecha"]);
       $fechaFactura = date_format($date,"d-M-Y");

      $imagen = "<img src='".$productos[$i]["foto"]."' width='40px'>";

      echo '<li class="item">

        <div class="product-img">'

          .$imagen.

        '</div>

        <div class="product-info">

          

            '.$productos[$i]["tipoequipo"]." ".$productos[$i]["modelo"]." Marca ".$productos[$i]["marca"]." Factura N° ".$productos[$i]["factura"]." el ".$fechaFactura.'

            <span class="label label-warning pull-right">$'.number_format($productos[$i]["precio"],0,"",".").'</span>

          
    
       </div>

      </li>';

    }

    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="facturas-compra-equipos" class="uppercase">Ver todos los productos</a>
  
  </div>

</div>
