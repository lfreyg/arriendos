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

		       $sqlGuia = Conexion::conectar()->prepare("UPDATE guia_despacho gd JOIN dte d ON gd.id_empresa = d.id_empresa_operativa SET gd.numero_guia = d.numero_guia WHERE gd.id = $idGuia and d.id_empresa_operativa = gd.id_empresa"); 
               $sqlGuia->execute();                  

               $sqlNuevaGuia = Conexion::conectar()->prepare("UPDATE dte SET numero_guia = numero_guia + 1 where id_empresa_operativa = $idEmpresa"); 
               $sqlNuevaGuia->execute();



		$estado = 13;

		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho SET estado_guia = $estado WHERE id = $idGuia");

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlGuiaDespachoPorId($idGuia){

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.precio_arriendo as precio, gd.fecha_arriendo as fecha, es.descripcion as movimiento FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN estados es ON gd.id_tipo_movimiento = es.id WHERE gd.id_guia = $idGuia order by gd.id desc");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEquipoPorId($id){

		$stmt = Conexion::conectar()->prepare("SELECT m.descripcion as marca, ne.descripcion as tipo_equipo, ne.modelo as modelo, e.descripcion as tipo, e.id as idTipo, pde.observaciones as detalle, pde.cantidad_guia as entrega, pde.id as id FROM pedido_equipo_detalle pde join nombre_equipos ne on pde.id_nombre_equipo = ne.id join marcas m on ne.id_marca = m.id join categorias c on ne.id_categoria = c.id join estados e on pde.tipo = e.id where pde.id = $id");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function mdlEditarEquiposPedido($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  tipo = :tipo, observaciones = :detalle WHERE id = :id");

		$stmt -> bindParam(":tipo", strtoupper($datos["tipo"]), PDO::PARAM_STR);
		$stmt -> bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);	
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}