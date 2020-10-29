<?php

class ControladorUsuariosMayoreo{

	/*=============================================
	MOSTRAR TOTAL USUARIOS
	=============================================*/

	static public function ctrMostrarTotalUsuarios($orden){

		$tabla = "usuariosmayoreo";

		$respuesta = ModeloUsuariosMayoreo::mdlMostrarTotalUsuarios($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuariosmayoreo";

		$respuesta = ModeloUsuariosMayoreo::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	
	}

}