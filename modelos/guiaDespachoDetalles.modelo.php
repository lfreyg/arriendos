<?php

require_once "conexion.php";

class ModeloGuiaDespachoDetalles{

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarGuiaDespachoDetalle($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_guia, id_equipo, precio_arriendo, fecha_arriendo,detalle,fecha_devolucion,id_tipo_movimiento,contrato) VALUES (:idGuia, :idEquipo, :precio, :fechaArriendo, :detalle, :fechaDevolucion, :movimiento, :contrato)");

		$stmt->bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
		$stmt->bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", strtoupper($datos["precio"]), PDO::PARAM_INT);
		$stmt->bindParam(":fechaArriendo", strtoupper($datos["fechaArriendo"]), PDO::PARAM_STR);
		$stmt->bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);
		$stmt->bindParam(":fechaDevolucion", strtoupper($datos["fechaDevolucion"]), PDO::PARAM_STR);
		$stmt->bindParam(":movimiento", strtoupper($datos["movimiento"]), PDO::PARAM_INT);	
		$stmt->bindParam(":contrato", strtoupper($datos["contrato"]), PDO::PARAM_INT);			
		
		
		if($stmt->execute()){
			
				$id = $datos["idEquipo"];
	          $stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = 2 WHERE id = $id");

	          $stmt2->execute();
			    

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

	static public function mdlEliminarEquipoGuiaDespacho($id,$idEquipo){

		$stmt = Conexion::conectar()->prepare("DELETE FROM guia_despacho_detalle WHERE id = $id");

		
		if($stmt -> execute()){			
	                
	          $stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = 1 WHERE id = $idEquipo");

	          $stmt2->execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlFinalizaGuia($idGuia,$idEmpresa){
               
               $estado = 13;
		       
		       $sqlGuia = Conexion::conectar()->prepare("UPDATE guia_despacho gd JOIN dte d ON gd.id_empresa = d.id_empresa_operativa SET gd.numero_guia = d.numero_guia, gd.estado_guia = $estado WHERE gd.id = $idGuia and d.id_empresa_operativa = gd.id_empresa"); 
               $sqlGuia->execute();                  

               $sqlNuevaGuia = Conexion::conectar()->prepare("UPDATE dte SET numero_guia = numero_guia + 1 where id_empresa_operativa = $idEmpresa"); 
              	

				
		if($sqlNuevaGuia -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlGuiaDespachoPorId($idGuia){

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.precio_arriendo as precio, gd.fecha_arriendo as fecha, es.descripcion as movimiento,  gd.devuelto as devuelto FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN estados es ON gd.id_tipo_movimiento = es.id WHERE gd.id_guia = $idGuia order by gd.id desc");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEquipoArriendoPorId($idArriendo){

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.precio_arriendo as precio, gd.fecha_arriendo as fecha, gd.id_tipo_movimiento as movimiento, gd.detalle as detalle FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id WHERE gd.id = $idArriendo");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	GUARDAR EDITAR 
	=============================================*/

	static public function mdlEditarEquiposGuiaDespacho($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET fecha_arriendo = :fecha_arriendo, id_tipo_movimiento = :id_tipo_movimiento, detalle = :detalle WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":fecha_arriendo", strtoupper($datos["fecha_arriendo"]), PDO::PARAM_STR);
		$stmt -> bindParam(":id_tipo_movimiento", $datos["id_tipo_movimiento"], PDO::PARAM_INT);
		$stmt -> bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);	
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	

	static public function mdlValidaEquipoDevuelto($idRegistroDetalle){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho_detalle WHERE devuelto > 0 and id = $idRegistroDetalle");

			
			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}

}