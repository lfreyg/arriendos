<?php
require_once "conexion.php";

class ModeloCargaMasivaPrecios{

	static public function mdlConsultaListaEquipos(){

		$stmt = Conexion::conectar()->prepare("SELECT ne.id as id, c.categoria as categoria, m.descripcion as marca, ne.descripcion as tipoEquipo, ne.modelo as modelo, ne.precio as precio FROM nombre_equipos ne join categorias c on ne.id_categoria = c.id join marcas m on ne.id_marca = m.id where ne.estado = 1 order by c.categoria, ne.descripcion");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;

	}
	
 
  static public function mdlIngresarListaEquipos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_constructoras, id_obras, id_nombre_equipos, precio, usuario) VALUES (:id_constructoras, :id_obras, :id_nombre_equipos, :precio, :usuario)");

		$stmt->bindParam(":id_constructoras", $datos["id_constructoras"], PDO::PARAM_STR);
		$stmt->bindParam(":id_obras", $datos["id_obras"], PDO::PARAM_STR);
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

	static public function mdlEliminarPreciosObra($id){
		$stmt = Conexion::conectar()->prepare("DELETE FROM precios_clientes WHERE id_obras = $id");

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlObrasConConvenio($id){

		$stmt = Conexion::conectar()->prepare("SELECT c.categoria as categoria, m.descripcion as marca, ne.descripcion as tipoEquipo, ne.modelo as modelo, ne.precio as precio, pcl.precio as precio_convenio, pcl.creado as fecha_creado FROM precios_clientes pcl join nombre_equipos ne on pcl.id_nombre_equipos = ne.id join categorias c on ne.id_categoria = c.id join marcas m on ne.id_marca = m.id WHERE pcl.id_obras = $id order by c.categoria, ne.descripcion;");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;

	}

	static public function mdlObrasConstructora($id){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT c.nombre as nombreConstructora, o.nombre as nombreObra, o.id as idObra FROM precios_clientes pc join obras o on pc.id_obras = o.id join constructoras c on o.id_constructoras = c.id where c.id = $id GROUP BY nombreConstructora, nombreObra,idObra order by o.nombre");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;

	}



}