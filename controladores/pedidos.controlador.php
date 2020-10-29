<?php

class ControladorPedidos{

	/*=============================================
	MOSTRAR TOTAL USUARIOS
	=============================================*/

	static public function ctrMostrarPedidos(){

		$respuesta = ModeloPedidos::mdlMostrarPedidos();

		return $respuesta;

	}

}