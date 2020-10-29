<?php

require_once "conexion.php";

class ModeloComentarios{

	/*=============================================
	MOSTRAR LAS COMENTARIOS
	=============================================*/	

	static public function mdlMostrarComentarios($tabla){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	/*=============================================
	ELIMINAR LOS COMENTARIOS
	=============================================*/	

	static public function mdlEliminarComentario($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

}