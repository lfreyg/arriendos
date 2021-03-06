<?php

require_once "conexion.php";

class ModeloGuiaDespacho{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarGuiaDespacho($idSucursal){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT gd.id as id, eo.razon_social as empresa, gd.numero_guia as guia, gd.fecha_guia as fecha, c.nombre as constructora, o.nombre as obra, gd.oc as oc, gd.adjunto as adjunto, gd.estado_guia as idestado, e.descripcion as estado, tg.id as idtransporte, tg.nombre as chofer FROM guia_despacho gd JOIN empresas_operativas eo ON gd.id_empresa = eo.id JOIN constructoras c ON gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id JOIN estados e ON gd.estado_guia = e.id LEFT JOIN transporte_guia tg ON gd.id_transporte_guia = tg.id  where gd.id_sucursal = $idSucursal and gd.tipo_guia = 'A' order by gd.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoDetalle($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT gd.estado_guia as estadoGuia, eo.id as idEmpresa, eo.razon_social as empresa, gd.numero_guia as guia, gd.fecha_guia as fecha, c.rut as rutConstructora, c.nombre as constructora, o.nombre as obra, gd.oc as oc, gd.fecha_termino as fechaTermino, gd.rut_empresa_transporte as rutTransporte, gd.patente_transportista as patente, gd.rut_transportista as rutChofer, gd.nombre_transportista as chofer, gd.id_constructoras as idConstructora, gd.id_obras as idObra FROM guia_despacho gd JOIN empresas_operativas eo ON gd.id_empresa = eo.id JOIN constructoras c ON gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id where gd.id = $id");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarGuiaDespachoUnico($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho WHERE id = $id");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}

	

	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarGuiaDespacho($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_empresa, fecha_guia, id_constructoras, id_obras, id_sucursal, adjunto, oc, fecha_termino, id_transporte_guia, rut_empresa_transporte, rut_transportista, nombre_transportista, patente_transportista, creado_por, tipo_guia) VALUES (:id_empresa,:fecha_guia,:id_constructora, :id_obra, :id_sucursal, :adjunto, :oc, :fecha_termino, :id_transporte_guia, :rut_empresa_transporte, :rut_transportista, :nombre_transportista, :patente_transportista, :creado_por, :tipoGuia)");

		$stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_guia", $datos["fecha_guia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);	
		$stmt->bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_STR);
		$stmt->bindParam(":id_transporte_guia", $datos["id_transporte_guia"], PDO::PARAM_INT);	
		$stmt->bindParam(":rut_empresa_transporte", $datos["rut_empresa_transporte"], PDO::PARAM_STR);
		$stmt->bindParam(":rut_transportista", $datos["rut_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_transportista", $datos["nombre_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":patente_transportista", $datos["patente_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoGuia", $datos["tipoGuia"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from guia_despacho");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	

	static public function mdlEditarGuiaDespacho($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_guia = :fecha_guia, id_constructoras = :id_constructora, id_obras = :id_obra, adjunto = :adjunto, oc =:oc, fecha_termino =:fecha_termino, id_transporte_guia =:id_transporte_guia, rut_empresa_transporte =:rut_empresa_transporte, rut_transportista =:rut_transportista, nombre_transportista =:nombre_transportista, patente_transportista =:patente_transportista where id = :id");

		$stmt->bindParam(":fecha_guia", $datos["fecha_guia"], PDO::PARAM_STR);
		$stmt->bindParam(":id_constructora", $datos["id_constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":id_obra", $datos["id_obra"], PDO::PARAM_INT);					
		$stmt->bindParam(":adjunto", $datos["adjunto"], PDO::PARAM_STR);
		$stmt->bindParam(":oc", $datos["oc"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino", $datos["fecha_termino"], PDO::PARAM_STR);
		$stmt->bindParam(":id_transporte_guia", $datos["id_transporte_guia"], PDO::PARAM_INT);	
		$stmt->bindParam(":rut_empresa_transporte", $datos["rut_empresa_transporte"], PDO::PARAM_STR);
		$stmt->bindParam(":rut_transportista", $datos["rut_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_transportista", $datos["nombre_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":patente_transportista", $datos["patente_transportista"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlEliminarGuiaDespacho($id){
       
       $estado = 1; //VUELVE LOS EQUIPOS A DISPONIBLE
		
       $sqlGuia = Conexion::conectar()->prepare("UPDATE equipos e JOIN guia_despacho_detalle gdd ON e.id = gdd.id_equipo SET e.id_estado = $estado WHERE gdd.id_guia = $id"); 
               $sqlGuia->execute();

		$stmt = Conexion::conectar()->prepare("DELETE FROM guia_despacho WHERE id = $id");
		
		if($stmt -> execute()){
           
           
			$stmt2 = Conexion::conectar()->prepare("DELETE FROM guia_despacho_detalle WHERE id_guia = $id");		
			$stmt2 -> execute();
			

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ANULAR 
	=============================================*/

	static public function mdlAnularGuiaDespacho($id){

		$estado = 1; //VUELVE LOS EQUIPOS A DISPONIBLE

		 $sqlGuia = Conexion::conectar()->prepare("UPDATE equipos e JOIN guia_despacho_detalle gdd ON e.id = gdd.id_equipo SET e.id_estado = $estado WHERE gdd.id_guia = $id"); 
               $sqlGuia->execute();

		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho SET estado_guia = 14 WHERE id = $id");
		
		if($stmt -> execute()){
           
           $stmt2 = Conexion::conectar()->prepare("DELETE FROM guia_despacho_detalle WHERE id_guia = $id");		
		   $stmt2 -> execute();
			

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaEquipoDevueltoParaGuiaCompleta($idGuia){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho_detalle WHERE devuelto > 0 and id_guia = $idGuia");

			
			$stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

		


}