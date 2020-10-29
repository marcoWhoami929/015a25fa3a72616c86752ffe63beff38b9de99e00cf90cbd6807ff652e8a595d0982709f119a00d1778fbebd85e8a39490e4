<?php

require_once "../controladores/ventasCategorias.controlador.php";
require_once "../modelos/ventasCategorias.modelo.php";


class AjaxVentasCategorias{

	/*=============================================
	ACTUALIZAR PROCESO DE ENVÍO
	=============================================*/
	

  	public $idVenta;
  	public $etapa;

  	public function ajaxEnvioVenta(){

  		$respuesta = ModeloVentas::mdlActualizarVenta("compras", "envio", $this->etapa, "id_pedido", $this->idVenta);

  		echo $respuesta;

	}

}

/*=============================================
ACTUALIZAR PROCESO DE ENVÍO
=============================================*/


if(isset($_POST["idVenta"])){

	$envioVenta = new AjaxVentas();
	$envioVenta -> idVenta = $_POST["idVenta"];
	$envioVenta -> etapa = $_POST["etapa"];
	$envioVenta -> ajaxEnvioVenta();

}
