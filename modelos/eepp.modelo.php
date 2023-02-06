<?php

require_once "conexion.php";

class ModeloEEPP{

	

	

	static public function mdlMostrarConstructoraEEPP($fecha){

       $fecha = date('Y-m-d', strtotime($fecha)); 
       
       
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT c.id as id, c.rut as rut, c.nombre as nombre FROM guia_despacho_detalle gdd join guia_despacho gd on gdd.id_guia = gd.id join constructoras c on gd.id_constructoras = c.id WHERE gdd.registro_eliminado = false and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') and (gdd.fecha_devolucion_real is null or gdd.fecha_devolucion_real > gdd.fecha_ultimo_cobro or gdd.fecha_ultimo_cobro is null) and gd.tipo_guia = 'A' order by c.nombre");
		
       /*
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT c.id as id, c.rut as rut, c.nombre as nombre FROM guia_despacho gd left join guia_despacho_detalle gdd on gdd.id_guia = gd.id and gdd.fecha_arriendo <= '2022-10-31' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '2022-10-31') and gdd.registro_eliminado = false and gdd.validado = 0 left join guia_despacho_materiales gdm on gd.id = gdm.id_guia and gdm.registro_eliminado = false and gdm.validado = 0 and gdm.id_eepp is null join constructoras c on gd.id_constructoras = c.id order by c.nombre");
		*/

	
		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarObrasEEPP($idConstructora, $fecha){

		   
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT o.id as id, o.nombre as nombre FROM guia_despacho_detalle gdd join guia_despacho gd on gdd.id_guia = gd.id join obras o on gd.id_obras = o.id where o.id_constructoras = $idConstructora and gdd.registro_eliminado = false and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') and (gdd.fecha_devolucion_real is null or gdd.fecha_devolucion_real > gdd.fecha_ultimo_cobro or gdd.fecha_ultimo_cobro is null) and gd.tipo_guia = 'A' ORDER BY o.nombre");
			
          /*
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT o.id as id, o.nombre as nombre FROM guia_despacho gd left join guia_despacho_detalle gdd on gdd.id_guia = gd.id and gdd.registro_eliminado = false and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') left join guia_despacho_materiales gdm on gd.id = gdm.id_guia and gdm.registro_eliminado = false and gdm.validado = 0 and gdm.id_eepp is null join obras o on gd.id_obras = o.id where o.id_constructoras = $idConstructora  ORDER BY o.nombre");
			*/

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarEquiposParaCobro($idObra, $fecha){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idGuiaDetalle, gd.numero_guia as guia,  gdd.contrato as contrato, c.categoria as categoria, e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, gdd.fecha_arriendo as fecha_arriendo, if(gdd.fecha_devolucion_real <= '$fecha', gdd.fecha_devolucion_real, null) as fecha_devolucion, if(gdd.fecha_devolucion_real <= '$fecha', gdd.fecha_retiro_obra, null) as fecha_retiro, gdd.precio_arriendo as precio, if(gdd.fecha_devolucion_real <= '$fecha', gdd.devolucion_tipo, null) as tipo_devolucion, if(gdd.fecha_devolucion_real <= '$fecha', gdd.devuelto, 0) as devuelto, gdd.match_cambio as match_cambio, gdd.fecha_ultimo_cobro as ultimo_cobro, if(gdd.fecha_devolucion_real <= '$fecha', gdd.id_report_devolucion, null) as report_devolucion, if(gdd.fecha_devolucion_real <= '$fecha', estados.descripcion, null) as nombreDevolucion, if(gdd.fecha_ultimo_cobro is null, gdd.fecha_arriendo, date_add(gdd.fecha_ultimo_cobro, interval 1 day)) as fecha_desde FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id join categorias c on ne.id_categoria = c.id left join estados on gdd.devolucion_tipo = estados.id WHERE gdd.registro_eliminado = false and gd.id_obras = $idObra and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') and (gdd.fecha_devolucion_real is null or gdd.fecha_devolucion_real > gdd.fecha_ultimo_cobro or gdd.fecha_ultimo_cobro is null) and gdd.tipo_guia = 'A' order by gdd.contrato desc, ne.descripcion");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlEquiposCambiadosEEPP($match){

		$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idRegistro, ne.descripcion as equipo, ne.modelo as modelo, e.codigo as codigo, m.descripcion as marca, gd.numero_guia as gd, gdd.fecha_arriendo as fecha_arriendo FROM guia_despacho gd JOIN guia_despacho_detalle gdd ON gd.id = gdd.id_guia join equipos e ON gdd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id WHERE gdd.id = $match");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarMaterialesParaCobro($idObra, $fecha){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT gd.numero_guia as guia, gdm.id as idRegistro, mi.codigo as codigoMaterial, gdm.id_materiales_insumos as idMaterial, mi.descripcion as material, gdm.cantidad as cantidad, gdm.precio as precio, gdm.fecha as fecha, gdm.precio * gdm.cantidad as total FROM guia_despacho_materiales gdm JOIN materiales_insumos mi on gdm.id_materiales_insumos = mi.id JOIN guia_despacho gd on gdm.id_guia = gd.id where gd.id_obras = $idObra and gdm.se_cobra = 1 and gdm.validado = 0 and gdm.registro_eliminado = false and gdm.id_eepp is null and gdm.fecha <= '$fecha' and gd.tipo_guia = 'A'");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlValidaEEPPMes($idObra, $fecha){
		
		    $dateReg = date_create($fecha);
            $anno = date_format($dateReg,"Y");
            $mes = date_format($dateReg,"m");

			$mes = intval($mes);
			$anno = intval($anno);

		$stmt = Conexion::conectar()->prepare("SELECT id FROM eepp where month(fecha_corte) = $mes and year(fecha_corte) = $anno and id_obras = $idObra");		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEditaFechaEEPP($idEEPP, $fecha){

		$stmt = Conexion::conectar()->prepare("UPDATE eepp SET fecha_corte = :fecha where id = $idEEPP");

		      $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);		

			if($stmt->execute()){
               return 'OK';                 

		}else{

			return "error";
		
		}

	}

	static public function mdlGenerarEEPP($idConstructora, $idObra, $fecha){

		$stmt = Conexion::conectar()->prepare("INSERT INTO eepp (id_constructoras, id_obras, fecha_corte) values ($idConstructora, $idObra, :fecha)");

		      $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);		

			if($stmt->execute()){

				 $dateReg = date_create($fecha);
                 $anno = date_format($dateReg,"Y");
                 $mes = date_format($dateReg,"m");

			     $mes = intval($mes);
			     $anno = intval($anno);

			    $sql = Conexion::conectar()->prepare("SELECT id FROM eepp where month(fecha_corte) = $mes and year(fecha_corte) = $anno and id_obras = $idObra");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

	}

	static public function mdlGenerarDetalleEEPP($idEEPP, $idObra, $fecha){

		$stmt = Conexion::conectar()->prepare("INSERT INTO eepp_detalle_equipos (id_eepp, id_guia_detalle, guia, contrato, codigo, serie, descripcion, modelo, marca, precio, fecha_arriendo, fecha_devolucion, fecha_retiro_obra, report_devolucion, tipo_devolucion, devuelto, match_cambio, ultimo_cobro, nombreDevolucion, cobro_desde, cobro_hasta) SELECT $idEEPP, gdd.id, gd.numero_guia, gdd.contrato, e.codigo, e.numero_serie, ne.descripcion, ne.modelo, m.descripcion, gdd.precio_arriendo, gdd.fecha_arriendo, if(gdd.fecha_devolucion_real <= '$fecha', gdd.fecha_devolucion_real, '0000-00-00'), if(gdd.fecha_devolucion_real <= '$fecha', gdd.fecha_retiro_obra, '0000-00-00'), if(gdd.fecha_devolucion_real <= '$fecha', gdd.id_report_devolucion, 0), if(gdd.fecha_devolucion_real <= '$fecha', gdd.devolucion_tipo, 0), if(gdd.fecha_devolucion_real <= '$fecha', gdd.devuelto, 0), gdd.match_cambio, gdd.fecha_ultimo_cobro, if(gdd.fecha_devolucion_real <= '$fecha', estados.descripcion,''), if(gdd.fecha_ultimo_cobro is null, gdd.fecha_arriendo, date_add(gdd.fecha_ultimo_cobro, interval 1 day)) as fecha_desde_cobro, if(gdd.devuelto = 1 and gdd.fecha_devolucion_real <= '$fecha', gdd.fecha_devolucion_real, :fecha) as fecha_hasta_cobro FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id join categorias c on ne.id_categoria = c.id left join estados on gdd.devolucion_tipo = estados.id WHERE gdd.registro_eliminado = false and gd.id_obras = $idObra and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') and (gdd.fecha_devolucion_real is null or gdd.fecha_devolucion_real > gdd.fecha_ultimo_cobro or gdd.fecha_ultimo_cobro is null) and gdd.tipo_guia = 'A'");

		      $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);		

			if($stmt->execute()){

				 $sqlGuia = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle gdd JOIN eepp_detalle_equipos epd ON gdd.id = epd.id_guia_detalle SET gdd.fecha_ultimo_cobro = epd.cobro_hasta, gdd.cobro_finalizado = epd.devuelto WHERE epd.id_eepp = $idEEPP"); 
               

               if($sqlGuia->execute()){

               	      $stmt3 = Conexion::conectar()->prepare("INSERT INTO eepp_detalle_materiales (id_eepp, id_guia_detalle, guia, fecha, codigo, material, cantidad, precio, total) SELECT $idEEPP, gdm.id, gd.numero_guia, gdm.fecha, mi.codigo, mi.descripcion, gdm.cantidad, gdm.precio, gdm.precio * gdm.cantidad as total FROM guia_despacho_materiales gdm JOIN materiales_insumos mi on gdm.id_materiales_insumos = mi.id JOIN guia_despacho gd on gdm.id_guia = gd.id where gd.id_obras = $idObra and gdm.se_cobra = 1 and gdm.validado = 0 and gdm.registro_eliminado = false and gdm.id_eepp is null and gdm.fecha <= '$fecha'");

               	     if($stmt3->execute()){
               	          	 $sqlMateriales = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales gdm JOIN eepp_detalle_materiales epm ON gdm.id = epm.id_guia_detalle SET gdm.id_eepp = epm.id_eepp, gdm.fecha_cobro = :fecha WHERE epm.id_eepp = $idEEPP"); 

               	          	 $sqlMateriales->bindParam(":fecha", $fecha, PDO::PARAM_STR);

               	          	 $sqlMateriales->execute();

               	          	 $dateReg = date_create($fecha);
			                 $anno = date_format($dateReg,"Y");
			                 $mes = date_format($dateReg,"m");

						     $mes = intval($mes);
						     $anno = intval($anno);

						    $sql = Conexion::conectar()->prepare("SELECT id FROM eepp where month(fecha_corte) = $mes and year(fecha_corte) = $anno and id_obras = $idObra");
			 
			               $sql->execute();
			               return $sql -> fetch(); 


               	      }

		                     
               	     
               }   
		}else{

			return "error";
		
		}

	}


	static public function mdlMostrarEquiposProcesados($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, id_guia_detalle as idGuiaDetalle, guia, contrato, codigo, serie, descripcion, modelo, marca, precio, fecha_arriendo, fecha_devolucion, fecha_retiro_obra, report_devolucion, tipo_devolucion, devuelto, match_cambio, ultimo_cobro, nombreDevolucion, cobro_desde, cobro_hasta FROM eepp_detalle_equipos WHERE id_eepp = $idEEPP ORDER BY contrato desc, descripcion");	
			   
			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarMaterialesProcesados($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, id_guia_detalle as idGuiaDetalle, guia, fecha, codigo, material, cantidad, precio, cantidad * precio as total FROM eepp_detalle_materiales WHERE id_eepp = $idEEPP ORDER BY guia desc, material");	
			   
			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarDescuentosExtras($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT ede.id, ede.id_eepp, ede.descripcion, ede.monto, ede.fecha, u.nombre as usuario, ede.tipo, if(ede.tipo = 'D',ede.monto * -1,ede.monto) as montoCambio, if(ede.tipo = 'D','DESCUENTO','EXTRA') as tipoActo FROM eepp_descuentos_extras ede join usuarios u on ede.id_usuario = u.id WHERE ede.id_eepp = $idEEPP ORDER BY ede.descripcion");	
			   
			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlGuardarDescuentosExtras($datos){

		$idRegistro = $datos['id'];
      
      if($idRegistro == 0){
		$stmt = Conexion::conectar()->prepare("INSERT INTO eepp_descuentos_extras (id_eepp, descripcion, monto, id_usuario, tipo) values (:idEEPP, :motivo, :monto, :usuario, :tipo)");

		      $stmt->bindParam(":idEEPP", $datos['idEEPP'], PDO::PARAM_INT);
		      $stmt->bindParam(":motivo", $datos['motivo'], PDO::PARAM_STR);
		      $stmt->bindParam(":monto", $datos['monto'], PDO::PARAM_INT);
		      $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_INT);
		      $stmt->bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
      }else{
      	 $stmt = Conexion::conectar()->prepare("UPDATE eepp_descuentos_extras SET descripcion = :motivo, monto = :monto, id_usuario = :usuario where id = $idRegistro");

		      $stmt->bindParam(":motivo", $datos['motivo'], PDO::PARAM_STR);
		      $stmt->bindParam(":monto", $datos['monto'], PDO::PARAM_INT);
		      $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_INT);
		      
      }

			if($stmt->execute()){
                 return "ok";    
		    }else{
			     return "error";		
		    }

	}


	static public function mdlAnularEEPP($idEEPP){

		
				 $sqlGuia = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle gdd JOIN eepp_detalle_equipos epd ON gdd.id = epd.id_guia_detalle SET gdd.fecha_ultimo_cobro = epd.ultimo_cobro, gdd.cobro_finalizado = 0 WHERE epd.id_eepp = $idEEPP"); 

				 $sqlGuia->execute();

				 $sqlRectificaGuia = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle gdd SET gdd.fecha_ultimo_cobro = null WHERE gdd.fecha_ultimo_cobro = '0000-00-00'"); 

				 $sqlRectificaGuia->execute();



				 $sqlMateriales = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales gdm JOIN eepp_detalle_materiales epm ON gdm.id = epm.id_guia_detalle SET gdm.id_eepp = null, gdm.fecha_cobro = null WHERE epm.id_eepp = $idEEPP"); 
	          	 
	          	 $sqlMateriales->execute();
               

                 $sqlDescuentoExtra = Conexion::conectar()->prepare("DELETE FROM eepp_descuentos_extras WHERE id_eepp = $idEEPP"); 

                 $sqlDescuentoExtra->execute();

                 $sqlDetalleEquipos = Conexion::conectar()->prepare("DELETE FROM eepp_detalle_equipos WHERE id_eepp = $idEEPP"); 

                 $sqlDetalleEquipos->execute();

                 $sqlDetalleMateriales = Conexion::conectar()->prepare("DELETE FROM eepp_detalle_materiales WHERE id_eepp = $idEEPP"); 

                 $sqlDetalleMateriales->execute();

                 $sqlDiasDescuento = Conexion::conectar()->prepare("DELETE FROM eepp_dias_descuento WHERE id_eepp = $idEEPP"); 

                 $sqlDiasDescuento->execute();

                 $sqlEEPP = Conexion::conectar()->prepare("DELETE FROM eepp WHERE id = $idEEPP"); 

                 $sqlEEPP->execute();

                 $sqlEEPPOC = Conexion::conectar()->prepare("DELETE FROM oc_arriendos WHERE id_eepp = $idEEPP"); 

                 $sqlEEPPOC->execute();

                 $sqlEEPPOCDet = Conexion::conectar()->prepare("DELETE FROM oc_arriendos_detalle WHERE id_eepp = $idEEPP"); 

                 $sqlEEPPOCDet->execute();
		         
		         return "ok";            
               	     
               }   
		

	public static function revisarDiasSemana($fecha){
		$day = date("l", $fecha);
			switch ($day) {
			    case "Sunday":
			           return "DO";
			    break;
			    case "Monday":
			           return "LU";
			    break;
			    case "Tuesday":
			           return "MA";
			    break;
			    case "Wednesday":
			           return "MI";
			    break;
			    case "Thursday":
			           return "JU";
			    break;
			    case "Friday":
			           return "VI";
			    break;
			    case "Saturday":
			           return "SA";
			    break;
			}
	}

	public static function ObtenerDatosEEPP($id){
             $stmt = Conexion::conectar()->prepare("SELECT ep.fecha_corte as fechaCorte, ep.fecha_eepp as fechaEEPP, c.rut as rut, c.nombre as constructora, o.nombre as obra, o.contacto as contacto, tc.descripcion as formaPago, ep.como_factura, ep.cerrado FROM eepp ep JOIN constructoras c ON ep.id_constructoras = c.id JOIN obras o ON ep.id_obras = o.id JOIN tipo_cobro tc ON o.forma_cobro_id = tc.id WHERE ep.id = $id");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlUltimoEEPP($idObra){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT max(id) as id from eepp WHERE id_obras = $idObra");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		    $stmt -> close();

		    $stmt = null;

	}	


	static public function mdlMostrarEquiposProcesadoEdita($idRegistro){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, id_guia_detalle as idGuiaDetalle, guia, contrato, codigo, serie, descripcion, modelo, marca, precio, fecha_arriendo, fecha_devolucion, fecha_retiro_obra, report_devolucion, tipo_devolucion, devuelto, match_cambio, ultimo_cobro, nombreDevolucion, cobro_desde, cobro_hasta FROM eepp_detalle_equipos WHERE id = $idRegistro");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlEditarEquiposEEPPProcesado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE eepp_detalle_equipos SET precio = :precio, cobro_desde = :desde, cobro_hasta = :hasta WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", strtoupper($datos["idRegistro"]), PDO::PARAM_INT);		
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);		
		$stmt -> bindParam(":desde", $datos["desde"], PDO::PARAM_STR);
		$stmt -> bindParam(":hasta", $datos["hasta"], PDO::PARAM_STR);

		$stmt -> execute();

			$ultimoEEPP = $datos['ultimo'];
         
           if($ultimoEEPP == 1){   
	            $stmt2 = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle set precio_arriendo = :precio, fecha_ultimo_cobro = :hasta WHERE id = :idGuia");
	            
	            

	            $stmt2 -> bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
	            $stmt2 -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
	            $stmt2 -> bindParam(":hasta", $datos["hasta"], PDO::PARAM_STR);
	           
	         
	            $stmt2 -> execute();
           } 
         	
         	   return "ok";
			

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlEliminaEquiposEEPPProcesado($idRegistroElimina, $idEEPPElimina, $idGuiaDetalleElimina, $ultimoElimina){
	   
	    if($ultimoElimina == 1){
				 $sqlGuia = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle gdd JOIN eepp_detalle_equipos epd ON gdd.id = epd.id_guia_detalle SET gdd.fecha_ultimo_cobro = epd.ultimo_cobro, gdd.cobro_finalizado = 0 WHERE epd.id = $idRegistroElimina"); 

				 $sqlGuia->execute();

				$sqlRectificaGuia = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle gdd SET gdd.fecha_ultimo_cobro = null WHERE gdd.fecha_ultimo_cobro = '0000-00-00'"); 

				$sqlRectificaGuia->execute();
		}		 
         
             
	            $sqlDetalleEquipos = Conexion::conectar()->prepare("DELETE FROM eepp_detalle_equipos WHERE id = $idRegistroElimina"); 

                 $sqlDetalleEquipos->execute();
            
         	
         	   return "ok";
			

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlEliminaRegistrosExtra($idRegistroExtra){
	   
	        $sql = Conexion::conectar()->prepare("DELETE FROM eepp_descuentos_extras WHERE id = $idRegistroExtra"); 

                 $sql->execute();
            
         	
         	   return "ok";
			

		$stmt -> close();
		$stmt = null;
		

	}


	static public function mdlMostrarMaterialesProcesadoEdita($idRegistro){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, id_guia_detalle as idGuiaDetalle, guia, fecha, codigo, material, cantidad, precio FROM eepp_detalle_materiales WHERE id = $idRegistro");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlEditarMaterialEEPPProcesado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE eepp_detalle_materiales SET precio = :precio WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", strtoupper($datos["idRegistro"]), PDO::PARAM_INT);		
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);		
		
		

		$stmt -> execute();

		
         
          
	            $stmt2 = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales SET precio = :precio WHERE id = :idGuia");
	            
	            

	            $stmt2 -> bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
	            $stmt2 -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
	            
	           
	         
	            $stmt2 -> execute();
           
         	
         	   return "ok";
			

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlEliminaMaterialEEPPProcesado($idRegistroElimina, $idGuiaDetalleElimina){
	   
	            $sqlMateriales = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales gdm JOIN eepp_detalle_materiales epm ON gdm.id = epm.id_guia_detalle SET gdm.id_eepp = null, gdm.fecha_cobro = null WHERE epm.id = $idRegistroElimina"); 
	          	 
	          	 $sqlMateriales->execute();

	          	 $sqlDetalleMateriales = Conexion::conectar()->prepare("DELETE FROM eepp_detalle_materiales WHERE id = $idRegistroElimina"); 

                 $sqlDetalleMateriales->execute();
               
				
         	
         	   return "ok";
			

		$sqlMateriales -> close();
		$sqlDetalleMateriales -> close();

		$sqlMateriales = null;
		$sqlDetalleMateriales = null;

	}

	static public function mdlValidaDiaDescuento($idEEPP, $fecha){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM eepp_dias_descuento WHERE id_eepp = $idEEPP and fecha = '$fecha'");

		    //  $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);		

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

		    $stmt = null;	

	}


	static public function mdlGuardaDiaDescuento($idEEPP, $fecha){

		$stmt = Conexion::conectar()->prepare("INSERT INTO eepp_dias_descuento (id_eepp, fecha) VALUES ($idEEPP, :fecha)");

		      $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);		

			if($stmt->execute()){
               return 'OK';                 

		}else{

			return "error";
		
		}

	}


	static public function mdlCuentaDiasDescuento($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT count(id) as diasDescuento from eepp_dias_descuento WHERE id_eepp = $idEEPP");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		    $stmt -> close();

		    $stmt = null;

	}	

	static public function mdlPrimerDiaDescuento($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT min(fecha) as primeraFecha from eepp_dias_descuento WHERE id_eepp = $idEEPP");	
			   
			$stmt -> execute();

			return $stmt -> fetch();		
		

		    $stmt -> close();

		    $stmt = null;

	}	

	static public function mdlMostrarDiasDescuento($idEEPP){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, id_eepp, fecha FROM eepp_dias_descuento WHERE id_eepp = $idEEPP ORDER BY fecha");	
			   
			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlEliminaDiaDescuento($idRegistro){
	   
	        $sql = Conexion::conectar()->prepare("DELETE FROM eepp_dias_descuento WHERE id = $idRegistro"); 

                 $sql->execute();
            
         	
         	   return "ok";
			

		$stmt -> close();
		$stmt = null;
		

	}


	static public function mdlMostrarEEPPGenerados($mes, $anno){

       
		$stmt = Conexion::conectar()->prepare("SELECT ep.id as idEEPP, o.id as idObra, c.nombre as constructora, o.nombre as obra, ep.fecha_eepp, ep.fecha_corte FROM eepp ep join constructoras c on ep.id_constructoras = c.id join obras o on ep.id_obras = o.id where month(fecha_corte) = $mes and year(fecha_corte) = $anno");

		
		
       	
		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlActualizaValoresEEPP($idRegistro, $dias, $total){
	   
	            $sql = Conexion::conectar()->prepare("UPDATE eepp_detalle_equipos SET dias = $dias, total = $total WHERE id = $idRegistro"); 
	          	 
	          	 $sql->execute();

	          	              
				
         	
         	   return "ok";
			

		$sql -> close();
		$sql = null;
		

	}


	static public function mdlActualizaTotalEEPP($idEEPP, $total){
	   
	            $sql = Conexion::conectar()->prepare("UPDATE eepp SET total_eepp = $total WHERE id = $idEEPP"); 
	          	 
	          	 $sql->execute();
         	
         	   return "ok";			

		$sql -> close();
		$sql = null;
		

	}
	

}

