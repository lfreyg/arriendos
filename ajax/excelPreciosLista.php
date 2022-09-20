<?php
require "../extensiones/vendor/autoload.php";
require_once "../controladores/cargaMasivaPreciosLista.controlador.php";
require_once "../modelos/cargaMasivaPreciosLista.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
 
$documento = new Spreadsheet();
 
$nombreDelDocumento = "Precios Lista.xlsx";
$hojaDeEquipos = $documento->getActiveSheet();
$hojaDeEquipos->setTitle("Hoja 1");

$encabezado = ["ID","CATEGORIA", "MARCA", "EQUIPO", "MODELO", "PRECIO ACTUAL","NUEVO PRECIO"];
$hojaDeEquipos->fromArray($encabezado, null, 'A1');
$documento->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
$documento->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$documento->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$documento->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$documento->getActiveSheet()->getColumnDimension('F')->setWidth(17);
$documento->getActiveSheet()->getColumnDimension('G')->setWidth(17);
$documento->getActiveSheet()->setAutoFilter('B1:E1');

$numeroDeFila = 2;

$preciosEquipos = ModeloCargaMasivaPreciosLista::mdlConsultaPrecioLista();
            $blanco = "";

            foreach ($preciosEquipos as $row => $item){

                $id = $item["id"];
                $categoria = strtoupper($item["categoria"]);
                $marca = strtoupper($item["marca"]);
                $equipo = strtoupper($item["tipoEquipo"]);
                $modelo = strtoupper($item["modelo"]);
                $precio = number_format($item["precio"],0,"",".");

                $hojaDeEquipos->setCellValueByColumnAndRow(1, $numeroDeFila, $id);
                $hojaDeEquipos->setCellValueByColumnAndRow(2, $numeroDeFila, $categoria);
                $hojaDeEquipos->setCellValueByColumnAndRow(3, $numeroDeFila, $marca);
                $hojaDeEquipos->setCellValueByColumnAndRow(4, $numeroDeFila, $equipo);
                $hojaDeEquipos->setCellValueByColumnAndRow(5, $numeroDeFila, $modelo);
                $hojaDeEquipos->setCellValueByColumnAndRow(6, $numeroDeFila, $item["precio"]);
                $hojaDeEquipos->setCellValueByColumnAndRow(7, $numeroDeFila, $blanco);
                $numeroDeFila++;


             }

 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

$documento->getActiveSheet()->getProtection()->setSheet(true);
$documento->getDefaultStyle()->getProtection()->setLocked(false);
$hojaDeEquipos->getStyle('A:F')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);

 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;