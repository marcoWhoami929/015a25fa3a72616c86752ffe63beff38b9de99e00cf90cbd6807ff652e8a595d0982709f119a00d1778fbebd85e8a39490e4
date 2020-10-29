<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlMostrarTotalVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(pago) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/	

	static public function mdlMostrarVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT *, SUM(cantidad) as cantidad_productos, SUM(pago) as total_pago FROM $tabla GROUP BY id_pedido ORDER BY fecha DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTA
	=============================================*/	

	static public function mdlMostrarVenta($item, $valor){

		$stmt = Conexion::conectar()->prepare("
			SELECT *, COUNT(*) as cantidad_productos, SUM(pago) as total_pago 
			FROM compras
			WHERE $item='$valor'
			GROUP BY id_pedido 
			ORDER BY 
			fecha DESC
		");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ENVIO VENTA
	=============================================*/

	static public function mdlActualizarVenta($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR PRODUCTOS VENTA
	=============================================*/

	static public function mdlProductosVenta($valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM compras WHERE id_pedido = '$valor'");

		$stmt -> execute();

		return $stmt -> fetchAll();
	}
}