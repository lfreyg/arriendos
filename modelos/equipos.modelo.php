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
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id where id_estado = 1 and id_sucursal = $id order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id where id_estado = 1 and id_sucursal = $id and e.id_nombre_equipos = $filtro order by ne.descripcion");
		}	

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlMostrarEquiposArrendados($filtro,$idObra){

		
		if($filtro == null){
			$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idGuiaDetalle, e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id WHERE gd.id_obras = $idObra and gdd.devuelto = 0 order by ne.descripcion");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT gdd.id as idGuiaDetalle,  e.id as idEquipo, e.codigo as codigo, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN guia_despacho_detalle gdd ON gdd.id_equipo = e.id JOIN guia_despacho gd ON gdd.id_guia = gd.id WHERE gd.id_obras = $idObra and gdd.devuelto = 0 and e.id_nombre_equipos = $filtro order by ne.descripcion");
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

		
		
			$stmt = Conexion::conectar()->prepare("SELECT e.id as idEquipo, e.codigo as codigo, e.numero_serie as serie, ne.descripcion as descripcion, ne.modelo as modelo, m.descripcion as marca, ne.precio as precio, su.nombre as sucursal, ne.id as idNombreEquipo, e.id_sucursal as idSucursal, e.creacion as fecha FROM equipos e JOIN nombre_equipos ne ON e.id_nombre_equipos = ne.id JOIN marcas m ON ne.id_marca = m.id JOIN sucursales su ON e.id_sucursal = su.id where e.id = $id");
			

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




}