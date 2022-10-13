<?php

require_once "conexion.php";

class ModeloPedidoInternoDetalles{

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarPedidoInternoDetalle($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO pedido_interno_detalle(id_pedido, id_categoria, cantidad, detalle, tengo, disponible, revision) VALUES (:id_pedido, :idCategoria, :cantidad, :detalle, :tengo, :disponible, :revision)");

		$stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_pedido", $datos["id_pedido"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);
		$stmt->bindParam(":tengo", $datos["tengo"], PDO::PARAM_INT);
		$stmt->bindParam(":disponible", $datos["disponible"], PDO::PARAM_INT);
		$stmt->bindParam(":revision", $datos["revision"], PDO::PARAM_INT);		
		
		
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

	static public function mdlEliminarEquipoPedidoInterno($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM pedido_interno_detalle WHERE id = $id");

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlFinalizaPedidoInterno($id){

		$stmt = Conexion::conectar()->prepare("UPDATE pedido_interno SET finalizado = true WHERE id = $id");

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlPedidoInternoPorId($id){

		$stmt = Conexion::conectar()->prepare("SELECT pe.id as id, c.id as idCategoria, c.categoria as categoria, pe.cantidad as cantidad, pe.detalle as detalle, pe.tengo as tengo, pe.disponible as stock, pe.revision as revision FROM pedido_interno_detalle pe join categorias c on pe.id_categoria = c.id where pe.id_pedido = $id order by pe.id desc");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlPedidoInternoUnicoPorId($id){

		$stmt = Conexion::conectar()->prepare("SELECT pe.id as id, c.id as idCategoria, c.categoria as categoria, pe.cantidad as cantidad, pe.detalle as detalle, pe.tengo as tengo, pe.disponible as stock, pe.revision as revision FROM pedido_interno_detalle pe join categorias c on pe.id_categoria = c.id where pe.id = $id");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMiEquipoPorId($id){

		$stmt = Conexion::conectar()->prepare("SELECT pe.id as id, c.id as idCategoria, c.categoria as categoria, pe.cantidad as cantidad, pe.detalle as detalle FROM pedido_interno_detalle pe join categorias c on pe.id_categoria = c.id where pe.id = $id");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaEquipoPorId($idCategoria, $idPedido){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido_interno_detalle where id_categoria = $idCategoria and id_pedido = $idPedido");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function mdlEditarEquiposPedidoInterno($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE pedido_interno_detalle SET  cantidad = :cantidad, detalle = :detalle WHERE id = :idEquipo");

		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt -> bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);	
		$stmt -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlEquipoPedidoInternoDespachado($idPedidoDetalle){

		$stmt = Conexion::conectar()->prepare("SELECT count(*) as despachado FROM guia_despacho_detalle where id_pedido_interno_detalle = $idPedidoDetalle and registro_eliminado = false");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}