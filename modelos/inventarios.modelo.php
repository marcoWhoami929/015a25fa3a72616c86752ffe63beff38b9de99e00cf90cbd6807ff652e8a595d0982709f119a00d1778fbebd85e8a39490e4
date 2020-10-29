<?php

require_once "conexion.php";

class ModeloInventarios{

	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlMostrarTotalInventarios($tabla, $orden){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	MOSTRAR ENTRADAS
	=============================================*/
	static public function mdlMostrarEntradas($tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set entradas = entradas + agregarStock");

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

		
	}
	
	/*============================================
	MOSTRAR EXISTENCIAS
	===========================================*/
	static public function mdlMostrarExistencias($tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set existencias = stock + entradas - ventas");

		if ($stmt -> execute()){

				return "ok";
		} else {
			return "error";
		}
		$stmt -> close();
		$stmt = null;	
	}
	/*=============================================
	ACTUALIZAR EXISTENCIAS
	=============================================*/
	static public function mdlActualizarExistencias($tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set existencias = stock + entradas - ventas");

		if ($stmt -> execute()) {
			 return "ok";
		}else {
			return "error";
		}


		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR INVENTARIOS
	=============================================*/

	static public function mdlActualizarInventarios($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
	}

	/*=============================================
	ACTUALIZAR OFERTA INVENTARIOS
	=============================================*/
	static public function mdlActualizarOfertaInventarios($tabla, $datos, $ofertadoPor, $precioOfertaActualizado, $descuentoOfertaActualizado, $idOferta){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $ofertadoPor = :$ofertadoPor, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, imgOferta = :imgOferta, finOferta = :finOferta WHERE id = :id");

		$stmt->bindParam(":".$ofertadoPor, $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $precioOfertaActualizado, PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $descuentoOfertaActualizado, PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $idOferta, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}

	/*=============================================
	MOSTRAR INVENTARIOS
	=============================================*/

	static public function mdlMostrarInventarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR INVENTARIO
	=============================================*/

	static public function mdlMostrarInventario($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	CREAR INVENTARIO
	=============================================*/

	static public function mdlIngresarInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_subcategoria, tipo, ruta, estado, titulo, titular, descripcion, multimedia, detalles, precio, portada, oferta, precioOferta, descuentoOferta, imgOferta, finOferta, peso, entrega, largo, ancho, alto, stock, stockMin, stockMax) VALUES (:id_categoria, :id_subcategoria, :tipo, :ruta, :estado, :titulo, :titular, :descripcion, :multimedia, :detalles, :precio, :portada, :oferta, :precioOferta, :descuentoOferta, :imgOferta, :finOferta,  :peso, :entrega, :largo, :ancho, :alto, :stock, :stockMin, :stockMax)");

		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgFotoPrincipal"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":largo", $datos["largo"], PDO::PARAM_STR);
		$stmt->bindParam(":ancho", $datos["ancho"], PDO::PARAM_STR);
		$stmt->bindParam(":alto", $datos["alto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":stockMin", $datos["stockMin"], PDO::PARAM_STR);
		$stmt->bindParam(":stockMax", $datos["stockMax"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR INVENTARIO
	=============================================*/

	static public function mdlEditarInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_subcategoria = :id_subcategoria, tipo = :tipo, ruta = :ruta, estado = :estado, titulo = :titulo, titular = :titular, descripcion = :descripcion, multimedia = :multimedia, detalles = :detalles, precio = :precio, portada = :portada, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, imgOferta = :imgOferta, finOferta = :finOferta, peso = :peso, entrega = :entrega, largo = :largo, ancho = :ancho, alto = :alto, stock = :stock, agregarStock = :agregarStock, stockMin = :stockMin, stockMax = :stockMax WHERE id = :id");

		$stmt->bindParam(":id_categoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":titular", $datos["titular"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":multimedia", $datos["multimedia"], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgFotoPrincipal"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":entrega", $datos["entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":largo", $datos["largo"], PDO::PARAM_STR);
		$stmt->bindParam(":ancho", $datos["ancho"], PDO::PARAM_STR);
		$stmt->bindParam(":alto", $datos["alto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":agregarStock", $datos["agregarStock"], PDO::PARAM_STR);
		$stmt->bindParam(":stockMin", $datos["stockMin"], PDO::PARAM_STR);
		$stmt->bindParam(":stockMax", $datos["stockMax"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR INVENTARIO
	=============================================*/

	static public function mdlEliminarInventario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}