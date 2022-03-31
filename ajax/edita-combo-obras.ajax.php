<?php
require_once "../controladores/obras.controlador.php";
require_once "../modelos/obras.modelo.php";

 
$id = $_GET['id'];
$idObra = $_GET['idObra'];


if($id != ""){

   
  
            
            $obras = ControladorObras::ctrMostrarObrasSeleccion($id);
                               
            
  
   $HTML='<select class="form-control input-lg" id="editaComboObras" style="width: 100%;" name="editaComboObras" required>';                  
   
       foreach ($obras as $key => $value) {                     
         
         if($value["id"] == $idObra){          
         
            $HTML.='<option selected value="'.$value["id"].'">'.$value["nombre"].'</option>';
          }else{
            $HTML.='<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
          }
                    
        }    

   $HTML.='</select>';
}else{
  $HTML='<select class="form-control input-lg select2" id="editaComboObras" style="width: 100%;" name="editaComboObras" required>';
                  
   $HTML.='<option value="">Seleccionar Obra</option>';
   $HTML.='</select>';

}   
  
  echo $HTML;

  
   


