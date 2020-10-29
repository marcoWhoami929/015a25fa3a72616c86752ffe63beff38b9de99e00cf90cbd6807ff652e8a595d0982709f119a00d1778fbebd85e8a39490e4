<?php

class ControladorInventarios{

	/*=============================================
	MOSTRAR TOTAL INVENTARIOS
	=============================================*/

	static public function ctrMostrarTotalInventarios($orden){

		$tabla = "productos";

		$respuesta = ModeloInventarios::mdlMostrarTotalInventarios($tabla, $orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloInventarios::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}
	/*=============================================
	MOSTRAR ENTRADAS
	=============================================*/
	static public function ctrMostrarEntradas(){

		$tabla = "productos";

		$respuesta = ModeloInventarios::mdlMostrarEntradas($tabla);

		return $respuesta;
	}
	/*=============================================
	MOSTRAR EXISTENCIAS
	=============================================*/
	static public function ctrMostrarExistencias(){

		$tabla = "productos";

		$respuesta = ModeloInventarios::mdlMostrarExistencias($tabla);
		
		return $respuesta;
	}
	/*=============================================
	ACTUALIZAR EXISTENCIAS
	=============================================*/
	static public function ctrActualizarExistencias(){
		
		$tabla = "productos";

		$respuesta = ModeloInventarios::mdlActualizarExistencias($tabla);

		return $respuesta;
	}
	/*=============================================
	MOSTRAR INVENTARIOS
	=============================================*/

	static public function ctrMostrarInventarios($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloInventarios::mdlMostrarInventarios($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	SUBIR MULTIMEDIA
	=============================================*/

	static public function ctrSubirMultimedia($datos, $ruta){

		if(isset($datos["tmp_name"]) && !empty($datos["tmp_name"])){

			/*=============================================
			DEFINIMOS LAS MEDIDAS
			=============================================*/

			list($ancho, $alto) = getimagesize($datos["tmp_name"]);	

			$nuevoAncho = 1000;
			$nuevoAlto = 1000;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA MULTIMEDIA
			=============================================*/

			$directorio = "../vistas/img/multimedia/".$ruta;

			/*=============================================
			PRIMERO PREGUNTAMOS SI EXISTE UN DIRECTORIO DE MULTIMEDIA CON ESTA RUTA
			=============================================*/

			if (!file_exists($directorio)){

				mkdir($directorio, 0755);
			
			}

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if($datos["type"] == "image/jpeg"){

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$rutaMultimedia = $directorio."/".$datos["name"];

				$origen = imagecreatefromjpeg($datos["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $rutaMultimedia);

			}

			if($datos["type"] == "image/png"){

				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$rutaMultimedia = $directorio."/".$datos["name"];

				$origen = imagecreatefrompng($datos["tmp_name"]);						

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagealphablending($destino, FALSE);
		
				imagesavealpha($destino, TRUE);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $rutaMultimedia);

			}

			return $rutaMultimedia;	

		}

	}

	/*=============================================
	CREAR INVENTARIOS
	=============================================*/

	static public function ctrCrearInventario($datos){

		if(isset($datos["tituloProducto"])){

			if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["tituloProducto"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionProducto"]) ){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = "../vistas/img/cabeceras/default/default.jpg";

				if(isset($datos["fotoPortada"]["tmp_name"]) && !empty($datos["fotoPortada"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPortada"]["tmp_name"]);	

					$nuevoAncho = 1280;
					$nuevoAlto = 720;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPortada"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPortada);

					}

					if($datos["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}

				}

				/*=============================================
				VALIDAR IMAGEN PRINCIPAL
				=============================================*/

				$rutaFotoPrincipal = "../vistas/img/productos/default/default.jpg";

				if(isset($datos["fotoPrincipal"]["tmp_name"]) && !empty($datos["fotoPrincipal"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPrincipal"]["tmp_name"]);	

					$nuevoAncho = 400;
					$nuevoAlto = 450;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPrincipal"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaFotoPrincipal);

					}

					if($datos["fotoPrincipal"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaFotoPrincipal);

					}

				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				=============================================*/

				$rutaOferta = "";

				if(isset($datos["fotoOferta"]["tmp_name"]) && !empty($datos["fotoOferta"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($datos["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}

				}

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTA EN CAMINO
				=============================================*/

				if($datos["selActivarOferta"] == "oferta"){

					$datosInventario = array(
						   "titulo"=>$datos["tituloProducto"],
						   "idCategoria"=>$datos["categoria"],
						   "idSubCategoria"=>$datos["subCategoria"],
						   "tipo"=>$datos["tipo"],
						   "detalles"=>$datos["detalles"],
						   "multimedia"=>$datos["multimedia"],
						   "ruta"=>$datos["rutaProducto"],
						   "estado"=> 1,
						   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
						   "descripcion"=> $datos["descripcionProducto"],
						   "palabrasClaves"=> $datos["pClavesProducto"],
						   "precio"=> $datos["precio"],
						   "peso"=> $datos["peso"],
						   "entrega"=> $datos["entrega"], 
						   "largo"=> $datos["largo"],
						   "ancho"=> $datos["ancho"],
						   "alto"=> $datos["alto"],
						   "stock"=> $datos["stock"],
						   "agregarStock"=> $datos["agregarStock"],
						   "stockMin"=> $datos["stockMin"],
						   "stockMax"=> $datos["stockMax"],
						   "imgPortada"=>substr($rutaPortada,3),
						   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
						   "oferta"=>1,
						   "precioOferta"=>$datos["precioOferta"],
						   "descuentoOferta"=>$datos["descuentoOferta"],
						   "imgOferta"=>substr($rutaOferta,3),
						   "finOferta"=>$datos["finOferta"]
					   );


				}else{

					$datosInventario = array(
						   "titulo"=>$datos["tituloProducto"],
						   "idCategoria"=>$datos["categoria"],
						   "idSubCategoria"=>$datos["subCategoria"],
						   "tipo"=>$datos["tipo"],
						   "detalles"=>$datos["detalles"],
						   "multimedia"=>$datos["multimedia"],
						   "ruta"=>$datos["rutaProducto"],
						   "estado"=> 1,
						   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
						   "descripcion"=> $datos["descripcionProducto"],
						   "palabrasClaves"=> $datos["pClavesProducto"],
						   "precio"=> $datos["precio"],
						   "peso"=> $datos["peso"],
						   "entrega"=> $datos["entrega"], 
						   "largo"=> $datos["largo"],
						   "ancho"=> $datos["ancho"],
						   "alto"=> $datos["alto"],
						   "stock"=> $datos["stock"],
						   "agregarStock"=> $datos["agregarStock"],
						   "stockMin"=> $datos["stockMin"],
						   "stockMax"=> $datos["stockMax"], 
						   "imgPortada"=>substr($rutaPortada,3),
						   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
						   "oferta"=>0,
						   "precioOferta"=>0,
						   "descuentoOferta"=>0,
						   "imgOferta"=>"",
						   "finOferta"=>""
					   );

				}

				ModeloCabeceras::mdlIngresarCabecera("cabeceras", $datosInventario);

				$respuesta = ModeloInventarios::mdlIngresarInventario("productos", $datosInventario);

				return $respuesta;
				

			}else{

					echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre del producto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inventario";

							}
						})

			  	</script>';



			}
		
		}

	}

	/*=============================================
	EDITAR INVENTARIOS
	=============================================*/

	static public function ctrEditarInventario($datos){

		if(isset($datos["idProducto"])){

			if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["tituloProducto"])  && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionProducto"]) ){

				/*=============================================
				ELIMINAR LAS FOTOS DE MULTIMEDIA DE LA CARPETA
				=============================================*/

				if($datos["tipo"] == "fisico"){

					$item = "id";
					$valor = $datos["idProducto"];

					$traerInventarios = ModeloInventarios::mdlMostrarInventarios("productos", $item, $valor);

					foreach ($traerInventarios as $key => $value) {
					
						$multimediaBD = json_decode($value["multimedia"],true);
						$multimediaEditar = json_decode($datos["multimedia"],true);

						$objectMultimediaBD = array();
						$objectMultimediaEditar = array();

						foreach ($multimediaBD as $key => $value) {

						  array_push($objectMultimediaBD, $value["foto"]);

						}

						foreach ($multimediaEditar as $key => $value) {

						  array_push($objectMultimediaEditar, $value["foto"]);

						}

						$borrarFoto = array_diff($objectMultimediaBD, $objectMultimediaEditar);

						foreach ($borrarFoto as $key => $value) {
							
							unlink("../".$value);

						}

					}				

				}

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = "../".$datos["antiguaFotoPortada"];

				if(isset($datos["fotoPortada"]["tmp_name"]) && !empty($datos["fotoPortada"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO PORTADA
					=============================================*/

					unlink("../".$datos["antiguaFotoPortada"]);

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPortada"]["tmp_name"]);	

					$nuevoAncho = 1280;
					$nuevoAlto = 720;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPortada"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPortada);

					}

					if($datos["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPortada = "../vistas/img/cabeceras/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPortada"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}

				}

				/*=============================================
				VALIDAR IMAGEN PRINCIPAL
				=============================================*/

				$rutaFotoPrincipal = "../".$datos["antiguaFotoPrincipal"];

				if(isset($datos["fotoPrincipal"]["tmp_name"]) && !empty($datos["fotoPrincipal"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO PRINCIPAL
					=============================================*/

					unlink("../".$datos["antiguaFotoPrincipal"]);

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoPrincipal"]["tmp_name"]);	

					$nuevoAncho = 400;
					$nuevoAlto = 450;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoPrincipal"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaFotoPrincipal);

					}

					if($datos["fotoPrincipal"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaFotoPrincipal = "../vistas/img/productos/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoPrincipal"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaFotoPrincipal);

					}

				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				=============================================*/

				$rutaOferta = "../".$datos["antiguaFotoOferta"];

				if(isset($datos["fotoOferta"]["tmp_name"]) && !empty($datos["fotoOferta"]["tmp_name"])){

					/*=============================================
					BORRAMOS ANTIGUA FOTO OFERTA
					=============================================*/

					if($datos["antiguaFotoOferta"] != ""){

						unlink("../".$datos["antiguaFotoOferta"]);

					}

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($datos["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;


					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".jpg";

						$origen = imagecreatefromjpeg($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($datos["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaOferta = "../vistas/img/ofertas/".$datos["rutaProducto"].".png";

						$origen = imagecreatefrompng($datos["fotoOferta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
				
						imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}

				}			

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTA EN CAMINO
				=============================================*/

				if($datos["selActivarOferta"] == "oferta"){

					$datosInventario = array(
								   "id"=>$datos["idProducto"],
								   "titulo"=>$datos["tituloProducto"],
								   "idCategoria"=>$datos["categoria"],
								   "idSubCategoria"=>$datos["subCategoria"],
								   "tipo"=>$datos["tipo"],
								   "detalles"=>$datos["detalles"],
								   "multimedia"=>$datos["multimedia"],
								   "ruta"=>$datos["rutaProducto"],
								   "estado"=> 1,
								   "idCabecera"=>$datos["idCabecera"],
								   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
								   "descripcion"=> $datos["descripcionProducto"],
								   "palabrasClaves"=> $datos["pClavesProducto"],
								   "precio"=> $datos["precio"],
								   "peso"=> $datos["peso"],
								   "entrega"=> $datos["entrega"],  
								   "largo"=> $datos["largo"],
								   "ancho"=> $datos["ancho"],
								   "alto"=> $datos["alto"],
								   "stock"=> $datos["stock"],
								   "agregarStock"=> $datos["agregarStock"],
								   "stockMin"=> $datos["stockMin"],
								   "stockMax"=> $datos["stockMax"],
								   "imgPortada"=>substr($rutaPortada,3),
								   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
								   "oferta"=>1,
								   "precioOferta"=>$datos["precioOferta"],
								   "descuentoOferta"=>$datos["descuentoOferta"],
								   "imgOferta"=>substr($rutaOferta,3),
								   "finOferta"=>$datos["finOferta"]
								   );

				}else{

					$datosInventario = array(
						 		   "id"=>$datos["idProducto"],
								   "titulo"=>$datos["tituloProducto"],
								   "idCategoria"=>$datos["categoria"],
								   "idSubCategoria"=>$datos["subCategoria"],
								   "tipo"=>$datos["tipo"],
								   "detalles"=>$datos["detalles"],
								   "multimedia"=>$datos["multimedia"],
								   "ruta"=>$datos["rutaProducto"],
								   "estado"=> 1,
								   "idCabecera"=>$datos["idCabecera"],
								   "titular"=> substr($datos["descripcionProducto"], 0, 225)."...",
								   "descripcion"=> $datos["descripcionProducto"],
								   "palabrasClaves"=> $datos["pClavesProducto"],
								   "precio"=> $datos["precio"],
								   "peso"=> $datos["peso"],
								   "entrega"=> $datos["entrega"],
								   "largo"=> $datos["largo"],
								   "ancho"=> $datos["ancho"],
								   "alto"=> $datos["alto"],
								   "stock"=> $datos["stock"],
								   "agregarStock"=> $datos["agregarStock"],
								   "stockMin"=> $datos["stockMin"],
								   "stockMax"=> $datos["stockMax"],
								   "imgPortada"=>substr($rutaPortada,3),
								   "imgFotoPrincipal"=>substr($rutaFotoPrincipal,3),
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>""
								   );

				}

				ModeloCabeceras::mdlEditarCabecera("cabeceras", $datosInventario);

				$respuesta = ModeloInventarios::mdlEditarInventario("productos", $datosInventario);

				return $respuesta;


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre del producto no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inventario";

							}
						})

			  	</script>';

			}

		}
		
	}

	/*=============================================
	ELIMINAR INVENTARIO
	=============================================*/

	static public function ctrEliminarInventario(){

		if(isset($_GET["idProducto"])){

			$datos = $_GET["idProducto"];

			/*=============================================
			ELIMINAR MULTIMEDIA
			=============================================*/

			$borrar = glob("vistas/img/multimedia/".$_GET["rutaCabecera"]."/*");

				foreach($borrar as $file){

					unlink($file);

				}

			rmdir("vistas/img/multimedia/".$_GET["rutaCabecera"]);

			/*=============================================
			ELIMINAR FOTO PRINCIPAL
			=============================================*/

			if($_GET["imgPrincipal"] != "" && $_GET["imgPrincipal"] != "vistas/img/productos/default/default.jpg"){

				unlink($_GET["imgPrincipal"]);		

			}

			/*=============================================
			ELIMINAR OFERTA
			=============================================*/

			if($_GET["imgOferta"] != ""){

				unlink($_GET["imgOferta"]);		

			}

			/*=============================================
			ELIMINAR CABECERA
			=============================================*/

			if($_GET["imgPortada"] != "" && $_GET["imgPortada"] != "vistas/img/cabeceras/default/default.jpg"){

				unlink($_GET["imgPortada"]);		

			}

			ModeloCabeceras::mdlEliminarCabecera("cabeceras", $_GET["rutaCabecera"]);

			$respuesta = ModeloInventarios::mdlEliminarInventario("productos", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "inventario";

								}
							})

				</script>';

			}		



		}

	}


}