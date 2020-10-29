<?php

class ControladorVentasCategorias{

	static public function ctrMostrarVentasCategorias(){

		$tabla = "productos";
		
		$respuesta = ModeloVentasCategorias::mdlMostrarVentasCategorias($tabla);

		return $respuesta;
	}

	static public function ctrSumarVentasCategorias(){
		$tabla = "productos";

		$respuesta = ModeloVentasCategorias::mdlSumarVentasCategorias($tabla);

		return $respuesta;
	}

	
}