<?php

require_once "../controladores/inventarios.controlador.php";
require_once "../modelos/inventarios.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class AjaxInventarios{


	/*=============================================
  	ACTIVAR INVENTARIOS
 	=============================================*/	

 	public $activarInventario;
	public $activarId;

	public function ajaxActivarInventario(){

		$tabla = "productos";

		$item1 = "estado";
		$valor1 = $this->activarInventario;

		$item2 = "id";
		$valor2 = $this->activarId;	

		$respuesta = ModeloInventarios::mdlActualizarInventarios($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}


	/*=============================================
	VALIDAR NO REPETIR INVENTARIO
	=============================================*/	

	public $validarStock;

	public function ajaxValidarStock(){

		$item = "existencias";
		$valor = $this->validarStock;

		$respuesta = ControladorInventarios::ctrMostrarInventarios($item, $valor);

		echo json_encode($respuesta);

	}
	/*===========================================
	ACTUALIZAR EXISTENCIAS
	============================================*/
	public function ajaxActualizarExistencias(){
		$respuesta = ControladorInventarios::ctrActualizarExistencias();
		echo $respuesta;
	}

	/*=============================================
	RECIBIR MULTIMEDIA
	=============================================*/

	public $imagenMultimedia;
	public $rutaMultimedia;	

	public function  ajaxRecibirMultimedia(){

		$datos = $this->imagenMultimedia;
		$ruta = $this->rutaMultimedia;

		$respuesta = ControladorInventarios::ctrSubirMultimedia($datos, $ruta);

		echo $respuesta;

	}

	/*==================================
	MOSTRAR ENTRADAS
	=================================*/
	public function ajaxMostrarEntradas(){
		$respuesta = ControladorInventarios::ctrMostrarEntradas();
		echo $respuesta;
	}
	/*==================================
	MOSTRAR ENTRADAS
	=================================*/
	public function ajaxMostrarExistencias(){
		$respuesta = ControladorInventarios::ctrMostrarExistencias();
		echo $respuesta;


	}
	/*=============================================
	GUARDAR INVENTARIO Y EDITAR INVENTARIO
	=============================================*/	

	public $tituloProducto;
	public $rutaProducto;
	public $seleccionarTipo;
	public $detalles;			
	public $seleccionarCategoria;
	public $seleccionarSubCategoria;
	public $descripcionProducto;
	public $pClavesProducto;
	public $precio;
	public $peso;
	public $entrega;
	public $largo;
	public $ancho;
	public $alto;
	public $stock;
	public $agregarStock;
	public $stockMin;
	public $stockMax;
	public $multimedia;
	public $fotoPortada;
	public $fotoPrincipal;
	public $selActivarOferta;
	public $precioOferta;
	public $descuentoOferta;
	public $finOferta;
	public $fotoOferta;

	public $id;
	public $antiguaFotoPortada;
	public $antiguaFotoPrincipal;
	public $antiguaFotoOferta;
	public $idCabecera;

	public function  ajaxCrearInventario(){

		$datos = array(
			"tituloProducto"=>$this->tituloProducto,
			"rutaProducto"=>$this->rutaProducto,
			"tipo"=>$this->seleccionarTipo,
			"detalles"=>$this->detalles,					
			"categoria"=>$this->seleccionarCategoria,
			"subCategoria"=>$this->seleccionarSubCategoria,
			"descripcionProducto"=>$this->descripcionProducto,
			"pClavesProducto"=>$this->pClavesProducto,
			"precio"=>$this->precio,
			"peso"=>$this->peso,
			"entrega"=>$this->entrega,
			"largo"=>$this->largo,
			"ancho"=>$this->ancho,
			"alto"=>$this->alto,
			"stock"=>$this->stock,
			"agregarStock"=>$this->agregarStock,
			"stockMin"=>$this->stockMin,
			"stockMax"=>$this->stockMax,
			"stockMax"=>$this->entradas,
			"multimedia"=>$this->multimedia,
			"fotoPortada"=>$this->fotoPortada,
			"fotoPrincipal"=>$this->fotoPrincipal,
			"selActivarOferta"=>$this->selActivarOferta,
			"precioOferta"=>$this->precioOferta,
			"descuentoOferta"=>$this->descuentoOferta,
			"fotoOferta"=>$this->fotoOferta,
			"finOferta"=>$this->finOferta
			);

		$respuesta = ControladorInventarios::ctrCrearInventario($datos);

		echo $respuesta;

	}

	/*=============================================
	TRAER INVENTARIOS
	=============================================*/	

	public $idProducto;

	public function ajaxTraerInventario(){

		$item = "id";
		$valor = $this->idProducto;

		$respuesta = ControladorInventarios::ctrMostrarInventarios($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	EDITAR INVENTARIOS
	=============================================*/	

	public function  ajaxEditarInventario(){

		$datos = array(
			"idProducto"=>$this->id,
			"tituloProducto"=>$this->tituloProducto,
			"rutaProducto"=>$this->rutaProducto,
			"tipo"=>$this->seleccionarTipo,
			"detalles"=>$this->detalles,					
			"categoria"=>$this->seleccionarCategoria,
			"subCategoria"=>$this->seleccionarSubCategoria,
			"descripcionProducto"=>$this->descripcionProducto,
			"pClavesProducto"=>$this->pClavesProducto,
			"precio"=>$this->precio,
			"peso"=>$this->peso,
			"entrega"=>$this->entrega,
			"largo"=>$this->largo,
			"ancho"=>$this->ancho,
			"alto"=>$this->alto,
			"stock"=>$this->stock,
			"agregarStock"=>$this->agregarStock,
			"stockMin"=>$this->stockMin,
			"stockMax"=>$this->stockMax,
			"multimedia"=>$this->multimedia,
			"fotoPortada"=>$this->fotoPortada,
			"fotoPrincipal"=>$this->fotoPrincipal,
			"selActivarOferta"=>$this->selActivarOferta,
			"precioOferta"=>$this->precioOferta,
			"descuentoOferta"=>$this->descuentoOferta,
			"fotoOferta"=>$this->fotoOferta,
			"finOferta"=>$this->finOferta,
			"antiguaFotoPortada"=>$this->antiguaFotoPortada,
			"antiguaFotoPrincipal"=>$this->antiguaFotoPrincipal,
			"antiguaFotoOferta"=>$this->antiguaFotoOferta,
			"idCabecera"=>$this->idCabecera
			);

		$respuesta = ControladorInventarios::ctrEditarInventario($datos);

	
		echo $respuesta;

	}

 }

/*=============================================
ACTIVAR INVENTARIOS
=============================================*/	

if(isset($_POST["activarInventario"])){

	$activarInventario = new AjaxInventarios();
	$activarInventario -> activarInventario = $_POST["activarInventario"];
	$activarInventario -> activarId = $_POST["activarId"];
	$activarInventario -> ajaxActivarInventario();

}

/*=============================================
VALIDAR NO REPETIR INVENTARIO
=============================================*/

if(isset($_POST["validarStock"])){

	$valInventario = new AjaxInventarios();
	$valInventario -> validarStock = $_POST["validarStock"];
	$valInventario -> ajaxValidarStock();

}

#RECIBIR ARCHIVOS MULTIMEDIA
#-----------------------------------------------------------
if(isset($_FILES["file"])){

	$multimedia = new AjaxInventarios();
	$multimedia -> imagenMultimedia = $_FILES["file"];
	$multimedia -> rutaMultimedia = $_POST["ruta"];
	$multimedia -> ajaxRecibirMultimedia();

}

#CREAR INVENTARIO
#-----------------------------------------------------------
if(isset($_POST["tituloProducto"])){

	$inventario = new AjaxInventarios();
	$inventario -> tituloProducto = $_POST["tituloProducto"];
	$inventario -> rutaProducto = $_POST["rutaProducto"];
	$inventario -> seleccionarTipo = $_POST["seleccionarTipo"];
	$inventario -> detalles = $_POST["detalles"];		
	$inventario -> seleccionarCategoria = $_POST["seleccionarCategoria"];
	$inventario -> seleccionarSubCategoria = $_POST["seleccionarSubCategoria"];
	$inventario -> descripcionProducto = $_POST["descripcionProducto"];
	$inventario -> pClavesProducto = $_POST["pClavesProducto"];
	$inventario -> precio = $_POST["precio"];
	$inventario -> peso = $_POST["peso"];
	$inventario -> entrega = $_POST["entrega"];
	$inventario -> largo = $_POST["largo"];
	$inventario -> ancho = $_POST["ancho"];
	$inventario -> alto = $_POST["alto"];
	$inventario -> stock = $_POST["stock"];
	$inventario -> agregarStock = $_POST["agregarStock"];
	$inventario -> stockMin = $_POST["stockMin"];
	$inventario -> stockMax = $_POST["stockMax"];
	$inventario -> entradas = $_POST["entradas"];

	$inventario -> multimedia = $_POST["multimedia"];

	if(isset($_FILES["fotoPortada"])){

		$inventario -> fotoPortada = $_FILES["fotoPortada"];

	}else{

		$inventario -> fotoPortada = null;

	}	

	if(isset($_FILES["fotoPrincipal"])){

		$inventario -> fotoPrincipal = $_FILES["fotoPrincipal"];

	}else{

		$inventario -> fotoPrincipal = null;

	}	

	$inventario -> selActivarOferta = $_POST["selActivarOferta"];
	$inventario -> precioOferta = $_POST["precioOferta"];
	$inventario -> descuentoOferta = $_POST["descuentoOferta"];	

	if(isset($_FILES["fotoOferta"])){

		$inventario -> fotoOferta = $_FILES["fotoOferta"];

	}else{

		$inventario -> fotoOferta = null;

	}	

	$inventario -> finOferta = $_POST["finOferta"];

	$inventario -> ajaxCrearInventario();

}

/*=============================================
TRAER INVENTARIO
=============================================*/
if(isset($_POST["idProducto"])){

	$traerInventario = new AjaxInventarios();
	$traerInventario -> idProducto = $_POST["idProducto"];
	$traerInventario -> ajaxTraerInventario();

}

/*=============================================
EDITAR INVENTARIO
=============================================*/
if(isset($_POST["id"])){

	$editarInventario = new AjaxInventarios();
	$editarInventario -> id = $_POST["id"];
	$editarInventario -> tituloProducto = $_POST["editarInventario"];
	$editarInventario -> rutaProducto = $_POST["rutaProducto"];
	$editarInventario -> seleccionarTipo = $_POST["seleccionarTipo"];
	$editarInventario -> detalles = $_POST["detalles"];		
	$editarInventario -> seleccionarCategoria = $_POST["seleccionarCategoria"];
	$editarInventario -> seleccionarSubCategoria = $_POST["seleccionarSubCategoria"];
	$editarInventario -> descripcionProducto = $_POST["descripcionProducto"];
	$editarInventario -> pClavesProducto = $_POST["pClavesProducto"];
	$editarInventario -> precio = $_POST["precio"];
	$editarInventario -> peso = $_POST["peso"];
	$editarInventario -> entrega = $_POST["entrega"];
	$editarInventario -> largo = $_POST["largo"];
	$editarInventario -> ancho = $_POST["ancho"];
	$editarInventario -> alto = $_POST["alto"];
	$editarInventario -> stock = $_POST["stock"];
	$editarInventario -> agregarStock = $_POST["agregarStock"];
	$editarInventario -> stockMin = $_POST["stockMin"];
	$editarInventario -> stockMax = $_POST["stockMax"];
	$editarInventario -> multimedia = $_POST["multimedia"];

	if(isset($_FILES["fotoPortada"])){

		$editarInventario -> fotoPortada = $_FILES["fotoPortada"];

	}else{

		$editarInventario -> fotoPortada = null;

	}	

	if(isset($_FILES["fotoPrincipal"])){

		$editarInventario -> fotoPrincipal = $_FILES["fotoPrincipal"];

	}else{

		$editarInventario -> fotoPrincipal = null;

	}	

	$editarInventario -> selActivarOferta = $_POST["selActivarOferta"];
	$editarInventario -> precioOferta = $_POST["precioOferta"];
	$editarInventario -> descuentoOferta = $_POST["descuentoOferta"];	

	if(isset($_FILES["fotoOferta"])){

		$editarInventario -> fotoOferta = $_FILES["fotoOferta"];

	}else{

		$editarInventario -> fotoOferta = null;

	}	

	$editarInventario -> finOferta = $_POST["finOferta"];

	$editarInventario -> antiguaFotoPortada = $_POST["antiguaFotoPortada"];
	$editarInventario -> antiguaFotoPrincipal = $_POST["antiguaFotoPrincipal"];
	$editarInventario -> antiguaFotoOferta = $_POST["antiguaFotoOferta"];
	$editarInventario -> idCabecera = $_POST["idCabecera"];

	$editarInventario -> ajaxEditarInventario();
	$editarInventario -> ajaxMostrarEntradas();
	$editarInventario -> ajaxMostrarExistencias();



}


