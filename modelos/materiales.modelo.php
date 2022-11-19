<?php

require_once "conexion.php";

class ModeloMateriales{		
    
    static public function mdlMostrarMaterialesGuiaDespacho($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, codigo, descripcion, detalle, precio, cantidad_entra - cantidad_sale as stock FROM materiales_insumos where id_sucursal = $id");
		

			$stmt -> execute();

			return $stmt -> fetchAll();		
		

		$stmt -> close();

		$stmt = null;

	}	

	static public function mdlSeleccionaMaterial($id){

		
		
			$stmt = Conexion::conectar()->prepare("SELECT id, codigo, descripcion, detalle, precio, cantidad_entra - cantidad_sale as stock FROM materiales_insumos where id = $id");
		

			$stmt -> execute();

			return $stmt -> fetch();		
		

		$stmt -> close();

		$stmt = null;

	}	

	 

}