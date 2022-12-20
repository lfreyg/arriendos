<?php

require_once "conexion.php";

class ModeloObras{

	

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarObras($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();			
			return $stmt -> fetch();			

		

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarObrasActivas($tabla, $item, $valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado = 1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarObrasSeleccion($valor){

		    $id = $valor;

			$stmt = Conexion::conectar()->prepare("SELECT * FROM obras where id_constructoras = $id and estado = 1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarObrasIdConstructoras($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	CREAR 
	=============================================*/

	static public function mdlIngresarObra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_constructoras, nombre, contacto,direccion,telefono,email,forma_cobro_id) VALUES (:idConstructora,:nombre,:contacto,:direccion,:telefono,:email,:tipo_cobro_id)");

		$stmt->bindParam(":idConstructora", $datos['idConstructora'], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);
		$stmt->bindParam(":email", strtolower($datos['email']), PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cobro_id", $datos['tipo_cobro_id'], PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR 
	=============================================*/

	static public function mdlEditarObra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, contacto = :contacto, direccion = :direccion, telefono = :telefono, email = :correo, forma_cobro_id = :cobro WHERE id = :id");

		$stmt->bindParam(":id", strtoupper($datos['id']), PDO::PARAM_STR);				
		$stmt->bindParam(":nombre", strtoupper($datos['nombre']), PDO::PARAM_STR);
		$stmt->bindParam(":contacto", strtoupper($datos['contacto']), PDO::PARAM_STR);
		$stmt->bindParam(":direccion", strtoupper($datos['direccion']), PDO::PARAM_STR);
		$stmt->bindParam(":telefono", strtoupper($datos['telefono']), PDO::PARAM_STR);
		$stmt->bindParam(":correo", strtolower($datos['correo']), PDO::PARAM_STR);
		$stmt->bindParam(":cobro", strtolower($datos['cobro']), PDO::PARAM_STR);
		

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

	static public function mdlBorrarObra($tabla, $datos){

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

	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/

	static public function mdlActualizar($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	

    static public function mdlMostrarObrasSoloConEquiposActivos($idConstructora){

		    
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT o.id as id, o.nombre as nombre FROM guia_despacho_detalle gdd join guia_despacho gd on gdd.id_guia = gd.id join obras o on gd.id_obras = o.id where gdd.devuelto = 0 and o.id_constructoras = $idConstructora and gdd.registro_eliminado = false and validado = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarObrasPorId($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT o.id, o.id_constructoras, o.nombre, o.contacto, o.direccion, o.telefono, o.email, o.forma_cobro_id, o.estado, tc.descripcion as tipoCobro, c.nombre as constructora FROM obras o join tipo_cobro tc on o.forma_cobro_id = tc.id JOIN constructoras c ON o.id_constructoras = c.id WHERE o.id = $id");
			$stmt -> execute();			
			return $stmt -> fetch();			

		    $stmt -> close();

		    $stmt = null;

	}

	

}

