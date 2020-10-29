<?php

require_once "conexion.php";

class ModeloPedidos{

	/*=============================================
	MOSTRAR ADMINISTRADORES
	=============================================*/

	static public function mdlMostrarPedidos(){

		$stmt = Conexion::conectar()->prepare("SELECT *, SUM(cantidad) as total_productos FROM pedidos GROUP BY id_pedido");

		$stmt -> execute();

		return $stmt->fetchAll();
	}
}