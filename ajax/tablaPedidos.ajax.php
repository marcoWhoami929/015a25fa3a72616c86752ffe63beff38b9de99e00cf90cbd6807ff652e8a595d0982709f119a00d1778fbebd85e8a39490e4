<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";
require_once "../modelos/clientes.modelo.php";

class tablaPedidos{

 	/*=============================================
  	MOSTRAR LA TABLA DE USUARIOS
  	=============================================*/ 

	public function mostrarTabla(){	

 		$pedidos = ControladorPedidos::ctrMostrarPedidos();


 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($pedidos); $i++){

	 		$usuario = ModeloUsuariosMayoreo::mdlMostrarUsuario('usuariosmayoreo', 'id', $pedidos[$i]['id_usuario']);

	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.$pedidos[$i]["id_pedido"].'",
				      "'.$usuario['nombre'].'",
				      "'.$pedidos[$i]["total_productos"].'"  
				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

/*=============================================
ACTIVAR TABLA DE VENTAS
=============================================*/ 
$activar = new tablaPedidos();
$activar -> mostrarTabla();



