<?php
require "../extensiones/vendor/autoload.php";

require_once "../controladores/eepp.controlador.php";
require_once "../modelos/eepp.modelo.php";
require_once "../modelos/obras.modelo.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$idEEPP = $_GET['idEEPP'];

$cabecera = ModeloEEPP::ObtenerDatosEEPP($idEEPP);
$nombreConstructora = $cabecera["constructora"];
$nombreObra = $cabecera["obra"];
$formaPago = $cabecera["formaPago"];
$nombreDelDocumento = $nombreConstructora.'-'.$nombreObra.".xlsx";

$documento = new Spreadsheet();


    
        $nombreHoja = 'EEPP Arriendo Equipos';
    
    
        $hojaDeEquipos = $documento->getActiveSheet();
        $hojaDeEquipos->setTitle($nombreHoja);
        $documento->getActiveSheet()->getProtection()->setSheet(false);
        $documento->getDefaultStyle()->getProtection()->setLocked(false);
          
    

   /*
        $hojaDeEquipos = $documento->createSheet();       
        $hojaDeEquipos->setTitle($nombreHoja);
        $documento->getActiveSheet()->getProtection()->setSheet(true);
        $documento->getDefaultStyle()->getProtection()->setLocked(false);
        $hojaDeEquipos->getStyle('A:H')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
   */



$encabezado = ["Guía", "Fecha", "Código", "Material-Insumo", "Cantidad", "Precio","Total"];
$hojaDeEquipos->fromArray($encabezado, null, 'A1');
$documento->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
$documento->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$documento->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$documento->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$documento->getActiveSheet()->getColumnDimension('F')->setWidth(17);
$documento->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$documento->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$documento->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$documento->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$documento->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$documento->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$documento->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$documento->getActiveSheet()->setAutoFilter('A1:H1');

$numeroDeFila = 2;
$blanco = "";

    $equiposCobro = ModeloEEPP::mdlMostrarEquiposProcesados($idEEPP);
    
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
                $report = '0';
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
                $fecDevolucion = '';
              }

              if($ultimo_cobro != '0000-00-00'){
                $dateReg3 = date_create($ultimo_cobro);
                $ultimo_cobro = date_format($dateReg3,"d-m-y");
              }else{
                $ultimo_cobro = '';
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

                          

              $cobro = $dias * $precio;

              $estilo = 'white';
              $linea = '';

              if($matchCambio != 0){
                $estilo = 'rgb(102, 255, 153)';

             $QueryequipoMatch = ControladorEEPP::ctrEquiposCambiadosEEPP($matchCambio);

                      
                     
                     if($QueryequipoMatch){
                         $codigoCambio = $QueryequipoMatch[0]["codigo"];
                         $equipoCambio = $QueryequipoMatch[0]["equipo"];
                         $modeloCambio = $QueryequipoMatch[0]["modelo"];
                         $marcaCambio =  $QueryequipoMatch[0]["marca"];
                         $guiaCambio = $QueryequipoMatch[0]["gd"];
                         $fechaArriendoCambio = $QueryequipoMatch[0]["fecha_arriendo"];
                         $dateReg1 = date_create($fechaArriendoCambio);
                         $fechaArriendoCambio = date_format($dateReg1,"d-m-Y");

                         $nombreEquipoCambio = $equipoCambio.' '.$modeloCambio.' '.$marcaCambio;

                       
                       $linea .= 'Equipo cambiado por '.$nombreEquipoCambio.' Código '.$codigoCambio.' Entregado con fecha '.$fechaArriendoCambio.' en la GD '.$guiaCambio.' / ';
                        
                     }
              }

              if($tipoDevolucion == 11){
                $estilo = 'rgb(102, 255, 153)';
                $linea .= 'EQUIPO DEVUELTO POR CAMBIO DE EQUIPO / ';
              }

              if($tipoDevolucion == 15){
                $tipoDevolucionNombre = 'TERMINO';
                  if($matchCambio != 0){
                   $estilo = 'rgb(102, 255, 153)';
                  }else{
                   $estilo = 'yellow';
                  }
               
                $linea .= 'EQUIPO DEVUELTO POR TERMINO DE CONTRATO / ';
              }

              

              $cobroParcial = $cobro;

              $cobroTotalEquipos = $cobroTotalEquipos + $cobroParcial;

            //  $precio = '$ '.number_format($precio,0,'','.');
             // $cobro = '$ '. number_format($cobro,0,'','.');


               
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

             $documento->getActiveSheet()->getProtection()->setSheet(false);
             $documento->getDefaultStyle()->getProtection()->setLocked(false);
                
                
               


 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');

 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;