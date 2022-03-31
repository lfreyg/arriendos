<?php
require_once "../controladores/constructoras.controlador.php";
require_once "../modelos/constructoras.modelo.php";

            
  $cliente = ControladorConstructoras::ctrMostrarConstructorasActivas();
                               
            
  
   $HTML='<select class="form-control input-lg select2" id="comboConstructora" style="width: 100%;" name="comboConstructora" required>';
                  
   $HTML.='<option value="" selected>Seleccionar Constructora</option>';

      foreach ($cliente as $key => $value) {               
                    
   $HTML.='<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
        }    

   $HTML.='</select>';

  
  echo $HTML;

  
   


