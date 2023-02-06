<?php

require_once "conexion.php";

class ModeloEquipos{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrarEquipos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEquiposDiez($tabla, $item, $valor){

		
			$stmt = Conexion::conectar()->prepare("SELECT fce.numero_factura as factura,fce.fecha_factura as fecha,e.precio_compra as precio,p.nombre as proveedor, ne.descripcion as tipoequipo, ne.modelo as modelo, m.descripcion as marca, ne.foto from equipos e join facturas_compra_equipos fce on e.id_factura = fce.id join proveedores p on fce.id_proveedor = p.id join nombre_equipos ne on e.id_nombre_equipos = ne.id join marcas m on ne.id_marca = m.id order by fce.fecha_factura desc, e.id desc LIMIT 15");

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEquiposMasComprados($anio){

		    $anno = $anio;

			$stmt = Conexion::conectar()->prepare("SELECT ne.descripcion as tipoequipo, SUM(e.precio_compra) as precio, ne.foto as foto, m.descripcion as marca, ne.modelo as modelo FROM equipos e JOIN nombre_equipos ne on e.id_nombre_equipos = ne.id join facturas_compra_equipos fce on e.id_factura = fce.id join marcas m on ne.id_marca = m.id where YEAR(fce.fecha_factura) = $anno GROUP BY e.id_nombre_equipos, ne.id_marca order by precio desc LIMIT 10");

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		

		$stmt -> close();

		$stmt = null;

	}	

	
	/*=============================================
	EDITAR 
	=============================================*/

	static public function mdlEditarEquipos($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  precio_compra = :precio_compra, numero_serie = :numero_serie, codigo = :codigo, id_sucursal = :id_sucursal, codigo_anterior = :codigo, serie_anterior = :numero_serie WHERE id = :id");

		$stmt -> bindParam(":codigo", strtoupper($datos["codigo"]), PDO::PARAM_STR);
		$stmt -> bindParam(":numero_serie", $datos["numero_serie"], PDO::PARAM_STR);		
		$stmt -> bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_INT);		
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_sucursal", $datos["id_sucursal"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

		
	/*=============================================
	BORRAR 
	=============================================*/

	static public function mdlBorrarEquipos($datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM equipos WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	static public function mdlValidarEquipos($valor1){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM equipos WHERE codigo = :valor1 LIMIT 1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_STR);
			

			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}

	static public function mdlSumaTotalFactura($valor1){

		

			$stmt = Conexion::conectar()->prepare("SELECT SUM(precio_compra) as total FROM equipos WHERE id_factura = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			

			$stmt -> execute();
   		    return $stmt -> fetch();
		    $stmt -> close();
		    $stmt = null;

	}

	static public function mdlValidaEquipoBorrar($valor1){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM equipos WHERE tiene_movimiento = 1 and id_factura = :valor1");

			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			

			$stmt -> execute();
   		    return $stmt -> fetchAll();
		    $stmt -> close();
		    $stmt = null;

	}


    
    static public function mdlMostrarEquiposGuiaDespacho($id,$filtro){

		
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id where e.id_estado = 1 and e.id_sucursal = $id order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id where e.id_estado = 1 and e.id_sucursal = $id and e.id_nombre_equipos = $filtro order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	 static public function mdlMostrarEquiposGuiaDespachoTrasladoPedido($id,$filtro){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id where e.id_estado = 1 and e.id_sucursal = $id and ne.id_categoria = $filtro order by ne.descripcion");
			

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEquiposArrendados($filtro,$idObra){

		
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT gd.numero_guia as guia, gdd.id as idGuiaDetalle, e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id WHERE gd.id_obras = $idObra and gdd.devuelto = 0 and gdd.validado = 0 order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT gd.numero_guia as guia, gdd.id as idGuiaDetalle,  e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id WHERE gd.id_obras = $idObra and gdd.devuelto = 0 and gdd.validado = 0 and e.id_nombre_equipos = $filtro order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	 static public function mdlSeleccionarEquiposGuiaDespacho($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.id_nombre_equipos as idTipoEquipo, e.numero_serie as serie,  e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, ne.precio as precio FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id where e.id = $id");
		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlBuscaPrecioConvenio($id,$idObra){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT precio FROM precios_clientes where id_obras = $idObra and id_nombre_equipos = $id");
		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	

//************************MANTENEDOR DE EQUIPOS************************//

	 static public function mdlMostrarEquiposMantenedor($filtro){

		
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id where id_estado = 1 order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id where id_estado = 1 and e.id_nombre_equipos = $filtro order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlMostrarEquiposMantenedorUno($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, ne.precio as precio, su.nombre as sucursal, ne.id as idNombreEquipo, e.id_sucursal as idSucursal, e.creacion as fecha, e.id_estado as idEstado, est.descripcion as estadoEquipo FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est ON e.id_estado = est.id where e.id = $id");
			

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlEditarEquiposMantenedor($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE equipos SET codigo = :codigoEquipo, numero_serie = :serieEquipo, tiene_movimiento = 1, precio_compra = :precioCompra, id_sucursal = :sucursal WHERE id = :idEquipo");

		$stmt -> bindParam(":codigoEquipo", strtoupper($datos["codigoEquipo"]), PDO::PARAM_STR);
		$stmt -> bindParam(":serieEquipo", $datos["serieEquipo"], PDO::PARAM_STR);		
		$stmt -> bindParam(":precioCompra", $datos["precioCompra"], PDO::PARAM_INT);		
		$stmt -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt -> bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_INT);

		if($stmt -> execute()){
            
            $stmt2 = Conexion::conectar()->prepare("INSERT INTO log_mantenedor_equipos(id_equipo,codigo_equipo,serie_equipo,precio_equipo,id_sucursal_equipo,id_usuario) VALUES (:idEquipo, :codigoEquipo, :serieEquipo, :precioCompra, :sucursal, :idUsuario)");
            
            

            $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":codigoEquipo", strtoupper($datos["codigoEquipo"]), PDO::PARAM_STR);
            $stmt2 -> bindParam(":serieEquipo", $datos["serieEquipo"], PDO::PARAM_STR);
            $stmt2 -> bindParam(":precioCompra", $datos["precioCompra"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
         
         if($stmt2 -> execute()){
			   return "ok";
			}
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlMostrarEquiposOrigen($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo_anterior as codigo, e.serie_anterior as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, ne.precio as precio, su.nombre as sucursal, ne.id as idNombreEquipo, e.id_sucursal as idSucursal, e.creacion as fecha FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id where e.id = $id");
			

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlMostrarEquiposHistoria($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT l.codigo_equipo as codigo, l.serie_equipo as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, ne.precio as precio, su.nombre as sucursal, l.fecha_actualizacion as fecha, u.nombre as usuario FROM log_mantenedor_equipos l JOIN equipos e ON l.id_equipo = e.id JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON l.id_sucursal_equipo = su.id JOIN usuarios u ON l.id_usuario = u.id where l.id_equipo = $id ORDER BY l.fecha_actualizacion DESC");
			

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	//*****************************PEDIDO DE EQUIPOS*******************
      static public function mdlMostrarEquiposPedidos($categoria){
           if($categoria == null){
			$stmt = Conexion::conectar()->prepare("SELECT ne.id as id, c.categoria as categoria, m.descripcion as marca, ne.descripcion as equipo, ne.modelo as modelo FROM nombre_equipos ne left join marcas m on ne.id_marca = m.id join categorias c on ne.id_categoria = c.id order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT ne.id as id, c.categoria as categoria, m.descripcion as marca, ne.descripcion as equipo, ne.modelo as modelo FROM nombre_equipos ne left join marcas m on ne.id_marca = m.id join categorias c on ne.id_categoria = c.id where ne.id_categoria = $categoria order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

      }

	//****************************FIN PEDIDO DE EQUIPOS***************

     



     //************************CAMBIO ESTADOS DE EQUIPOS************************//

	 static public function mdlMostrarEquiposEstados($filtro, $sucursal){
               $estado = 32; //ESTADO EN ESPERA DE APROBACION CAMBIO DE ESTADO
		 
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal, e.id_estado as idEstado, est.descripcion as estadoEquipo  FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est on e.id_estado = est.id where e.id_estado != $estado and e.id_sucursal = $sucursal order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal, e.id_estado as idEstado, est.descripcion as estadoEquipo FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est on e.id_estado = est.id where e.id_nombre_equipos = $filtro and e.id_estado != $estado and e.id_sucursal = $sucursal order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	 static public function mdlMostrarEquiposEstadosCodigo($sucursal, $codigo){
               $estado = 32; //ESTADO EN ESPERA DE APROBACION CAMBIO DE ESTADO
		 
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal, e.id_estado as idEstado, est.descripcion as estadoEquipo  FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est on e.id_estado = est.id where e.id_estado != $estado and e.id_sucursal = $sucursal and e.codigo = '$codigo' order by ne.descripcion");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlEstadosEquipos(){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, descripcion FROM estados where tipo_estado = 'ESTADO' order by descripcion");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlTraeDatosArriendoCambioEstado($idEquipo){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT gd.numero_guia, c.nombre as constructora, o.nombre as obra, gdd.id as idGuiaDetalle FROM guia_despacho_detalle gdd join guia_despacho gd on gdd.id_guia = gd.id join constructoras c on gd.id_constructoras = c.id JOIN obras o ON gd.id_obras = o.id WHERE gdd.id_equipo = $idEquipo and gdd.devuelto = 0 and gdd.tipo_guia = 'A'");
		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlCambiarEstadoEquipo($datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = :estadoTransitorio WHERE id = :idEquipo");

		
		$stmt -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt -> bindParam(":estadoTransitorio", $datos["estadoTransitorio"], PDO::PARAM_INT);

		if($stmt -> execute()){
            
            $stmt2 = Conexion::conectar()->prepare("INSERT INTO log_cambia_estados(id_equipo, id_estado_anterior,id_nuevo_estado, fecha_cambio, fecha_termino, id_usuario, id_guia, motivo) VALUES (:idEquipo, :idEstado, :nuevoEstado, :fechaCambio, :fechaCambio, :idUsuario, :idGuiaDetalle, :motivo)");
            
            

            $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":nuevoEstado", $datos["nuevoEstado"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":fechaCambio", $datos["fechaCambio"], PDO::PARAM_STR);
            $stmt2 -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":idGuiaDetalle", $datos["idGuiaDetalle"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":motivo", strtoupper($datos["motivo"]), PDO::PARAM_STR);
         
         if($stmt2 -> execute()){
			  return 'ok';
			}
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlEstadosAprobar($idEstado){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT lce.id as idLog, e.id as idEquipo, lce.id_estado_anterior, lce.id_nuevo_estado, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, su.nombre as sucursal, u.nombre as usuario, est.descripcion as estadoAnterior, est2.descripcion as estadoSolicitado, lce.motivo, lce.fecha_cambio, lce.fecha_real  FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN log_cambia_estados lce ON lce.id_equipo = e.id JOIN usuarios u ON lce.id_usuario = u.id JOIN estados est on lce.id_estado_anterior = est.id JOIN estados est2 ON lce.id_nuevo_estado = est2.id where lce.aprobado = false and e.id_estado = $idEstado order by descripcion");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	



/*
	static public function mdlAprobarEstado($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = :estadoTransitorio WHERE id = :idEquipo");

		
		$stmt -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt -> bindParam(":estadoTransitorio", $datos["estadoTransitorio"], PDO::PARAM_INT);

		if($stmt -> execute()){
            
            $stmt2 = Conexion::conectar()->prepare("INSERT INTO log_cambia_estados(id_equipo, id_estado_anterior,id_nuevo_estado, fecha_cambio, id_usuario, motivo) VALUES (:idEquipo, :idEstado, :nuevoEstado, :fechaCambio, :idUsuario, :motivo)");
            
            

            $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":idEstado", strtoupper($datos["idEstado"]), PDO::PARAM_INT);
            $stmt2 -> bindParam(":nuevoEstado", $datos["nuevoEstado"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":fechaCambio", $datos["fechaCambio"], PDO::PARAM_STR);
            $stmt2 -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
         
         if($stmt2 -> execute()){
			   return "ok";
			}
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}

*/
	static public function mdlValidaAprobacionCambioEstadoEquipo($datos){

		
		$stmt = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = :idEstado WHERE id = :idEquipo");

		
		$stmt -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt -> bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_INT);

		$stmt -> execute();
            
            $stmt2 = Conexion::conectar()->prepare("UPDATE log_cambia_estados SET aprobado = 1, id_usuario_aprueba = :idAprueba WHERE id = :id");
            
            

             $stmt2 -> bindParam(":id", $datos["id"], PDO::PARAM_INT);            
             $stmt2 -> bindParam(":idAprueba", $datos["idAprueba"], PDO::PARAM_INT);
           
         
                $stmt2 -> execute();

		         	   $idEstadoAnterior = $datos["idEstadoAnterior"];

		         	  
		    if($idEstadoAnterior == '2'){
		         $sql = Conexion::conectar()->prepare("UPDATE guia_despacho_detalle gdd JOIN log_cambia_estados lce ON gdd.id = lce.id_guia SET gdd.fecha_devolucion_real = lce.fecha_termino, gdd.devuelto = 1, gdd.id_report_devolucion = 0, gdd.devolucion_tipo = lce.id_nuevo_estado, gdd.detalle_devolucion = lce.motivo, gdd.validado_retiro = 0 WHERE lce.id = :id");

					   $sql -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

					   $sql -> execute();
				    }	 
				    
				      return 'ok';  
		

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlRechazarAprobacionCambioEstadoEquipo($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE equipos SET tiene_movimiento = 1, id_estado = :idEstado WHERE id = :idEquipo");

		
		$stmt -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
		$stmt -> bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_INT);

		if($stmt -> execute()){
            
            $stmt2 = Conexion::conectar()->prepare("DELETE FROM log_cambia_estados WHERE id = :id");
            
            

            $stmt2 -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
           
         
         if($stmt2 -> execute()){
			   return "ok";
			}
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt2 -> close();

		$stmt = null;
		$stmt2 = null;

	}


	static public function mdlTraerSolicitudEstadoPorID($idSolicitud){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT lce.id_estado_anterior, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, su.nombre as sucursal, u.nombre as usuario, est.descripcion as estadoAnterior, est2.descripcion as estadoSolicitado, lce.motivo, lce.fecha_real, lce.fecha_aprueba, u2.nombre as aprobador, lce.fecha_termino, gd.numero_guia, c.nombre as constructora, o.nombre as obra, gdd.fecha_arriendo, gdd.fecha_devolucion_real, gdd.id as idRegistroRevisar, gdd.fecha_ultimo_cobro  FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN log_cambia_estados lce ON lce.id_equipo = e.id JOIN usuarios u ON lce.id_usuario = u.id JOIN usuarios u2 ON lce.id_usuario_aprueba = u2.id LEFT JOIN estados est on lce.id_estado_anterior = est.id JOIN estados est2 ON lce.id_nuevo_estado = est2.id LEFT JOIN guia_despacho_detalle gdd on gdd.id = lce.id_guia LEFT JOIN guia_despacho gd ON gd.id = gdd.id_guia LEFT JOIN constructoras c ON gd.id_constructoras = c.id LEFT JOIN obras o ON gd.id_obras = o.id where lce.id = $idSolicitud ");
		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlTraerHistoriaEstadosEquipo($idEquipo){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT lce.id as idLog, lce.id_estado_anterior, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, su.nombre as sucursal, u.nombre as usuario, est.descripcion as estadoAnterior, est2.descripcion as estadoSolicitado, lce.motivo, lce.fecha_real, lce.fecha_aprueba, u2.nombre as aprobador FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN log_cambia_estados lce ON lce.id_equipo = e.id JOIN usuarios u ON lce.id_usuario = u.id JOIN usuarios u2 ON lce.id_usuario_aprueba = u2.id LEFT JOIN estados est on lce.id_estado_anterior = est.id JOIN estados est2 ON lce.id_nuevo_estado = est2.id WHERE lce.id_equipo = $idEquipo");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	 static public function mdlMostrarEquiposGuiaDespachoTaller($id,$filtro){
          
          $estadoTallerExterno = 21;
          $estadoTallerGarantia = 22;
		
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT ce.id as idLog, e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN log_cambia_estados ce ON e.id = ce.id_equipo WHERE ce.id_guia_despacho_envia is null AND ce.aprobado = true AND (ce.id_nuevo_estado = $estadoTallerExterno OR ce.id_nuevo_estado = $estadoTallerGarantia) order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT ce.id as idLog, e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN log_cambia_estados ce ON e.id = ce.id_equipo WHERE ce.id_guia_despacho_envia is null AND ce.aprobado = true AND (ce.id_nuevo_estado = $estadoTallerExterno OR ce.id_nuevo_estado = $estadoTallerGarantia) and e.id_nombre_equipos = $filtro order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	//************************COSTOS DE REPARACION EQUIPOS************************//

	 static public function mdlMostrarEquiposReparacion($filtro, $sucursal){
               $taller = 20; //TALLER INTERNO
               $tallerExterno = 21; //TALLER EXTERNO
               $garantia = 22; //TALLER GARANTIA
		 
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal, e.id_estado as idEstado, est.descripcion as estadoEquipo FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est on e.id_estado = est.id  where (e.id_estado = $taller or e.id_estado = $tallerExterno or e.id_estado = $garantia) order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal, e.id_estado as idEstado, est.descripcion as estadoEquipo FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est on e.id_estado = est.id where e.id_nombre_equipos = $filtro and (e.id_estado = $taller or e.id_estado = $tallerExterno or e.id_estado = $garantia) order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	 static public function mdlMostrarEquiposReparacionCodigo($sucursal, $codigo){
               $estado = 32; //ESTADO EN ESPERA DE APROBACION CAMBIO DE ESTADO
		 
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, e.precio_compra as precio, su.nombre as sucursal, e.id_estado as idEstado, est.descripcion as estadoEquipo  FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id JOIN estados est on e.id_estado = est.id where e.codigo = '$codigo' order by ne.descripcion");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlAgregaGastoEquipo($datos){
	
		
            
            $stmt2 = Conexion::conectar()->prepare("INSERT INTO costos_reparacion(id_taller, id_equipo, factura, neto, fecha, detalles, id_usuario) VALUES (:taller, :idEquipo, :factura, :neto, :fecha, :detalle, :idUsuario)");
            
            

            $stmt2 -> bindParam(":idEquipo", $datos["idEquipo"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":taller", $datos["taller"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
            $stmt2 -> bindParam(":neto", $datos["neto"], PDO::PARAM_INT);
            $stmt2 -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
            $stmt2 -> bindParam(":detalle", strtoupper($datos["detalle"]), PDO::PARAM_STR);
         
         if($stmt2 -> execute()){
			  return 'ok';
		}		
	
		$stmt2 -> close();

		
		$stmt2 = null;

	}

	 static public function mdlGastosPorEquipo($idEquipo){
              		 
		
			$stmt = Conexion::conectar()->prepare("SELECT sum(neto) as neto from costos_reparacion where id_equipo = $idEquipo");
		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	


	static public function mdlTraerGastosDetalles($idEquipo){
              		 
		
			$stmt = Conexion::conectar()->prepare("SELECT cr.id, cr.factura, cr.neto, cr.fecha, cr.fecha_ingreso, cr.detalles, t.nombre as taller, u.nombre as usuario FROM costos_reparacion cr LEFT JOIN talleres t ON cr.id_taller = t.id JOIN usuarios u ON cr.id_usuario = u.id where cr.id_equipo = $idEquipo");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	




}