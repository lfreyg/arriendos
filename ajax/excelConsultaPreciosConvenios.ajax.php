<?php
require "../extensiones/vendor/autoload.php";
require_once "../controladores/cargaMasivaPrecios.controlador.php";
require_once "../modelos/cargaMasivaPrecios.modelo.php";
require_once "../controladores/constructoras.controlador.php";
require_once "../modelos/constructoras.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$idConstructora = $_GET['idConstructora'];
 
$documento = new Spreadsheet();

$constructora = ControladorConstructoras::ctrMostrarConstructoras("id",$idConstructora);

$nombreConstructora = $constructora["nombre"];
 
$nombreDelDocumento = $nombreConstructora.".xlsx";



$obrasConstructoras = ModeloCargaMasivaPrecios::mdlObrasConstructora($idConstructora);

$corre = 0;
foreach($obrasConstructoras as $constructora => $value){
    
    $nombreObra = $value["nombreObra"];
    $idObra = $value["idObra"];

    if($corre == 0){
        $hojaDeEquipos = $documento->getActiveSheet();
        $hojaDeEquipos->setTitle($nombreObra);
        $documento->getActiveSheet()->getProtection()->setSheet(true);
        $documento->getDefaultStyle()->getProtection()->setLocked(false);
        $hojaDeEquipos->getStyle('A:G')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);       
    

    }else{
        $hojaDeEquipos = $documento->createSheet();       
        $hojaDeEquipos->setTitle($nombreObra);
        $documento->getActiveSheet()->getProtection()->setSheet(true);
        $documento->getDefaultStyle()->getProtection()->setLocked(false);
        $hojaDeEquipos->getStyle('A:G')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
    }

    $corre = 1;



$encabezado = ["CATEGORIA", "MARCA", "EQUIPO", "MODELO", "PRECIO LISTA","PRECIO CONVENIO","ACTUALIZADO"];
$hojaDeEquipos->fromArray($encabezado, null, 'A1');
$documento->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
$documento->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$documento->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$documento->getActiveSheet()->getColumnDimension('E')->setWidth(17);
$documento->getActiveSheet()->getColumnDimension('F')->setWidth(17);
$documento->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$documento->getActiveSheet()->setAutoFilter('A1:D1');

$numeroDeFila = 2;
$blanco = "";
    $preciosEquipos = ModeloCargaMasivaPrecios::mdlObrasConConvenio($idObra);
    
      foreach ($preciosEquipos as $row => $item){

                
                $categoria = strtoupper($item["categoria"]);
                $marca = strtoupper($item["marca"]);
                $equipo = strtoupper($item["tipoEquipo"]);
                $modelo = strtoupper($item["modelo"]);
                $precio = number_format($item["precio"],0,"",".");  
                setlocale(LC_TIME,"es_CL");             
                $dateCreado = date_create($item["fecha_creado"]);
                $creado = date_format($dateCreado,"d-M-Y H:i:s");

               
                $hojaDeEquipos->setCellValueByColumnAndRow(1, $numeroDeFila, $categoria);
                $hojaDeEquipos->setCellValueByColumnAndRow(2, $numeroDeFila, $marca);
                $hojaDeEquipos->setCellValueByColumnAndRow(3, $numeroDeFila, $equipo);
                $hojaDeEquipos->setCellValueByColumnAndRow(4, $numeroDeFila, $modelo);
                $hojaDeEquipos->setCellValueByColumnAndRow(5, $numeroDeFila, $item["precio"]);
                $hojaDeEquipos->setCellValueByColumnAndRow(6, $numeroDeFila, $item["precio_convenio"]);
                $hojaDeEquipos->setCellValueByColumnAndRow(7, $numeroDeFila, $creado);
                $numeroDeFila++;


             }

             $documento->getActiveSheet()->getProtection()->setSheet(true);
             $documento->getDefaultStyle()->getProtection()->setLocked(false);
             $hojaDeEquipos->getStyle('A:G')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
    
                
               
}

 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;