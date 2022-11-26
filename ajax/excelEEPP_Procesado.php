<?php
require "../extensiones/vendor/autoload.php";
require_once "../controladores/cargaMasivaPrecios.controlador.php";
require_once "../modelos/cargaMasivaPrecios.modelo.php";

require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/obras.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
 
$documento = new Spreadsheet();

$idEEPP = $_GET['idEEPP'];

$cabecera = ModeloEEPP::ObtenerDatosEEPP($idEEPP);
$nombreConstructora = $cabecera["constructora"];
$nombreObra = $cabecera["obra"];
$formaPago = $cabecera["formaPago"];

$cobroTotalEquipos = 0;
$totalMateriales = 0;
$totalOtrosCobros = 0;
$totalGeneralEEPP = 0;
$cobroParcial = 0;
 
$nombreDelDocumento = $nombreConstructora.'-'.$nombreObra.".xlsx";

$hojaDeEquipos = $documento->getActiveSheet();
$hojaDeEquipos->setTitle("COBRO EQUIPOS EN ARRIENDO");
$documento->getActiveSheet()->getProtection()->setSheet(true);
$documento->getDefaultStyle()->getProtection()->setLocked(false);


$encabezado = ["Guía", "Contrato", "Código", "Equipo", "Precio", "Arriendo","Devolución","Report", "Último Cobro", "Desde", "Hasta", "Días", "Total"];
$hojaDeEquipos->fromArray($encabezado, null, 'A1');
$documento->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
$documento->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('C')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('D')->setWidth(70);
$documento->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('K')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('L')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('M')->setWidth(25);
$documento->getActiveSheet()->setAutoFilter('A1:H1');


$numeroDeFila = 2;

$descuentoDias = ModeloEEPP::mdlCuentaDiasDescuento($idEEPP);

$descuentoDias = $descuentoDias["diasDescuento"];

$preguntaFecha = ModeloEEPP::mdlPrimerDiaDescuento($idEEPP);
$primeraFecha = $preguntaFecha["primeraFecha"];


 $equiposCobro = ModeloEEPP::mdlMostrarEquiposProcesados($idEEPP);
    
     
            $blanco = "";

         for($i = 0; $i < count($equiposCobro); $i++){

              $idGuiaDetalle = $equiposCobro[$i]["idGuiaDetalle"];
              $guia = $equiposCobro[$i]["guia"];
              $contrato = $equiposCobro[$i]["contrato"];
              $codigo = $equiposCobro[$i]["codigo"];
              $serie = $equiposCobro[$i]["serie"];
              $equipo = $equiposCobro[$i]["descripcion"].' '.$equiposCobro[$i]["modelo"].' '.$equiposCobro[$i]["marca"];
              $precio = $equiposCobro[$i]["precio"];
              $fecArriendo = $equiposCobro[$i]["fecha_arriendo"];
              $fecDevolucion = $equiposCobro[$i]["fecha_devolucion"];
              $report = $equiposCobro[$i]["report_devolucion"];
              $tipoDevolucion = $equiposCobro[$i]["tipo_devolucion"];
              $tipoDevolucionNombre = $equiposCobro[$i]["nombreDevolucion"];
              $ultimo_cobro = $equiposCobro[$i]["ultimo_cobro"];
              $matchCambio = $equiposCobro[$i]["match_cambio"];
              $fechaDesde = $equiposCobro[$i]["cobro_desde"];
              $fechaHasta = $equiposCobro[$i]["cobro_hasta"];

              
              $tipoCobro = $formaPago;

              if($report == 0){
                $report = $blanco;
              }

              $aplicaDescuento = 1;
              if($fecDevolucion != '0000-00-00'){
                $preguntaFechaDevolucion = strtotime($fecDevolucion);
                $preguntaFechaDescuento = strtotime($primeraFecha);
                
                 if($preguntaFechaDevolucion < $preguntaFechaDescuento){
                      $aplicaDescuento = 0;
                 }

              }

              if($tipoCobro == 'LUNES A LUNES'){
                $dias = 0;   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          
                          if($day == 'Monday'){
                            $dias ++;
                          }

                          if($day == 'Tuesday'){
                            $dias ++;
                          }

                          if($day == 'Wednesday'){
                            $dias ++;
                          }

                         if($day == 'Thursday'){
                            $dias ++;
                          }

                          if($day == 'Friday'){
                            $dias ++;
                          }

                          if($day == 'Saturday'){
                            $dias ++;
                          }

                          if($day == 'Sunday'){
                            $dias ++;
                          }
                      }
                   }  

                    if($tipoCobro == 'LUNES A VIERNES'){                 
                  $dias = 0;   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          
                          if($day == 'Monday'){
                            $dias ++;
                          }

                          if($day == 'Tuesday'){
                            $dias ++;
                          }

                          if($day == 'Wednesday'){
                            $dias ++;
                          }

                         if($day == 'Thursday'){
                            $dias ++;
                          }

                          if($day == 'Friday'){
                            $dias ++;
                          }
                      }
            
           
             }   

             if($tipoCobro == 'LUNES A SABADO'){
                  $dias = 0;   
                  $fechaInicio=strtotime($fechaDesde);
                  $fechaFin=strtotime($fechaHasta);
                      for($z=$fechaInicio; $z<=$fechaFin; $z+=86400){
                          $day = date("l", $z);
                          
                          if($day == 'Monday'){
                            $dias ++;
                          }

                          if($day == 'Tuesday'){
                            $dias ++;
                          }

                          if($day == 'Wednesday'){
                            $dias ++;
                          }

                         if($day == 'Thursday'){
                            $dias ++;
                          }

                          if($day == 'Friday'){
                            $dias ++;
                          }

                          if($day == 'Saturday'){
                            $dias ++;
                          }
                      }
             }  
             
             //FORMATEO DE FECHAS
               if($fecArriendo != null){
                $dateReg1 = date_create($fecArriendo);
                $fecArriendo = date_format($dateReg1,"d-m-y");
              }

              if($fecDevolucion != '0000-00-00'){
                $dateReg2 = date_create($fecDevolucion);
                $fecDevolucion = date_format($dateReg2,"d-m-y");
              }else{
                $fecDevolucion = $blanco;
              }

              if($ultimo_cobro != '0000-00-00'){
                $dateReg3 = date_create($ultimo_cobro);
                $ultimo_cobro = date_format($dateReg3,"d-m-y");
              }else{
                $ultimo_cobro = $blanco;
              }

              if($fechaDesde != null){
                $dateReg4 = date_create($fechaDesde);
                $fechaDesde = date_format($dateReg4,"d-m-y");
              }

              if($fechaHasta != null){
                $dateReg5 = date_create($fechaHasta);
                $fechaHasta = date_format($dateReg5,"d-m-y");
              }


              //FIN FORMATEO DE FECHAS

              if($aplicaDescuento == 1){
                  $dias = $dias - $descuentoDias;   
                  } 

              $cobro = $dias * $precio;

              $cobroParcial = $cobro;

              $cobroTotalEquipos = $cobroTotalEquipos + $cobroParcial;

               $hojaDeEquipos->setCellValueByColumnAndRow(1, $numeroDeFila, $guia);
               $hojaDeEquipos->setCellValueByColumnAndRow(2, $numeroDeFila, $contrato);
               $hojaDeEquipos->setCellValueByColumnAndRow(3, $numeroDeFila, $codigo);
               $hojaDeEquipos->setCellValueByColumnAndRow(4, $numeroDeFila, $equipo);
               $hojaDeEquipos->setCellValueByColumnAndRow(5, $numeroDeFila, $precio);
               $hojaDeEquipos->setCellValueByColumnAndRow(6, $numeroDeFila, $fecArriendo);
               $hojaDeEquipos->setCellValueByColumnAndRow(7, $numeroDeFila, $fecDevolucion);
               $hojaDeEquipos->setCellValueByColumnAndRow(8, $numeroDeFila, $report);
               $hojaDeEquipos->setCellValueByColumnAndRow(9, $numeroDeFila, $ultimo_cobro);
               $hojaDeEquipos->setCellValueByColumnAndRow(10, $numeroDeFila, $fechaDesde);
               $hojaDeEquipos->setCellValueByColumnAndRow(11, $numeroDeFila, $fechaHasta);
               $hojaDeEquipos->setCellValueByColumnAndRow(12, $numeroDeFila, $dias);
               $hojaDeEquipos->setCellValueByColumnAndRow(13, $numeroDeFila, $cobro);


               $numeroDeFila++;
 

               


}

             $documento->getActiveSheet()->getProtection()->setSheet(true);
             $documento->getDefaultStyle()->getProtection()->setLocked(false);


           

$materialesCobro = ModeloEEPP::mdlMostrarMaterialesProcesados($idEEPP);

 if($materialesCobro){

        $hojaDeEquipos = $documento->createSheet();       
        $hojaDeEquipos->setTitle('COBRO INSUMOS Y MATERIALES');
        $documento->getActiveSheet()->getProtection()->setSheet(true);
        $documento->getDefaultStyle()->getProtection()->setLocked(false);

        $encabezado = ["Guía", "Fecha", "Código", "Material-Insumo", "Cantidad", "Precio","Total"];
        $hojaDeEquipos->fromArray($encabezado, null, 'A1');
        $documento->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        $documento->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $documento->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $documento->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $documento->getActiveSheet()->getColumnDimension('D')->setWidth(70);
        $documento->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $documento->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $documento->getActiveSheet()->getColumnDimension('G')->setWidth(25);        
        $documento->getActiveSheet()->setAutoFilter('A1:D1');


        $numeroDeFila = 2;

        for($i = 0; $i < count($materialesCobro); $i++){   

            
              $guiaMaterial = $materialesCobro[$i]["guia"];
              $fecha = $materialesCobro[$i]["fecha"];
              $codigo = $materialesCobro[$i]["codigo"];
              $material = $materialesCobro[$i]["material"];
              $cantidad = $materialesCobro[$i]["cantidad"];
              $precio = $materialesCobro[$i]["precio"];
              $total = $materialesCobro[$i]["total"];
              
              $totalMateriales = $totalMateriales + $total;
              
             

              $datetime = date_create($fecha);
              $fecha =  date_format($datetime,"d-m-Y");

               $hojaDeEquipos->setCellValueByColumnAndRow(1, $numeroDeFila, $guia);
               $hojaDeEquipos->setCellValueByColumnAndRow(2, $numeroDeFila, $fecha);
               $hojaDeEquipos->setCellValueByColumnAndRow(3, $numeroDeFila, $codigo);
               $hojaDeEquipos->setCellValueByColumnAndRow(4, $numeroDeFila, $material);
               $hojaDeEquipos->setCellValueByColumnAndRow(5, $numeroDeFila, $cantidad);
               $hojaDeEquipos->setCellValueByColumnAndRow(6, $numeroDeFila, $precio);
               $hojaDeEquipos->setCellValueByColumnAndRow(7, $numeroDeFila, $total);

               $numeroDeFila++;


        }

 
}
             
             $documento->getActiveSheet()->getProtection()->setSheet(true);
             $documento->getDefaultStyle()->getProtection()->setLocked(true);

$descuentosExtras = ModeloEEPP::mdlMostrarDescuentosExtras($idEEPP);

 if($descuentosExtras){

        $hojaDeEquipos = $documento->createSheet();       
        $hojaDeEquipos->setTitle('COBROS ADICIONALES Y DESCUENTOS');
        $documento->getActiveSheet()->getProtection()->setSheet(true);
        $documento->getDefaultStyle()->getProtection()->setLocked(true);

        $encabezado = ["Tipo", "Fecha", "Descripción", "Monto"];
        $hojaDeEquipos->fromArray($encabezado, null, 'A1');
        $documento->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
        $documento->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $documento->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $documento->getActiveSheet()->getColumnDimension('C')->setWidth(70);
        $documento->getActiveSheet()->getColumnDimension('D')->setWidth(25);
              
        $documento->getActiveSheet()->setAutoFilter('A1:C1');


        $numeroDeFila = 2;

        for($i = 0; $i < count($descuentosExtras); $i++){    

            
              $tipo = $descuentosExtras[$i]["tipoActo"];            
              $fecha = $descuentosExtras[$i]["fecha"];             
              $descripcion = $descuentosExtras[$i]["descripcion"];
              $montoCambio = $descuentosExtras[$i]["montoCambio"];
              
              $totalOtrosCobros = $totalOtrosCobros + $montoCambio;
              
              $descripcion = strtoupper($descripcion);

              $dateReg = date_create($fecha);
              $fecha = date_format($dateReg,"d-m-Y");

               $hojaDeEquipos->setCellValueByColumnAndRow(1, $numeroDeFila, $tipo);
               $hojaDeEquipos->setCellValueByColumnAndRow(2, $numeroDeFila, $fecha);
               $hojaDeEquipos->setCellValueByColumnAndRow(3, $numeroDeFila, $descripcion);
               $hojaDeEquipos->setCellValueByColumnAndRow(4, $numeroDeFila, $montoCambio);
            
               $numeroDeFila++;


        }

 
}

             $documento->getActiveSheet()->getProtection()->setSheet(true);
             $documento->getDefaultStyle()->getProtection()->setLocked(true);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');


 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;