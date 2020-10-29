<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class TablaProductos{

  /*=============================================
  MOSTRAR LA TABLA DE PRODUCTOS
  =============================================*/ 

  public function mostrarTablaProductos(){  

    $item = null;
    $valor = null;

    $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

    $datosJson = '

      { 
        "data":[';

    for($i = 0; $i < count($productos); $i++){

      /*=============================================
        TRAER LAS CATEGORÍAS
        =============================================*/

        $item = "id";
      $valor = $productos[$i]["id_categoria"];

      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

      if($categorias["categoria"] == ""){

        $categoria = "SIN CATEGORÍA";
      
      }else{

        $categoria = $categorias["categoria"];
      }

      /*=============================================
        TRAER LAS SUBCATEGORÍAS
        =============================================*/

        $item2 = "id";
      $valor2 = $productos[$i]["id_subcategoria"];

      $subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item2, $valor2);

      if($subcategorias[0]["subcategoria"] == ""){

        $subcategoria = "SIN SUBCATEGORÍA";
      
      }else{

        $subcategoria = $subcategorias[0]["subcategoria"];
      }

      /*=============================================
        AGREGAR ETIQUETAS DE ESTADO
        =============================================*/

        if($productos[$i]["estado"] == 0){

          $colorEstado = "btn-danger";
          $textoEstado = "Desactivado";
          $estadoProducto = 1;

        }else{

          $colorEstado = "btn-success";
          $textoEstado = "Activado";
          $estadoProducto = 0;

        }

        $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$productos[$i]["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

        /*=============================================
        TRAER LAS CABECERAS
        =============================================*/

        $item3 = "ruta";
      $valor3 = $productos[$i]["ruta"];

      $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item3, $valor3);

      if($cabeceras["portada"] != ""){

          $imagenPortada = "<img src='".$cabeceras["portada"]."' class='img-thumbnail imgPortadaProductos' width='100px'>";

        }else{

          $imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
        }

      /*=============================================
        TRAER IMAGEN PRINCIPAL
        =============================================*/

        $imagenPrincipal = "<img src='".$productos[$i]["portada"]."' class='img-thumbnail imgTablaPrincipal' width='100px'>";

        /*=============================================
      TRAER MULTIMEDIA
        =============================================*/

        if($productos[$i]["multimedia"] != null){

          $multimedia = json_decode($productos[$i]["multimedia"],true);

          if($multimedia[0]["foto"] != ""){

            $vistaMultimedia = "<img src='".$multimedia[0]["foto"]."' class='img-thumbnail imgTablaMultimedia' width='100px'>";

          }else{

            $vistaMultimedia = "<img src='http://i3.ytimg.com/vi/".$productos[$i]["multimedia"]."/hqdefault.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

          }


        }else{

          $vistaMultimedia = "<img src='vistas/img/multimedia/default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

        }

        /*=============================================
        TRAER DETALLES
        =============================================*/

        $detalles = json_decode($productos[$i]["detalles"],true);

        if($productos[$i]["tipo"] == "fisico"){

        $Unidad = json_encode($detalles["Unidad"]);
        $codigo = json_encode($detalles["Codigo"]);
        $marca = json_encode($detalles["Marca"]);

        $vistaDetalles = "Unidad: ".str_replace(array("[","]",'"'), "", $Unidad)." - Codigo: ".str_replace(array("[","]",'"'), "", $codigo)." - Marca: ".str_replace(array("[","]",'"'), "", $marca);


        }else{


        $vistaDetalles = "Clases: ".$detalles["Clases"].", Tiempo: ".$detalles["Tiempo"].", Nivel: ".$detalles["Nivel"].", Acceso: ".$detalles["Acceso"].", Dispositivo: ".$detalles["Dispositivo"].", Certificado: ".$detalles["Certificado"];

        }

        /*=============================================
        TRAER PRECIO
        =============================================*/

        if($productos[$i]["precio"] == 0){

          $precio = "Gratis";
        
        }else{

          $precio = "$ ".number_format($productos[$i]["precio"],2);

        }

        /*=============================================
        TRAER ENTREGA
        =============================================*/

        if($productos[$i]["entrega"] == 0){

          $entrega = "Inmediata";
        
        }else{

          $entrega = $productos[$i]["entrega"]. " días hábiles";

        }
        /*=============================================
        TRAER LARGO
        =============================================*/
        if ($productos[$i]["largo"] == 0) {
          $largo = "no hay largo";
        }else{
          $largo = $productos[$i]["largo"]. " cm";
        }
        /*=============================================
        TRAER ANCHO
        =============================================*/
        if ($productos[$i]["ancho"] == 0) {
          $ancho = "no hay ancho";
        }else{
          $ancho = $productos[$i]["ancho"]. " cm";
        }
        /*=============================================
        TRAER LARGO
        =============================================*/
        if ($productos[$i]["alto"] == 0) {
          $alto = "no hay alto";
        }else{
          $alto = $productos[$i]["alto"]. " cm";
        }
        /*=============================================
        TRAER stock
        =============================================*/
        if ($productos[$i]["stock"] == 0) {
          $stock = "Sin stock";
        }else{
          $stock = $productos[$i]["stock"]. " productos";
        }
        /*=============================================
        TRAER ENTRADAS
        =============================================*/
        /*
        if ($productos[$i]["entradas"] == 0) {
          $entradas = "no hay entradas en este producto";
        }else{
          $entradas = $stock+$productos[$i]["agregarStock"]. "";
        }
        */
        /*=============================================
        TRAER SALIDAS
        =============================================*/
        /*
        if ($productos[$i]["salidas"] == 0) {
          $salidas = "no hay salidas en este producto";
        }else{
          $salidas = $entradas-$productos[$i]["salidas"]. "";
        }
        */
        /*=============================================
        TRAER EXISTENCIAS
        =============================================*/
        /*
        if ($productos[$i]["existencias"] == 0) {
          $existencias = "no hay existencias en este producto";
        }else{
          $existencias = $productos[$i]["existencias"]. "";
        }
        */
        /*=============================================
        REVISAR SI HAY OFERTAS
        =============================================*/
        
      if($productos[$i]["oferta"] != 0){

        if($productos[$i]["precioOferta"] != 0){  

          $tipoOferta = "PRECIO";
          $valorOferta = "$ ".number_format($productos[$i]["precioOferta"],2);

        }else{

          $tipoOferta = "DESCUENTO";
          $valorOferta = $productos[$i]["descuentoOferta"]." %";  

        } 

      }else{

        $tipoOferta = "No tiene oferta";
        $valorOferta = 0;
        
      }

        /*=============================================
        TRAER IMAGEN OFERTA
        =============================================*/

        if($productos[$i]["imgOferta"] != ""){

          $imgOferta = "<img src='".$productos[$i]["imgOferta"]."' class='img-thumbnail imgTablaProductos' width='100px'>";

        }else{

          $imgOferta = "<img src='vistas/img/ofertas/default/default.jpg' class='img-thumbnail imgTablaProductos' width='100px'>";

        }

        /*=============================================
        TRAER LAS ACCIONES
        =============================================*/

        $acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' imgOferta='".$productos[$i]["imgOferta"]."' rutaCabecera='".$productos[$i]["ruta"]."' imgPortada='".$cabeceras["portada"]."' imgPrincipal='".$productos[$i]["portada"]."'><i class='fa fa-times'></i></button></div>";

        /*=============================================
        CONSTRUIR LOS DATOS JSON
        =============================================*/


      $datosJson .='[
          
          "'.($i+1).'",
          "'.$productos[$i]["titulo"].'",
          "'.$categoria.'",
          "'.$subcategoria.'",
          "'.$productos[$i]["ruta"].'",
          "'.$estado.'",
          "'.$productos[$i]["tipo"].'",
          "'.$cabeceras["descripcion"].'",
            "'.$cabeceras["palabrasClaves"].'",
            "'.$imagenPortada.'",
            "'.$imagenPrincipal.'",
            "'.$vistaMultimedia.'",
            "'.$vistaDetalles.'",
            "'.$precio.'",
            "'.$productos[$i]["peso"].' kg",
            "'.$entrega.'",
            "'.$largo.'",
            "'.$ancho.'",
            "'.$alto.'",
            "'.$stock.'",
            "'.$tipoOferta.'",
            "'.$valorOferta.'",
            "'.$imgOferta.'",
            "'.$productos[$i]["finOferta"].'",      
            "'.$acciones.'"    

      ],';

    }

    $datosJson = substr($datosJson, 0, -1);

    $datosJson .= ']

    }';

    echo $datosJson;

  }


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();