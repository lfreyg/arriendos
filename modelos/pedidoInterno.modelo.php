<?php

require_once "conexion.php";

class ModeloPedidoInterno{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarPedidoInterno($idSucursal){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, s.nombre as sucursal, u.nombre as usuario, pe.fecha_creacion as fecha, pe.finalizado as finalizado FROM pedido_interno pe join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id WHERE pe.id_sucursal = $idSucursal and pe.eliminado = false ORDER BY pe.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarPedidoInternoValidar($idSucursal){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, s.nombre as sucursal, u.nombre as usuario, pe.fecha_creacion as fecha, pe.finalizado as finalizado FROM pedido_interno pe join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id WHERE pe.id_sucursal = $idSucursal and pe.eliminado = false and finalizado = true ORDER BY pe.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarPedidoInternoDespacho($idSucursal){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, s.nombre as sucursal, u.nombre as usuario, pe.fecha_creacion as fecha, pe.finalizado as finalizado FROM pedido_interno pe join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id WHERE pe.eliminado = false and pe.finalizado = true and pe.id_sucursal != $idSucursal and despachado = false ORDER BY pe.id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlMostrarPedidoInternoDetalle($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT pe.id as numero, s.id as sucursal, s.nombre as nombreSucursal, u.nombre as usuario, pe.id_sucursal as sucursal, pe.finalizado as final FROM pedido_interno pe join sucursales s on pe.id_sucursal = s.id join usuarios u on pe.id_usuario = u.id WHERE pe.id = $id");

			$stmt -> execute();

			return $stmt -> fetch();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlValidarHacerNuevaGuiaPedido($id){

		
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho where id_pedido_interno = $id and estado_guia = 12");

			$stmt -> execute();

			return $stmt -> fetchAll();		

		    $stmt -> close();

		    $stmt = null;

	}

	static public function mdlValidarPedidoNuevo($idSucursal){

		

			$stmt = Conexion::conectar()->prepare("SELECT count(*) FROM pedido_interno WHERE id_sucursal = $idSucursal and finalizado = false");

		   $stmt -> execute();

		  return $stmt -> fetch();

		  $stmt -> close();

		  $stmt = null;

	}

	

	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarPedidoInterno($datos){

		
		$stmt = Conexion::conectar()->prepare("INSERT INTO pedido_interno(id_sucursal, id_usuario) VALUES (:id_sucursal, :id_usuario)");

		
		$stmt->bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);		
		
		
		if($stmt->execute()){

			$sql = Conexion::conectar()->prepare("SELECT MAX(id) as id from pedido_interno");
 
               $sql->execute();
               return $sql -> fetch();                 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	
	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlEliminarPedidoInterno($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE pedido_interno set eliminado = true, finalizado = true WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			   return "ok";
			
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlValidaEquipoPedido($valor){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido_equipo_detalle WHERE cantidad_guia > 0 and id_pedido_equipo = $valor");

			
			$stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}

		


}