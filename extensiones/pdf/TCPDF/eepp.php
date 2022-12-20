<?php

require_once "../../../controladores/eepp.controlador.php";
require_once "../../../modelos/eepp.modelo.php";
require_once "../../../modelos/obras.modelo.php";



class imprimirEEPP{

public $id;
public $idObra;

public function traerEEPP(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$idEEPP = $this->id;
$idObra = $this->idObra;

//TRAEMOS LA INFORMACIÓN DEL CLIENTE
$cabecera = ModeloEEPP::ObtenerDatosEEPP($idEEPP);


$rut = $cabecera["rut"];
$constructora = $cabecera["constructora"];
$obra = $cabecera["obra"];
$bodeguero = $cabecera["contacto"];
$formaPago = $cabecera["formaPago"];

$dateReg = date_create($cabecera["fechaEEPP"]);


$fechaEEPP = date_format($dateReg,"d-m-Y H:i:s");

$fechaCobroEEPP = $cabecera["fechaCorte"];

$dateReg = date_create($cabecera["fechaCorte"]);
$fechaCorte = date_format($dateReg,"d-m-Y");
$mesProceso = date_format($dateReg,"m");
$anoProceso = date_format($dateReg,"Y");

       
        $mes = ControladorEEPP::ctrNombreMeses($mesProceso);

 $proceso = $mes.'-'.$anoProceso;       

$cobroTotalEquipos = 0;
$totalMateriales = 0;
$totalOtrosCobros = 0;
$totalGeneralEEPP = 0;
$cobroParcial = 0;

//REQUERIMOS LA CLASE TCPDF


// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);





$pdf->startPageGroup();
$pdf->AddPage();



$bloque1 = <<<EOF

	<table>
		
		<tr>			
			<td style="width:80px; text-align:left"><img src="images/fyb_logo2.png"></td>						
		</tr>	

		<tr>	
			
			<td style="background-color:#ccc; width:800px; text-align:center">				
				<h1>ESTADO DE PAGO</h1>
			</td>
		</tr>
		<tr>				
			<td style="background-color:#ccc; width:400px; text-align:center; color:red">				
				<h4>Periodo :  $proceso</h4>
			</td>
			<td style="background-color:#ccc; width:400px; text-align:center; color:red">				
				<h4>Cierre:  $fechaCorte</h4>
			</td>
		</tr>

	</table>
	<br/>
	<br/>
	

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');



// ---------------------------------------------------------

$bloque2 = <<<EOF
	
	<table style="font-size:8px; padding:5px 10px;">
	  <tr>   
      <td style="border: 1px solid #666; background-color:#ccc; width:100px">
        <strong>RUT</strong> 
      </td>
      <td style="border: 1px solid #666; background-color:#ccc; width:150px">
        <strong>RAZÓN SOCIAL</strong>
      </td>
      <td style="border: 1px solid #666; background-color:#ccc; width:150px">        
        <strong>OBRA</strong>
      </td>
      <td style="border: 1px solid #666; background-color:#ccc; width:100px">        
        <strong>COBRO</strong>
      </td>
      <td style="border: 1px solid #666; background-color:#ccc; width:150px">        
        <strong>CONTACTO</strong>
      </td>
      <td style="border: 1px solid #666; background-color:#ccc; width:150px">        
        <strong>EMISIÓN</strong>
      </td>
     </tr>
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:100px">
				$rut 
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px">
				$constructora
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px">				
				$obra
			</td>
			<td style="border: 1px solid #666; background-color:white; width:100px">				
				<strong>$formaPago</strong>
			</td>	   	
			<td style="border: 1px solid #666; background-color:white; width:150px">
				 $bodeguero
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px">			
				 $fechaEEPP
			</td>
     </tr>
	</table>
  <br/>
  <br/>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:7px; padding:5px 5px 5px 5px;">

    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:800px; text-align:center">        
        <strong>COBRO EQUIPOS EN ARRIENDO</strong>
      </td>
    </tr>
    <tr>

        <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:40px; text-align:center">Guía</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Contrato</td>     

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:60px; text-align:center">Código</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:200px; text-align:center">Equipo</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Precio</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Arriendo</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Dev.</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Report</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Último Cobro</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Desde</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Hasta</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Días</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:50px; text-align:center">Total</td>
    </tr>
  </table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$descuentoDias = ModeloEEPP::mdlCuentaDiasDescuento($idEEPP);
$descuentoDias = $descuentoDias["diasDescuento"];

$preguntaFecha = ModeloEEPP::mdlPrimerDiaDescuento($idEEPP);
$primeraFecha = $preguntaFecha["primeraFecha"];

$equiposCobro = ModeloEEPP::mdlMostrarEquiposProcesados($idEEPP);
$x = 1;

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
                $report = '';
              }

              $preguntaFechaDescuento = strtotime($primeraFecha);

              $aplicaDescuento = 1;
              if($fecDevolucion != '0000-00-00'){
                $preguntaFechaDevolucion = strtotime($fecDevolucion);
                
                
                 if($preguntaFechaDevolucion < $preguntaFechaDescuento){
                      $aplicaDescuento = 0;
                 }

              }

                $preguntaFechaArriendo = strtotime($fecArriendo);
               
                
                 if($preguntaFechaArriendo > $preguntaFechaDescuento){
                      $aplicaDescuento = 0;
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

              if($aplicaDescuento == 1){
                  $dias = $dias - $descuentoDias;   
                  }             

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

              $precio = '$ '.number_format($precio,0,'','.');
              $cobro = '$ '. number_format($cobro,0,'','.');

              



$bloque4 = <<<EOF

	
	<table style="font-size:7px; padding:5px 5px 5px 5px;"> 
   <tr>
       <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:40px; text-align:center">$guia</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$contrato</td>     

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:60px; text-align:left">$codigo</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:200px; text-align:left">$equipo</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:right">$precio</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$fecArriendo</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$fecDevolucion</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$report</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$ultimo_cobro</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$fechaDesde</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$fechaHasta</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:center">$dias</td>

      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:50px; text-align:right">$cobro</td>
		</tr>
EOF;


 if($linea != ''){
  $bloque4 .= <<<EOF
    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:$estilo; width:800px; text-align:left">        
       $linea
      </td>
    </tr>
EOF;
}
  
  

  $bloque4 .= <<<EOF
 </table>

EOF;



$x++;

if($x >= 10){   
 
  $pdf->AddPage();
  $pdf->writeHTML($bloque1, false, false, false, false, '');
  $pdf->writeHTML($bloque2, false, false, false, false, '');
  $pdf->writeHTML($bloque3, false, false, false, false, '');
  
  $x = 1;
}

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

$totalGeneralEEPP = $totalGeneralEEPP + $cobroTotalEquipos;
$cobroTotalEquipos = '$ '.number_format($cobroTotalEquipos,0,'','.');

$bloqueEquipos = <<<EOF
   <table style="font-size:10px; padding:5px 50px;">   
    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:500px; text-align:left"><strong>TOTAL NETO COBRO ARRIENDO DE EQUIPOS</strong>
      </td>
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:300px; text-align:right"><strong>$cobroTotalEquipos</strong>
      </td>
    </tr> 
   </table>     
EOF;

$pdf->writeHTML($bloqueEquipos, false, false, false, false, '');






//BLOQUE PARA COBRO DE MATERIALES

$materialesCobro = ModeloEEPP::mdlMostrarMaterialesProcesados($idEEPP);

 if($materialesCobro){

 
  $pdf->AddPage();
  $pdf->writeHTML($bloque1, false, false, false, false, '');
  $pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque5 = <<<EOF

  <table style="font-size:9px; padding:5px 5px 5px 5px;">

    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:800px; text-align:center">        
        <strong>COBRO INSUMOS Y MATERIALES</strong>
      </td>
    </tr>
    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Guía</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Fecha</td>     

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Código</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:200px; text-align:center">Material-Insumo</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Cantidad</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Precio</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Total</td>
    </tr>
  </table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');


$x = 1;

for($i = 0; $i < count($materialesCobro); $i++){   

            
              $guiaMaterial = $materialesCobro[$i]["guia"];
              $fecha = $materialesCobro[$i]["fecha"];
              $codigo = $materialesCobro[$i]["codigo"];
              $material = $materialesCobro[$i]["material"];
              $cantidad = $materialesCobro[$i]["cantidad"];
              $precio = $materialesCobro[$i]["precio"];
              $total = $materialesCobro[$i]["total"];
              
              $totalMateriales = $totalMateriales + $total;
              $cantidad = number_format($cantidad,0,'','.');
              $precio = '$ '.number_format($precio,0,'','.');
              $total = '$ '.number_format($total,0,'','.');
             

              $datetime = date_create($fecha);
              $fecha =  date_format($datetime,"d-m-Y");

$bloque6 = <<<EOF

  <table style="font-size:8px; padding:5px 5px 5px 5px;">    
    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$guiaMaterial</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$fecha</td>     

      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:left">$codigo</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:200px; text-align:left">$material</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$cantidad</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">$precio</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">$total</td>
    </tr>
  </table>

EOF;

$x++;

if($x >= 10){   
 
  $pdf->AddPage();
  $pdf->writeHTML($bloque1, false, false, false, false, '');
  $pdf->writeHTML($bloque2, false, false, false, false, '');
  $pdf->writeHTML($bloque5, false, false, false, false, '');
  
  $x = 1;
}

$pdf->writeHTML($bloque6, false, false, false, false, '');


}

$totalGeneralEEPP = $totalGeneralEEPP + $totalMateriales;
$totalMateriales = '$ '.number_format($totalMateriales,0,'','.');

$bloqueMateriales = <<<EOF
   <table style="font-size:10px; padding:5px 50px;">   
    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:500px; text-align:left"><strong>TOTAL NETO INSUMOS Y MATERIALES</strong>
      </td>
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:300px; text-align:right"><strong>$totalMateriales</strong>
      </td>
    </tr> 
   </table>     
EOF;

$pdf->writeHTML($bloqueMateriales, false, false, false, false, '');


}


//BLOQUE OTROS COBROS

$descuentosExtras = ModeloEEPP::mdlMostrarDescuentosExtras($idEEPP);


 if($descuentosExtras){

  $pdf->AddPage();
  $pdf->writeHTML($bloque1, false, false, false, false, '');
  $pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque7 = <<<EOF

  <table style="font-size:9px; padding:5px 5px 5px 5px;">

    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:600px; text-align:center">        
        <strong>COBROS ADICIONALES / DESCUENTOS</strong>
      </td>
    </tr>
    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Tipo</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Fecha</td>     

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:300px; text-align:center">Descripción</td>

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:100px; text-align:center">Monto</td>      
    </tr>
  </table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');


$x = 1;

         for($i = 0; $i < count($descuentosExtras); $i++){   

              
              $tipo = $descuentosExtras[$i]["tipoActo"];            
              $fecha = $descuentosExtras[$i]["fecha"];             
              $descripcion = $descuentosExtras[$i]["descripcion"];
              $montoCambio = $descuentosExtras[$i]["montoCambio"];
              
              $totalOtrosCobros = $totalOtrosCobros + $montoCambio;

              $montoCambio = '$ '.number_format($montoCambio,0,'','.');
              $descripcion = strtoupper($descripcion);

              $dateReg = date_create($fecha);
              $fecha = date_format($dateReg,"d-m-Y");


$bloque8 = <<<EOF

  <table style="font-size:8px; padding:5px 5px 5px 5px;">    
    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$tipo</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$fecha</td>     

      <td style="border: 1px solid #666; color:#333; background-color:white; width:300px; text-align:center">$descripcion</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$montoCambio</td>      
    </tr>
  </table>

EOF;

$pdf->writeHTML($bloque8, false, false, false, false, '');

}

$totalGeneralEEPP = $totalGeneralEEPP + $totalOtrosCobros;
$totalOtrosCobros = '$ '.number_format($totalOtrosCobros,0,'','.');

$bloqueOtros = <<<EOF
   <table style="font-size:10px; padding:5px 50px;">   
    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:400px; text-align:left"><strong>TOTAL NETO COBROS ADICIONALES / DESCUENTOS</strong>
      </td>
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:200px; text-align:center"><strong>$totalOtrosCobros</strong>
      </td>
    </tr> 
   </table>     
EOF;

$pdf->writeHTML($bloqueOtros, false, false, false, false, '');


 }


//BLOQUE RESUMEN EEPP

 
  $pdf->AddPage();
  $pdf->writeHTML($bloque1, false, false, false, false, '');
  $pdf->writeHTML($bloque2, false, false, false, false, '');

  $totalGeneralEEPP = '$ '.number_format($totalGeneralEEPP,0,'','.');

$bloque9 = <<<EOF

  <table style="font-size:12px; padding:5px 5px 5px 5px;">

    <tr> 
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:800px; text-align:center">        
        <strong>RESUMEN COBROS EEPP (VALORES NETO)</strong>
      </td>
    </tr>
    <tr>
        <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:300px; text-align:center">COBRO ARRIENDO DE EQUIPOS</td>
      
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:250px; text-align:center">COBRO INSUMOS / MATERIALES</td>     

      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:250px; text-align:center">COBROS EXTRAS / DESCUENTOS</td>
    </tr>
    <tr>
      <td style="border: 1px solid #666; color:#333; background-color:white; width:300px; text-align:center">$cobroTotalEquipos</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:250px; text-align:center">$totalMateriales</td>

      <td style="border: 1px solid #666; color:#333; background-color:white; width:250px; text-align:center">$totalOtrosCobros</td>      
    </tr>
    <tr>
      <td style="border: 1px solid #666; color:#333; background-color:#ccc; width:800px; text-align:center"><strong>$totalGeneralEEPP</strong></td>
    </tr>  

  </table>

EOF;

$pdf->writeHTML($bloque9, false, false, false, false, '');  


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 


$pdf->Output('EEPP-'.$obra.'-'.$proceso.'.pdf');

}

}

$report = new imprimirEEPP();
$report -> id = $_GET["id"];
$report -> obra = $_GET["idObra"];
$report -> traerEEPP();

?>