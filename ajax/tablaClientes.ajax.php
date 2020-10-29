<?php
error_reporting (0);
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaUsuariosMayoreo{

 	/*=============================================
  	MOSTRAR LA TABLA DE USUARIOS
  	=============================================*/ 

	public function mostrarTabla(){	

		$item = null;
 		$valor = null;

 		$usuarios = ControladorUsuariosMayoreo::ctrMostrarUsuarios($item, $valor);


 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($usuarios); $i++){

	 		/*=============================================
			TRAER FOTO USUARIO
			=============================================*/

			if($usuarios[$i]["foto"] != ""  && $usuarios[$i]["modo"] == "mayoreo"){

				$foto = "<img class='img-circle' src='http://localhost/eshop/".$usuarios[$i]["foto"]."' width='60px'>";

			}else if($usuarios[$i]["foto"] != "" && $usuarios[$i]["modo"] != "mayoreo"){

				$foto = "<img class='img-circle' src='".$usuarios[$i]["foto"]."' width='60px'>";

			}else{

				$foto = "<img class='img-circle' src='vistas/img/usuarios/default/anonymous.png' width='60px'>";
			}

			/*=============================================
  			REVISAR ESTADO
  			=============================================*/

  			if($usuarios[$i]["modo"] == "mayoreo"){

	  			if( $usuarios[$i]["verificacion"] == 1){

	  				$colorEstado = "btn-danger";
	  				$textoEstado = "Desactivado";
	  				$estadoUsuario = 0;

	  			}else{

	  				$colorEstado = "btn-success";
	  				$textoEstado = "Activado";
	  				$estadoUsuario = 1;

	  			}

	  			$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idUsuario='". $usuarios[$i]["id"]."' estadoUsuario='".$estadoUsuario."'>".$textoEstado."</button>";

	  		}else{

	  			$estado = "<button class='btn btn-xs btn-info'>Activado</button>";

	  		}


	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/

			$datosJson	 .= '[
				      "'.($i+1).'",
				      "'.$usuarios[$i]["nombre"].'",
				      "'.$usuarios[$i]["email"].'",
				      "'.$usuarios[$i]["modo"].'",
				      "'.$foto.'",
				      "'.$estado.'",
				      "'.$usuarios[$i]["rfc"].'",
				      "'.$usuarios[$i]["telefono"].'",
				      "'.$usuarios[$i]["fecha"].'"    
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
$activar = new TablaUsuariosMayoreo();
$activar -> mostrarTabla();



