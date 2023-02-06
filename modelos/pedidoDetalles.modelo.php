<?php

require_once "conexion.php";

class ModeloPedidoDetalles{

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarPedidoDetalle($tabla, $datos){

		  //id_nombre_equipos es el id de la categoria del equipo, se modifica para que solo tome las categorias en el pedido de obras

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_pedido_equipo, id_nombre_equipo, tipo, observaciones, id_constructora, id_obra) VALUES (:id_pedido, :id_nombre_equipos, :tipo, :detalle, :constructora, :obra)");

		$stmt->bindParam(":id_nombre_equipos", $datos["id_nombre_equipos"], PDO::PARAM_INT);
		$stmt->bindParam(":id_pedido", $datos["id_pedido"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo", strtoupper($datos["tipo"]), PDO::PARAM_INT);
		$stmt->bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);	
		$stmt->bindParam(":constructora", $datos["constructora"], PDO::PARAM_INT);
		$stmt->bindParam(":obra", $datos["obra"], PDO::PARAM_INT);	
		
		
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

	static public function mdlEliminarEquipoPedido($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM pedido_equipo_detalle WHERE id = $id");

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlFinalizaPedido($id){

		$estado = 8;

		$stmt = Conexion::conectar()->prepare("UPDATE pedido_equipo SET estado = $estado WHERE id = $id");

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlPedidoPorId($id){

		$stmt = Conexion::conectar()->prepare("SELECT c.categoria, pde.id_guia_despacho, e.descripcion as tipo, pde.observaciones as detalle, pde.cantidad_guia as entrega, pde.id as id FROM pedido_equipo_detalle pde join categorias c on pde.id_nombre_equipo = c.id join estados e on pde.tipo = e.id where pde.id_pedido_equipo = $id order by id desc");

		
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