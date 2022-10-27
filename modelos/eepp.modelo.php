<?php

require_once "conexion.php";

class ModeloEEPP{

	

	

	static public function mdlMostrarConstructoraEEPP($fecha){

       $fecha = date('Y-m-d', strtotime($fecha)); 

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT c.id as id, c.rut as rut, c.nombre as nombre FROM guia_despacho_detalle gdd join guia_despacho gd on gdd.id_guia = gd.id join constructoras c on gd.id_constructoras = c.id where gdd.registro_eliminado = false and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') order by c.nombre");

	
		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarObrasEEPP($idConstructora, $fecha){

		    
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT o.id as id, o.nombre as nombre FROM guia_despacho_detalle gdd join guia_despacho gd on gdd.id_guia = gd.id join obras o on gd.id_obras = o.id where o.id_constructoras = $idConstructora and gdd.registro_eliminado = false and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') ORDER BY o.nombre");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarEquiposParaCobro($idObra, $fecha){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idGuiaDetalle, gd.numero_guia as guia, gdd.contrato as contrato, c.categoria as categoria, e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, gdd.fecha_arriendo as fecha_arriendo, gdd.fecha_devolucion_real as fecha_devolucion, fecha_retiro_obra as fecha_retiro, gdd.precio_arriendo as precio, gdd.devolucion_tipo as tipo_devolucion, gdd.devuelto as devuelto, gdd.match_cambio as match_cambio, gdd.fecha_ultimo_cobro as ultimo_cobro, gdd.id_report_devolucion as report_devolucion, estados.descripcion as nombreDevolucion FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id join categorias c on ne.id_categoria = c.id left join estados on gdd.devolucion_tipo = estados.id WHERE gdd.registro_eliminado = false and gd.id_obras = $idObra and gdd.validado = 0 and gdd.fecha_arriendo <= '$fecha' and (gdd.fecha_ultimo_cobro IS NULL or gdd.fecha_ultimo_cobro < '$fecha') order by gdd.contrato desc, ne.descripcion");		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	
	

}

