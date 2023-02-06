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
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaArriendo", $datos["fechaArriendo"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);
		$stmt->bindParam(":fechaDevolucion", $datos["fechaDevolucion"], PDO::PARAM_STR);
		$stmt->bindParam(":movimiento", $datos["movimiento"], PDO::PARAM_INT);	
		$stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_INT);			
		
		
		if($stmt->execute()){

			       $sql = "SELECT max(id) AS id from guia_despacho_detalle";
			  
                      $rs = Conexion::conectar()->query($sql);
                       while($row=$rs->fetch())
                        {
                        $idInsert = $row["id"];
                        }   

			  
			
				$id = $datos["idEquipo"];
				$estado = 17; //POR VALIDAR ENTREGA OBRA
	          $stmt2 = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = $estado WHERE id = $id");

	          $stmt2->execute();

	          $idPedidoObra = $datos["idPedidoObra"];

	          if($idPedidoObra != 0){   

	                

                    $stmt3 = Conexion::conectar()->prepare("UPDATE pedido_equipo_detalle SET id_guia_despacho = :idGuia, id_equipo = :idEquipo, id_guia_detalle = :idInsert WHERE id = $idPedidoObra");

                    $stmt3->bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
                    $stmt3->bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
                    $stmt3->bindParam(":idInsert", $idInsert, PDO::PARAM_INT);
                    $stmt3->execute();

	          }
			    

			  return 1;

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	static public function mdlIngresarMaterialGuiaDespacho($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO guia_despacho_materiales(id_materiales_insumos, cantidad, precio, id_guia, fecha, se_cobra) VALUES (:idMaterial, :cantidad, :precio, :idGuia, :fecha, :seCobra)");
        
        
		$stmt->bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
		$stmt->bindParam(":idMaterial", $datos["idMaterial"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":seCobra", $datos["seCobra"], PDO::PARAM_STR);			
		
		
		if($stmt->execute()){
			
				$id = $datos["idMaterial"];	
				$cantidad = $datos["cantidad"];			
	          $stmt2 = Conexion::conectar()->prepare("UPDATE materiales_insumos SET cantidad_sale = cantidad_sale + $cantidad WHERE id = $id");

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
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
		$stmt->bindParam(":hoy", $hoy, PDO::PARAM_STR);
		$stmt->bindParam(":tipoGuia", strtoupper($datos["tipoGuia"]), PDO::PARAM_STR);
		$stmt->bindParam(":id_pedido_interno", $datos["id_pedido_interno"], PDO::PARAM_INT);
        
		
		
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

	           $stmt3 = Conexion::conectar()->prepare("UPDATE pedido_equipo_detalle SET id_guia_despacho = null, id_guia_detalle = null, id_equipo = null, fecha_entrega = null WHERE id_guia_detalle = $id");

	          $stmt3->execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	


    static public function mdlEliminarEquipoGuiaTaller($id,$idLog,$idUsuario,$numeroGuia){

		
      if($numeroGuia == 0){
		$stmt = Conexion::conectar()->prepare("DELETE FROM guia_despacho_detalle WHERE id = $id");
      }else{
		date_default_timezone_set('America/Santiago');
        $hoy = date('Y-m-d H:i:s');

        $stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle SET registro_eliminado = true, usuario_elimina = $idUsuario, fecha_elimina = :hoy WHERE id = $id");

        $stmt->bindParam(":hoy", $hoy, PDO::PARAM_STR);
       }
		
		if($stmt -> execute()){			
	                
	          $stmt2 = Conexion::conectar()->prepare("UPDATE log_cambia_estados SET id_guia_despacho_envia = null WHERE id = $idLog");

	          $stmt2->execute();

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	




	static public function mdlEliminarMaterialGuiaDespacho($idRegistroGuia,$idMaterial,$numeroGuia,$cantidad){

		
      if($numeroGuia == 0){
		$stmt = Conexion::conectar()->prepare("DELETE FROM guia_despacho_materiales WHERE id = $idRegistroGuia");
      }else{
		
        $stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales SET registro_eliminado = true WHERE id = $idRegistroGuia");
       }
		
		if($stmt -> execute()){			
	                
	          $stmt2 = Conexion::conectar()->prepare("UPDATE materiales_insumos SET cantidad_sale = cantidad_sale - $cantidad WHERE id = $idMaterial");

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

		$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gdd.precio_arriendo as precio, gdd.fecha_arriendo as fecha, es.descripcion as movimiento,  gdd.devuelto as devuelto, gdd.validado as validado, gdd.match_cambio, gd.numero_guia as guia FROM guia_despacho_detalle gdd JOIN equipos e ON gdd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN estados es ON gdd.id_tipo_movimiento = es.id join guia_despacho gd ON gdd.id_guia = gd.id WHERE gdd.id_guia = $idGuia and gdd.tipo_guia = 'A' and gdd.registro_eliminado = false order by gdd.id desc");

		
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

	static public function mdlEditarMaterialGuiaDespacho($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales SET cantidad = :cantidad, precio = :precio, se_cobra = :cobra  WHERE id = :idRegistro");
         
         			
		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);		
		$stmt -> bindParam(":cobra", $datos["cobra"], PDO::PARAM_INT);
		


		if($stmt -> execute()){

			$cantidadActual = $datos["cantidadActual"];
			$cantidad = $datos["cantidad"];
			$idMaterial = $datos["idMaterial"];
            
            $stmt2 = Conexion::conectar()->prepare("UPDATE materiales_insumos SET cantidad_sale = (cantidad_sale - $cantidadActual) + $cantidad WHERE id = $idMaterial");

            $stmt2 -> execute();


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


	static public function mdlValidarMaterialRecepcionado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales SET validado = 0 WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt = null;
		

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

	static public function mdlQuitarValidarMaterialRecepcionado($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE guia_despacho_materiales SET validado = 1 WHERE id = :idRegistro");

		$stmt -> bindParam(":idRegistro", $datos["idRegistro"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt = null;
		

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

	//MATERIALES EN GUIA DE DESPACHO

	static public function mdlMaterialesGuiaDespacho($idGuia){

		$stmt = Conexion::conectar()->prepare("SELECT gdm.id as idRegistro, gdm.id_materiales_insumos as idMaterial, mi.codigo as codigoMaterial, mi.descripcion as material, gdm.precio as precioMaterial, gdm.cantidad as cantidad, gdm.fecha as fecha, gdm.id_eepp as eepp, gdm.validado as validado, gdm.se_cobra as cobro, gd.numero_guia as guia FROM guia_despacho_materiales gdm JOIN materiales_insumos mi ON gdm.id_materiales_insumos = mi.id JOIN guia_despacho gd ON gdm.id_guia = gd.id WHERE gdm.registro_eliminado = false and gdm.id_guia = $idGuia order by mi.descripcion");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEditarMaterialesGuia($idRegistroMaterial){

		$stmt = Conexion::conectar()->prepare("SELECT gdm.id as idRegistro, gdm.id_materiales_insumos as idMaterial, mi.codigo as codigo, mi.descripcion as material, mi.cantidad_entra - mi.cantidad_sale as stock, gdm.precio as precio, gdm.cantidad as cantidad, gdm.se_cobra as cobra FROM guia_despacho_materiales gdm join materiales_insumos mi ON gdm.id_materiales_insumos = mi.id WHERE gdm.id = $idRegistroMaterial");

		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	//AGREGA REISTRO PARA GUIA TRASLADO A TALLER

	static public function mdlIngresarGuiaDespachoTallerDetalle($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO guia_despacho_detalle(id_guia, id_equipo, precio_arriendo, detalle, tipo_guia, validado) VALUES (:idGuia, :idEquipo, :precio, :detalle, :tipoGuia, 1)");

		$stmt->bindParam(":idGuia", $datos["idGuia"], PDO::PARAM_INT);
		$stmt->bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_INT);		
		$stmt->bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);			
		$stmt->bindParam(":tipoGuia", strtoupper($datos["tipoGuia"]), PDO::PARAM_STR);		
		
		
		if($stmt->execute()){
			
				$id = $datos["idLog"];
				$idGuia = $datos["idGuia"];
	          $stmt2 = Conexion::conectar()->prepare("UPDATE log_cambia_estados SET id_guia_despacho_envia = $idGuia WHERE id = $id");

	          $stmt2->execute();
			    

			  return 1;

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlGuiaDespachoTallerPorId($idGuia){

		$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idRegistro, e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as equipo, ne.modelo as modelo, m.descripcion as marca, gd.numero_guia as guia, ce.id as idLog FROM guia_despacho_detalle gdd JOIN equipos e ON gdd.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho gd ON gdd.id_guia = gd.id JOIN log_cambia_estados ce ON ce.id_equipo = e.id WHERE gdd.id_guia = $idGuia and gdd.tipo_guia = 'TA' and gdd.registro_eliminado = false and ce.id_guia_despacho_envia = $idGuia order by gdd.id desc");

		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


}

