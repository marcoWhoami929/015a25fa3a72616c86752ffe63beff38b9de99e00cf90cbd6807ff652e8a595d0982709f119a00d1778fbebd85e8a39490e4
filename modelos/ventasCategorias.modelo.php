<?php

require_once "conexion.php";

class ModeloVentasCategorias{



	/*=============================================
	MOSTRAR VENTAS POR CATEGORIAS
	============================================*/
	static public function mdlMostrarVentasCategorias($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_categoria , id_subcategoria, ventas FROM $tabla GROUP BY id_categoria");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlSumarVentasCategorias($tabla){
		$stmt = Conexion::conectar()-> prepare("SELECT SUM(ventas) as total FROM $tabla GROUP BY id_categoria");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}


}