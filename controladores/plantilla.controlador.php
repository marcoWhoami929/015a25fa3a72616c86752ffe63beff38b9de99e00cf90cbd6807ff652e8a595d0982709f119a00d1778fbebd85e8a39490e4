<?php


class ControladorPlantilla{

	public function plantilla(){

		include "vistas/plantilla.php";

	}
	/*=============================================
	MOSTRAR TOTAL DESEOS
	=============================================*/

	public function ctrMostrarTotalDeseos($orden){

		$tabla = "deseos";

		$respuesta = ModeloPlantilla::mdlMostrarTotalDeseos($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR TOTAL DE USUARIOS DE LOS DESEOS
	=============================================*/

	public function ctrMostrarTotalDeseosUsuario($orden){

		$tabla = "deseos";

		$respuesta = ModeloPlantilla::mdlMostrarTotalDeseosUsuario($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR TOTAL DE PRODUCTOS DE LOS DESEOS
	=============================================*/

	public function ctrMostrarTotalDeseoProductos($orden){

		$tabla = "deseos";

		$respuesta = ModeloPlantilla::mdlMostrarTotalDeseoProductos($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR DESEOS
	=============================================*/

	public function CtrMostrarDeseos($orden){

		$tabla = "deseos";

		$respuesta = ModeloPlantilla::mdlMostrarDeseos($tabla, $orden);

		return $respuesta;

	}
	

}

