<?php
require_once "conexion.php";

class ModeloCargaMasivaPreciosLista{

	static public function mdlConsultaPrecioLista(){

		$stmt = Conexion::conectar()->prepare("SELECT ne.id as id, c.categoria as categoria, m.descripcion as marca, ne.descripcion as tipoEquipo, ne.modelo as modelo, ne.precio as precio FROM nombre_equipos ne join categorias c on ne.id_categoria = c.id join marcas m on ne.id_marca = m.id where ne.estado = 1 order by c.categoria, ne.descripcion");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;

	}
	
 
  static public function mdlActualizarPrecioLista($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE nombre_equipos SET precio = :precio, usuario = :usuario WHERE id = :id_nombre_equipos");

		$stmt->bindParam(":id_nombre_equipos", $datos["id_nombre_equipos"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	

	



}