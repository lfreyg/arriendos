<?php
session_start();

require "../extensiones/vendor/autoload.php";
require_once "../controladores/cargaMasivaPreciosLista.controlador.php";
require_once "../modelos/cargaMasivaPreciosLista.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


$nombre = $_FILES["archivo"]["name"];
$rutaArchivo = $_FILES["archivo"]["tmp_name"];
$usuario = $_SESSION["nombre"]; 


$documento = IOFactory::load($rutaArchivo);
$hojaDeProductos = $documento->getSheet(0);
 
$numeroMayorDeFila = $hojaDeProductos->getHighestRow(); // Numérico
$letraMayorDeColumna = $hojaDeProductos->getHighestColumn(); // Letra
# Convertir la letra al número de columna correspondiente
$numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna);



       
		for ($indiceFila = 2; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {  

			    $idEquipo = $hojaDeProductos->getCellByColumnAndRow(1, $indiceFila);
			    $precioConvenio = $hojaDeProductos->getCellByColumnAndRow(7, $indiceFila);  
			    
			              
            if($precioConvenio == ''){
                $precioConvenio = 0;
            }
               
            

            	
            	      if($precioConvenio != 0){     
			            	  $datos = array("id_nombre_equipos"=>$idEquipo,
						                  "precio"=>$precioConvenio,
						                  "usuario"=>$usuario                  
							        );

			      


			              $respuesta = ModeloCargaMasivaPreciosLista::mdlActualizarPrecioLista($datos);
			           }

			                      

			}



  
   echo "ok";






?>