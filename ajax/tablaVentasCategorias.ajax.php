<?php

require_once "../controladores/ventasCategorias.controlador.php";
require_once "../modelos/ventasCategorias.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaVentasCategorias{

  /*=============================================
  MOSTRAR LA TABLA DE VENTAS
  =============================================*/

  public function mostrarTabla(){	

  	$ventas = ControladorVentasCategorias::ctrMostrarVentasCategorias();
    $total = ControladorVentasCategorias::ctrSumarVentasCategorias();


  	$datosJson = '{
		 
	 "data": [ ';

	for($i = 0; $i < count($ventas); $i++){
		/*=============================================
        TRAER LAS CATEGORÍAS
        =============================================*/

        $item = "id";
      	$valor = $ventas[$i]["id_categoria"];

      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

      if($categorias["categoria"] == ""){

        $categoria = "SIN CATEGORÍA";
      
      }else{

        $categoria = $categorias["categoria"];
      }


		/*=============================================
		DEVOLVER DATOS JSON
		=============================================*/
		$datosJson	 .= '[
			      		"'.$ventas[$i]["id_categoria"].'",
			      		"'.$categoria.'",
			      		"'.$total[$i]["total"].'"
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
$activar = new TablaVentasCategorias();
$activar -> mostrarTabla(); 

