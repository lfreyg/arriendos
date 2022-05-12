<?php
require_once "../controladores/obras.controlador.php";
require_once "../modelos/obras.modelo.php";

 
$idConstructora = $_GET['id'];



if($idConstructora != ""){

   
  
            
            $obras = ControladorObras::ctrMostrarObrasSoloConEquiposActivos($idConstructora);
                               
            
  
   $HTML='<select class="form-control input-lg select2" id="comboObras" style="width: 100%;" name="comboObras" required>';
                  
   $HTML.='<option value="">Seleccionar Obra</option>';

       foreach ($obras as $key => $value) {                     
                    
         $HTML.='<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    
        }    

   $HTML.='</select>';
}else{
  $HTML='<select class="form-control input-lg select2" id="comboObras" style="width: 100%;" name="comboObras" required>';
                  
   $HTML.='<option value="">Seleccionar Obra</option>';
   $HTML.='</select>';

}   
  
  echo $HTML;

  
   


