<?php

require_once "conexion.php";

class ModeloReportDevolucionDetalles{

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlRegistrarRetiro($datos){

		$idEquipo = $datos["idEquipo"];
		$estado = 16; //POR VALIDAR RETIRO
		
		$stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = 16 WHERE id = $idEquipo");

	          $stmt2->execute();

        date_default_timezone_set('America/Santiago');
        $fecha_retiro_obra = date('Y-m-d H:i:s');
        

        $stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET id_report_devolucion = :idReportDevolucion, fecha_devolucion_real = :fechaRetiro, devuelto = 1, devolucion_tipo = :movimiento, detalle_devolucion = :detalle, fecha_retiro_obra = :fecha_retiro_obra  WHERE id = :idRegistroGuiaDetalle");

	        $stmt->bindParam(":idRegistroGuiaDetalle", $datos["idRegistroGuiaDetalle"], PDO::PARAM_INT);
			$stmt->bindParam(":fechaRetiro", strtoupper($datos["fechaRetiro"]), PDO::PARAM_STR);
			$stmt->bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);		
			$stmt->bindParam(":movimiento", strtoupper($datos["movimiento"]), PDO::PARAM_INT);	
			$stmt->bindParam(":idReportDevolucion", strtoupper($datos["idReportDevolucion"]), PDO::PARAM_INT);
			$stmt->bindParam(":fecha_retiro_obra", $fecha_retiro_obra, PDO::PARAM_STR);          				
		
		
		if($stmt->execute()){	
					      
			  return 1;

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	

	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlEliminarEquipoRetiro($id,$idEquipo){

		$estado = 2; //VUELVE LOS EQUIPOS A ARRENDADO
		
       $sqlGuia = Conexion::conectar()->prepare("UPDATE equipos e JOIN guia_despacho_detalle gdd ON e.id = gdd.id_equipo SET e.id_estado = $estado, e.tiene_movimiento = 1, gdd.devuelto = 0, gdd.fecha_devolucion_real = NULL, gdd.contrato = gdd.id_guia, gdd.match_cambio = NULL, gdd.id_report_devolucion = NULL, gdd.devolucion_tipo = NULL, gdd.detalle_devolucion = NULL, gdd.fecha_retiro_obra = NULL WHERE gdd.id = $id"); 
            	

	
		if($sqlGuia -> execute()){
			
			   return "ok";	
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	

	


	static public function mdlRetiroPorId($id_report_devolucion){

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.fecha_devolucion_real as fecha, es.descripcion as movimiento, gd.fecha_retiro_obra as fechaRetiroObra, es.id as idEstado, gd.id_guia as contrato, gd.validado_retiro as validado, e.id_estado as idEstadoEquipo, e.id_sucursal as idSucursalEquipo FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN estados es ON gd.devolucion_tipo = es.id WHERE gd.id_report_devolucion = $id_report_devolucion order by gd.id desc");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEquipoRetiradoPorId($idArriendo){

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.fecha_devolucion_real as fecha, gd.devolucion_tipo as movimiento, gd.detalle as detalle FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id WHERE gd.id = $idArriendo");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	GUARDAR EDITAR 
	=============================================*/

	static public function mdlEditarEquiposRetirado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET fecha_devolucion_real = :fecha_termino, devolucion_tipo = :movimiento, detalle_devolucion = :detalle WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":fecha_termino", strtoupper($datos["fecha_termino"]), PDO::PARAM_STR);
		$stmt -> bindParam(":movimiento", $datos["movimiento"], PDO::PARAM_INT);
		$stmt -> bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);	
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlFinalizarReport($idReport){
	
	$estado = 9; //FINALIZADO

	$stmt = Conexion::conectar()->prepare("UPDATE report_devolucion SET estado = $estado WHERE id = $idReport");
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	//REALIZA MATCH ENTRE EL EQUIPO QUE SALE Y EL EQUIPO QUE ENTRA

	static public function mdlHaceMatchCambioEquipo($idRegistroTermino,$idRegistroCambio,$contrato){
	

	//idRegistroTermino = EQUIPO QUE SALE
	//idRegistroCambio = EQUIPO QUE ENTRA
	//contrato = CONTRATO EQUIPO QUE SALE, PARA MANTENER EL ORDEN DEL ARRIENDO EN CASO DE CAMBIO	
	
	$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET match_cambio = $idRegistroTermino, contrato = $contrato WHERE id = $idRegistroCambio");
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlQuitarCambioEquipo($idRegistroTermino){
	

	//idRegistroTermino = EQUIPO QUE SALE
	//idRegistroCambio = EQUIPO QUE ENTRA
	//contrato = CONTRATO EQUIPO QUE SALE, PARA MANTENER EL ORDEN DEL ARRIENDO EN CASO DE CAMBIO	
	
	$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET match_cambio = null, contrato = id_guia WHERE match_cambio = $idRegistroTermino");
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	

	static public function mdlValidaEquipoReportEliminar($idRegistro){

		

			$stmt = Conexion::conectar()->prepare("SELECT gdd.* FROM guia_despacho_detalle gdd join equipos e ON gdd.id_equipo = e.id where gdd.devuelto = 1 and gdd.validado_retiro = 0 and e.id_estado != 1 and gdd.id = $idRegistro");

			
			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}

	static public function mdlMostrarReportDevolucionDetalle($idReport){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT rd.id as numReport, c.id as idConstructora, c.nombre as constructora, o.id as idObra, o.nombre as obra, rd.fecha_report as fecha, rd.estado as estado FROM report_devolucion rd JOIN constructoras c ON rd.id_constructoras = c.id JOIN obras o ON rd.id_obras = o.id where rd.id = $idReport");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlEquiposParaCambio($constructora, $obra){

		$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idRegistro, ne.descripcion as equipo, ne.modelo as modelo, e.codigo as codigo, m.descripcion as marca, gd.numero_guia as gd FROM guia_despacho gd JOIN guia_despacho_detalle gdd ON gd.id = gdd.id_guia join equipos e ON gdd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id WHERE gd.id_constructoras = $constructora and id_obras = $obra and gdd.id_tipo_movimiento = 11 and gdd.validado = 1 and gdd.match_cambio is null and gdd.registro_eliminado = false and gdd.tipo_guia = 'A' ORDER BY ne.descripcion");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlEquiposCambiados($constructora, $obra, $match){

		$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idRegistro, ne.descripcion as equipo, ne.modelo as modelo, e.codigo as codigo, m.descripcion as marca, gd.numero_guia as gd FROM guia_despacho gd JOIN guia_despacho_detalle gdd ON gd.id = gdd.id_guia join equipos e ON gdd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id WHERE gd.id_constructoras = $constructora and id_obras = $obra and gdd.id_tipo_movimiento = 11 and gdd.match_cambio = $match and gdd.registro_eliminado = false and gdd.tipo_guia = 'A'");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	//************************VALIDACION EQUIPOS RETIRADOS PROCESO POR EQUIPO**********

	static public function mdlValidaEquipoRetiro($datos){

		
		$idRegistro = $datos["idRegistro"];
		$tipo = $datos["tipo"];

		if($tipo == 'V'){
			$estado = 1; //VUELVE LOS EQUIPOS A DISPONIBLE
			$estado_valido = 0;
		}

		if($tipo == 'Q'){
			$estado = 16; //VUELVE LOS EQUIPOS A POR VALIDAR RETIRO OBRA
			$estado_valido = 1;
		}
		
       $sqlGuia = Conexion::conectar()->prepare("UPDATE equipos e JOIN guia_despacho_detalle gdd ON e.id = gdd.id_equipo SET e.id_estado = $estado, e.tiene_movimiento = 1, gdd.validado_retiro = $estado_valido WHERE gdd.id = $idRegistro"); 
            	
         
	
		if($sqlGuia -> execute()){
			
			   return "ok";	
		
		}else{

			return "error";	

		}

		$sqlGuia -> close();

		$sqlGuia = null;

	}	

}