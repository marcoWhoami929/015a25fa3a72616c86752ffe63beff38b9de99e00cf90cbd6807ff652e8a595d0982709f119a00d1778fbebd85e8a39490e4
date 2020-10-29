<?php

require_once "../controladores/inventarios.controlador.php";
require_once "../modelos/inventarios.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class TablaInventarios{

  /*=============================================
  MOSTRAR LA TABLA DE INVENTARIOS
  =============================================*/ 

  public function mostrarTablaInventarios(){  

    $item = null;
    $valor = null;

    $inventarios = ControladorInventarios::ctrMostrarInventarios($item, $valor);

    $datosJson = '

      { 
        "data":[';

    for($i = 0; $i < count($inventarios); $i++){

      /*=============================================
        TRAER LAS CATEGORÍAS
        =============================================*/

        $item = "id";
      $valor = $inventarios[$i]["id_categoria"];

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
      $valor2 = $inventarios[$i]["id_subcategoria"];

      $subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item2, $valor2);

      if($subcategorias[0]["subcategoria"] == ""){

        $subcategoria = "SIN SUBCATEGORÍA";
      
      }else{

        $subcategoria = $subcategorias[0]["subcategoria"];
      }

      /*=============================================
        AGREGAR ETIQUETAS DE ESTADO
        =============================================*/

        if($inventarios[$i]["estado"] == 0){

          $colorEstado = "btn-danger";
          $textoEstado = "Desactivado";
          $estadoProducto = 1;

        }else{

          $colorEstado = "btn-success";
          $textoEstado = "Activado";
          $estadoProducto = 0;

        }

        $estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idProducto='".$inventarios[$i]["id"]."' estadoProducto='".$estadoProducto."'>".$textoEstado."</button>";

        /*=============================================
        TRAER LAS CABECERAS
        =============================================*/

        $item3 = "ruta";
      $valor3 = $inventarios[$i]["ruta"];

      $cabeceras = ControladorCabeceras::ctrMostrarCabeceras($item3, $valor3);

      if($cabeceras["portada"] != ""){

          $imagenPortada = "<img src='".$cabeceras["portada"]."' class='img-thumbnail imgPortadaProductos' width='100px'>";

        }else{

          $imagenPortada = "<img src='vistas/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
        }

      /*=============================================
        TRAER IMAGEN PRINCIPAL
        =============================================*/

        $imagenPrincipal = "<img src='".$inventarios[$i]["portada"]."' class='img-thumbnail imgTablaPrincipal' width='100px'>";

        /*=============================================
      TRAER MULTIMEDIA
        =============================================*/

        if($inventarios[$i]["multimedia"] != null){

          $multimedia = json_decode($inventarios[$i]["multimedia"],true);

          if($multimedia[0]["foto"] != ""){

            $vistaMultimedia = "<img src='".$multimedia[0]["foto"]."' class='img-thumbnail imgTablaMultimedia' width='100px'>";

          }else{

            $vistaMultimedia = "<img src='http://i3.ytimg.com/vi/".$inventarios[$i]["multimedia"]."/hqdefault.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

          }


        }else{

          $vistaMultimedia = "<img src='vistas/img/multimedia/default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";

        }

        /*=============================================
        TRAER DETALLES
        =============================================*/

        $detalles = json_decode($inventarios[$i]["detalles"],true);

        if($inventarios[$i]["tipo"] == "fisico"){

        $Unidad = json_encode($detalles["Unidad"]);
        $codigo = json_encode($detalles["Codigo"]);
        $marca = json_encode($detalles["Marca"]);

        foreach ($detalles["Codigo"] as $vistaDetalles => $vistaDetalle) {
              $Codigo = $vistaDetalle;
        }

        }else{


        $vistaDetalles = "Clases: ".$detalles["Clases"].", Tiempo: ".$detalles["Tiempo"].", Nivel: ".$detalles["Nivel"].", Acceso: ".$detalles["Acceso"].", Dispositivo: ".$detalles["Dispositivo"].", Certificado: ".$detalles["Certificado"];

        }

        /*=============================================
        TRAER PRECIO
        =============================================*/

        if($inventarios[$i]["precio"] == 0){

          $precio = "Gratis";
        
        }else{

          $precio = "$ ".number_format($inventarios[$i]["precio"],2);

        }

        /*=============================================
        TRAER ENTREGA
        =============================================*/

        if($inventarios[$i]["entrega"] == 0){

          $entrega = "Inmediata";
        
        }else{

          $entrega = $inventarios[$i]["entrega"]. " días hábiles";

        }
        /*=============================================
        TRAER LARGO
        =============================================*/
        if ($inventarios[$i]["largo"] == 0) {
          $largo = "no hay largo";
        }else{
          $largo = $inventarios[$i]["largo"]. " cm";
        }
        /*=============================================
        TRAER ANCHO
        =============================================*/
        if ($inventarios[$i]["ancho"] == 0) {
          $ancho = "no hay ancho";
        }else{
          $ancho = $inventarios[$i]["ancho"]. " cm";
        }
        /*=============================================
        TRAER LARGO
        =============================================*/
        if ($inventarios[$i]["alto"] == 0) {
          $alto = "no hay alto";
        }else{
          $alto = $inventarios[$i]["alto"]. " cm";
        }
        /*=============================================
        TRAER stock
        =============================================*/
        if ($inventarios[$i]["stock"] == 0) {
          $stock = "0";
        }else{
          $stock = $inventarios[$i]["stock"]. "";
        }
        /*=============================================
        TRAER ENTRADAS
        =============================================*/
        
        if ($inventarios[$i]["entradas"] == 0) {
          $entradas = "0";
        }else {
          $entradas = $stock + $inventarios[$i]["entradas"]. "";
        }
      
        
        /*=============================================
        TRAER SALIDAS
        =============================================*/
        
        if ($inventarios[$i]["ventas"] == 0) {
          $salidas = "0";
        }else{
          $salidas = $inventarios[$i]["ventas"]. "";
        }
        
        /*=============================================
        TRAER EXISTENCIAS
        =============================================*/
        
        if ($inventarios[$i]["existencias"] == 0) {
          $existencias = $stock;
        }else{
          $existencias =$inventarios[$i]["existencias"]. "";
        }
        
        /*=============================================
        REVISAR SI HAY OFERTAS
        =============================================*/
        
      if($inventarios[$i]["oferta"] != 0){

        if($inventarios[$i]["precioOferta"] != 0){  

          $tipoOferta = "PRECIO";
          $valorOferta = "$ ".number_format($inventarios[$i]["precioOferta"],2);

        }else{

          $tipoOferta = "DESCUENTO";
          $valorOferta = $inventarios[$i]["descuentoOferta"]." %";  

        } 

      }else{

        $tipoOferta = "No tiene oferta";
        $valorOferta = 0;
        
      }

        /*=============================================
        TRAER IMAGEN OFERTA
        =============================================*/

        if($inventarios[$i]["imgOferta"] != ""){

          $imgOferta = "<img src='".$inventarios[$i]["imgOferta"]."' class='img-thumbnail imgTablaProductos' width='100px'>";

        }else{

          $imgOferta = "<img src='vistas/img/ofertas/default/default.jpg' class='img-thumbnail imgTablaProductos' width='100px'>";

        }

        /*=============================================
        TRAER LAS ACCIONES
        =============================================*/ 
        
        if ($inventarios[$i]["stockMax"] <= $existencias) {
              
        $acciones = "<div class='btn-group'><button class='btn btn-warning btnAlertaStock' id='btnAlertaStock'><i class='fa fa-hand-paper-o' aria-hidden='true'></i></button></div>";
        }else{

        $acciones = "<div class='btn-group'><button class='btn btn-info btnEditarInventario' idProducto='".$inventarios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarInventario'><i class='fa fa-cart-plus fa-2x' aria-hidden='true'></i></button></div>";
        }

        /*=============================================
        CONSTRUIR LOS DATOS JSON
        =============================================*/


      $datosJson .='[
          
          "'.($i+1).'",
          "'.$Codigo.'",
          "'.$imagenPrincipal.'",
          "'.$inventarios[$i]["titulo"].'",
          "'.$categoria.'",
          "'.$precio.'",
          "'.$stock.'",
          "'.$entradas.'",
          "'.$salidas.'",
          "'.$existencias.'",
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
ACTIVAR TABLA DE INVENTARIOS
=============================================*/ 
$activarInventarios = new TablaInventarios();
$activarInventarios -> mostrarTablaInventarios();