<?php

require_once "conexion.php";

class ModeloPlantilla{

	

	/*=============================================
	MOSTRAR DESEOS
	=============================================*/
	
	static public function mdlMostrarTotalDeseos($tabla, $orden){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	
	}

	/*=============================================
	MOSTRAR TOTAL DE USUARIOS DE LOS DESEOS
	=============================================*/
	
	static public function mdlMostrarTotalDeseosUsuario($tabla, $orden){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla GROUP BY id_usuario");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	
	}

	/*=============================================
	MOSTRAR TOTAL DE PRODUCTOS DE LOS DESEOS
	=============================================*/
	
	static public function mdlMostrarTotalDeseoProductos($tabla, $orden){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla GROUP BY id_producto");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	
	}

	/*=============================================
	MOSTRAR DESEOS EN LISTADO SELECT p.id, p.titulo, p.precio, p.portada, d.id_producto FROM productos p, deseos d WHERE p.id=d.id_producto
	=============================================*/
	
	static public function mdlMostrarDeseos($tabla, $orden){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos p, deseos d WHERE p.id=d.id_producto GROUP BY d.id_producto");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	
	}
	

}