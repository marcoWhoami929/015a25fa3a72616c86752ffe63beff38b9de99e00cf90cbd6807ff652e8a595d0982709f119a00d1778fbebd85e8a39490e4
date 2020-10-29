<?php
error_reporting (0);
require_once "../controladores/mensajes.controlador.php";
require_once "../modelos/mensajes.modelo.php";

class TablaComentarios{

 	/*=============================================
  	MOSTRAR LA TABLA DE Comentarios
  	=============================================*/ 

	public function mostrarTabla(){	

		$item = null;
 		$valor = null;

 		$comentarios = ControladorComentarios::ctrMostrarComentarios($item, $valor);


 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($comentarios); $i++){

	 		
	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/
			/*=============================================
  			CREAR LAS ACCIONES
  			=============================================*/

  			 $acciones = "<div class='btn-group'><button class='btn btn-danger btnEliminarComentario' idComentario='".$comentarios[$i]["id"]."'><i class='fa fa-times'></i></button></div>";

			$datosJson	 .= '[
				      "'.($i+1).'",
				      "'.$comentarios[$i]["id_usuario"].'",
				      "'.$comentarios[$i]["id_producto"].'",
				      "'.$comentarios[$i]["calificacion"].'",
				      "'.$comentarios[$i]["comentario"].'",
				      "'.$comentarios[$i]["fecha"].'",
				      "'.$acciones.'"   
				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

/*=============================================
ACTIVAR TABLA DE Comentarios
=============================================*/ 
$activar = new TablaComentarios();
$activar -> mostrarTabla();



