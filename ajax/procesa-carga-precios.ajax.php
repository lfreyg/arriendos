<?php
session_start();

require "../extensiones/vendor/autoload.php";
require_once "../controladores/cargaMasivaPrecios.controlador.php";
require_once "../modelos/cargaMasivaPrecios.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


$nombre = $_FILES["archivo"]["name"];
$rutaArchivo = $_FILES["archivo"]["tmp_name"];
$idCon = $_POST['idCon'];
$usuario = $_SESSION["nombre"]; 


$documento = IOFactory::load($rutaArchivo);
$hojaDeProductos = $documento->getSheet(0);
 
$numeroMayorDeFila = $hojaDeProductos->getHighestRow(); // Numérico
$letraMayorDeColumna = $hojaDeProductos->getHighestColumn(); // Letra
# Convertir la letra al número de columna correspondiente
$numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna);


for($i=0; $i < count($_SESSION["idObrasSeleccionadas"]); $i++){
	$idObra = $_SESSION["idObrasSeleccionadas"][$i];
	echo "entra obra ".$idObra."<br/>";
	 $elimina = ModeloCargaMasivaPrecios::mdlEliminarPreciosObra($idObra);
       
		for ($indiceFila = 2; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {  

			    $idEquipo = $hojaDeProductos->getCellByColumnAndRow(1, $indiceFila);
			    $precioConvenio = $hojaDeProductos->getCellByColumnAndRow(7, $indiceFila);  
			    
			              
            if($precioConvenio == ''){
                $precioConvenio = 0;
            }

            	
            	echo "equipo : ".$idEquipo;
          
			            	  $datos = array("id_constructoras"=>$idCon,
							                "id_obras"=>$idObra,
			                        "id_nombre_equipos"=>$idEquipo,
						                  "precio"=>$precioConvenio,
						                  "usuario"=>$usuario                  
							        );

			               $tabla = "precios_clientes";

			              $respuesta = ModeloCargaMasivaPrecios::mdlIngresarListaEquipos($tabla, $datos);

			                          

			}


}
  
   echo "ok";






?>