<?php

require_once "conexion.php";

class ModeloEstados{	
	

    
	static public function mdlEstadosDisponibles($idUsuario){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, descripcion FROM estados where tipo_estado = 'ESTADO' and id not in (select id_estado from usuario_tipo_estado where id_usuario = $idUsuario) order by descripcion");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlEstadosSeleccionados($idUsuario){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT es.id as id, e.descripcion, e.id as id_estado FROM usuario_tipo_estado es JOIN estados e ON es.id_estado = e.id where es.id_usuario = $idUsuario order by e.descripcion");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	
	static public function mdlAgregaPermiso($datos){

		 $stmt = Conexion::conectar()->prepare("INSERT INTO usuario_tipo_estado(id_usuario, id_estado) VALUES (:idUsuario, :idEstado)");

		
		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_INT);
		
		
		

		if($stmt->execute()){

			   	return 'ok'; 
		}
	}


	static public function mdlQuitarPermiso($datos){

		 $stmt = Conexion::conectar()->prepare("DELETE FROM usuario_tipo_estado WHERE id = :idRegistro");

		
		$stmt->bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);
		
		if($stmt->execute()){

			   	return 'ok'; 
		}
	}

	

}