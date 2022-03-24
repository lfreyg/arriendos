<?php

require_once "conexion.php";

class ModeloFacturasDetalles{

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarFacturasDetalle($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_nombre_equipos, id_factura, codigo, numero_serie, precio_compra) VALUES (:id_nombre_equipos, :id_factura, :codigo, :numero_serie, :precio_compra)");

		$stmt->bindParam(":id_nombre_equipos", $datos["id_nombre_equipos"], PDO::PARAM_INT);
		$stmt->bindParam(":id_factura", $datos["id_factura"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", strtoupper($datos["codigo"]), PDO::PARAM_STR);
		$stmt->bindParam(":numero_serie", strtoupper($datos["numero_serie"]), PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_INT);
		
		
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

	static public function mdlEliminarEquipoCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	static public function mdlFacturaPorIdFactura($datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM equipos WHERE id_factura = :id order by id desc");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);		

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarCodigos($tabla, $item, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT codigo FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();		

		   $stmt -> close();

		   $stmt = null;

	}


}