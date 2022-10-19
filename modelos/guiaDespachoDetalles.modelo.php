<?php

require_once "conexion.php";
session_start();

class ModeloGuiaDespachoDetalles{

	
	/*=============================================
	REGISTRO 
	=============================================*/
	static public function mdlIngresarGuiaDespachoDetalle($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO guia_despacho_detalle(id_guia, id_equipo, precio_arriendo, fecha_arriendo,detalle,fecha_devolucion,id_tipo_movimiento,contrato, devuelto) VALUES (:idGuia, :idEquipo, :precio, :fechaArriendo, :detalle, :fechaDevolucion, :movimiento, :contrato, 0)");

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
				$estado = 17; //POR VALIDAR ENTREGA OBRA
	          $stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = $estado WHERE id = $id");

	          $stmt2->execute();
			    

			  return 1;

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlIngresarGuiaDespachoDetalleTraslado($datos){

		date_default_timezone_set('America/Santiago');
        $hoy = date('Y-m-d');

		$stmt = Conexion::conectar()->prepare("INSERT INTO guia_despacho_detalle(id_guia, id_equipo, precio_arriendo, fecha_arriendo, tipo_guia, id_pedido_interno_detalle ) VALUES (:idGuia, :idEquipo, :precio, :hoy, :tipoGuia, :id_pedido_interno)");

		$stmt->bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
		$stmt->bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", strtoupper($datos["precio"]), PDO::PARAM_INT);
		$stmt->bindParam(":hoy", $hoy, PDO::PARAM_STR);
		$stmt->bindParam(":tipoGuia", strtoupper($datos["tipoGuia"]), PDO::PARAM_STR);
		$stmt->bindParam(":id_pedido_interno", strtoupper($datos["id_pedido_interno"]), PDO::PARAM_INT);
        
		
		
		if($stmt->execute()){
			
				$id = $datos["idEquipo"];
				$estado = 5; //EN TRASLADO
	          $stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = $estado WHERE id = $id");

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

	static public function mdlEliminarEquipoGuiaDespacho($id,$idEquipo,$idUsuario,$numeroGuia){

		
      if($numeroGuia == 0){
		$stmt = Conexion::conectar()->prepare("DELETE FROM guia_despacho_detalle WHERE id = $id");
      }else{
		date_default_timezone_set('America/Santiago');
        $hoy = date('Y-m-d H:i:s');

        $stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET registro_eliminado = true, usuario_elimina = $idUsuario, fecha_elimina = :hoy WHERE id = $id");

        $stmt->bindParam(":hoy", $hoy, PDO::PARAM_STR);
       }
		
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

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.precio_arriendo as precio, gd.fecha_arriendo as fecha, es.descripcion as movimiento,  gd.devuelto as devuelto, gd.validado as validado, gd.match_cambio FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN estados es ON gd.id_tipo_movimiento = es.id WHERE gd.id_guia = $idGuia and gd.tipo_guia = 'A' and gd.registro_eliminado = false order by gd.id desc");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlGuiaDespachoTrasladoPorId($idGuia){

		$stmt = Conexion::conectar()->prepare("SELECT gd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.precio_arriendo as precio, gd.fecha_arriendo as fecha, gd.validado as validado, c.categoria  FROM guia_despacho_detalle gd JOIN equipos e ON gd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN categorias c on ne.id_categoria = c.id WHERE gd.id_guia = $idGuia and gd.registro_eliminado = false and gd.tipo_guia = 'T' order by gd.id desc");

		
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

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM guia_despacho_detalle WHERE devuelto = 1 and id = $idRegistroDetalle");

			
			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}



static public function mdlValidarEquipoRecepcionado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET validado = 0 WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);

		if($stmt -> execute()){

			$estado = 2; //VALIDA A ESTADO ARRENDADO
			$stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET id_estado = $estado WHERE id = :idEquipo");

		    $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		    $stmt2 -> execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}

static public function mdlQuitarValidarEquipoRecepcionado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET validado = 1 WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);

		if($stmt -> execute()){

			$estado = 17; //POR VALIDAR ENTREGA OBRA
			$stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET id_estado = $estado WHERE id = :idEquipo");

		    $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		    $stmt2 -> execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}	


	static public function mdlValidarEquipoRecepcionadoTraslado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET validado = 0 WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);

		if($stmt -> execute()){

			$estado = 1; //DEJA EL EQUIPO DISPONIBLE EN LA BODEGA RECEPCIONADA
			$stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET id_estado = $estado, id_sucursal = :sucursal WHERE id = :idEquipo");

		    $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		    $stmt2 -> bindParam(":sucursal", $datos["idSucursal"], PDO::PARAM_INT);
		    $stmt2 -> execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}

	static public function mdlQuitarValidarEquipoTraslado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET validado = 1 WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);

		if($stmt -> execute()){

			$estado = 5; //ESTADO EN TRANSITO TRASLADO
			$stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET id_estado = $estado, id_sucursal = :idSucursalOrigen WHERE id = :idEquipo");

		    $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		    $stmt2 -> bindParam(":idSucursalOrigen", $datos["idSucursalOrigen"], PDO::PARAM_INT);
		    $stmt2 -> execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}	


}

