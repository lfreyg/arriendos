<?php
session_start();

require "../extensiones/vendor/autoload.php";
require_once "../controladores/cargaMasivaPrecios.controlador.php";
require_once "../modelos/cargaMasivaPrecios.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


$nombre = $_FILES["archivo"]["name"];
$rutaArchivo = $_FILES["archivo"]["tmp_name"];


$documento = IOFactory::load($rutaArchivo);
$hojaDeProductos = $documento->getSheet(0);
 
$numeroMayorDeFila = $hojaDeProductos->getHighestRow(); // Numérico
$letraMayorDeColumna = $hojaDeProductos->getHighestColumn(); // Letra
# Convertir la letra al número de columna correspondiente
$numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna);

			    $idEquipo = $hojaDeProductos->getCellByColumnAndRow(1, 1);
			    $categoria = $hojaDeProductos->getCellByColumnAndRow(2, 1);  
			    $marca = $hojaDeProductos->getCellByColumnAndRow(3, 1);
			    $equipo = $hojaDeProductos->getCellByColumnAndRow(4, 1);
			    $modelo = $hojaDeProductos->getCellByColumnAndRow(5, 1); 
			    $precio = $hojaDeProductos->getCellByColumnAndRow(6, 1);  
			    $preConv = $hojaDeProductos->getCellByColumnAndRow(7, 1);  

						    if($idEquipo != 'ID'){
						    	echo 0;						    	
						    }else if($categoria != 'CATEGORIA'){
						    	echo 0;						    	
						    }else if($marca != 'MARCA'){
						    	echo 0;						    	
						    } else if($equipo != 'EQUIPO'){
						    	echo 0;						    	
						    } else if($modelo != 'MODELO'){
						    	echo 0;						    	
						    }elseif($precio != 'PRECIO LISTA'){
						    	echo 0;						    	
						    }elseif($preConv != 'PRECIO CONVENIO'){
						    	echo 0;						    	
						    }else{
						    	echo 1;
						    }   

						    

						   

						    

						    

						    

						    
                      
                   
                      






?>