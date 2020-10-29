<?php

if($_SESSION["perfil"] != "administrador"){

echo '<script>

  window.location = "inicio";

</script>';

return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

   <h1>
      Gestor Inventarios
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Inventarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
       
    

      <div class="box-body">
        <div class="box-tools">

          <a href="vistas/modulos/reportes.php?reporte=productos">
            
              <button class="btn btn-success">Descargar Inventario</button>

          </a>

        </div>

        <br>

        <table class="table table-bordered table-striped dt-responsive tablaInventarios" width="100%">
        
          <thead>
         
            <tr>
             
               <th style="width:10px">#</th>
               <th>Código</th>
               <th>Imagen Principal</th>
               <th>Producto</th>
               <th>Categoría</th>
               <th>Precio</th>
               <th>Stock Inicial</th>
               <th>Entradas</th>
               <th>Salidas</th>
               <th>Existencias</th>
               <th>Acciones</th>
               

            </tr> 

          </thead>   
     
        </table>
          
      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL EDITAR INVENTARIO
======================================-->

<div id="modalEditarInventario" class="modal fade" role="dialog">
  
   <div class="modal-dialog">
     
     <div class="modal-content">
          
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
            ENTRADA PARA EL TÍTULO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                  <input type="text" class="form-control input-lg validarProducto tituloProducto" readonly>

                  <input type="hidden" class="idProducto">
                  <input type="hidden" class="idCabecera">

                </div>

            </div>

            <!--=====================================
            ENTRADA PARA LA RUTA DEL PRODUCTO
            ======================================-->

            <div class="form-group">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-link"></i></span> 

                  <input type="text" class="form-control input-lg rutaProducto" readonly>

                </div>

            </div>

           <!--=====================================
            ENTRADA PARA SELECCIONAR EL TIPO DEL PRODUCTO
            ======================================-->

            <div class="form-group" style="display: none;">
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span> 

                   <input type="text" class="form-control input-lg seleccionarTipo" readonly>

                </div>

            </div>

            <!--=====================================
            ENTRADA PARA AGREGAR MULTIMEDIA
            ======================================-->

            <div class="form-group agregarMultimedia" style="display: none;"> 

              <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO VIRTUAL
              ======================================-->
              
              <div class="input-group multimediaVirtual" style="display:none">
                
                <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span> 
              
                 <input type="text" class="form-control input-lg multimedia">

              </div>

              <!--=====================================
              SUBIR MULTIMEDIA DE PRODUCTO FÍSICO
              ======================================-->

              <div class="row previsualizarImgFisico" style="display: none;"></div>
              
              <div class="multimediaFisica needsclick dz-clickable" style="display:none">

                <div class="dz-message needsclick">
                  
                  Arrastrar o dar click para subir imagenes.

                </div>

              </div>
   
            </div>

            <!--=====================================
            AGREGAR DETALLES VIRTUALES
            ======================================-->

            <div class="detallesVirtual" style="display:none">
              
              <div class="panel">DETALLES</div>

                <!-- CLASES -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Clases" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleClases" placeholder="Descripción">
                  </div>

                </div>

                <!-- TIEMPO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Tiempo" readonly>
                  </div>

                  <div class="col-xs-9">
                    <input type="text" class="form-control input-lg detalleTiempo" placeholder="Descripción">
                  </div>

                </div>

                <!-- NIVEL -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Nivel" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleNivel" placeholder="Descripción">
                  </div>

                </div>

                <!-- ACCESO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Acceso" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleAcceso" placeholder="Descripción">
                  </div>

                </div>

                <!-- DISPOSITIVO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Dispositivo" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleDispositivo" placeholder="Descripción">
                  </div>

                </div>

                <!-- CERTIFICADO -->

                <div class="form-group row">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Certificado" readonly>
                  </div>

                  <div class="col-xs-9">
                      <input type="text" class="form-control input-lg detalleCertificado" placeholder="Descripción">
                  </div>

                </div>

            </div>

            <!--=====================================
            AGREGAR DETALLES FÍSICOS
            ======================================-->  

            <div class="detallesFisicos">
              
              <div class="panel"  style="display:none">DETALLES</div>

              <!-- Unidad-->

                <div class="form-group row" style="display:none">

                  <div class="col-xs-3">
                    <input class="form-control input-lg" type="text" value="Unidad" readonly>
                  </div>

                  <div class="col-xs-9 editarUnidad">
                   <!--  <input class="form-control input-lg tagsInput detalleUnidad" data-role="tagsinput" type="text" placeholder="Separe valores con coma"> -->
                  </div>

              </div>

              <!-- CÓDIGO -->

              <div class="form-group row" style="display:none">

                <div class="col-xs-3">
                  <input class="form-control input-lg" type="text" value="Código" readonly>
                </div>

                <div class="col-xs-9 editarCodigo">
                  <input class="form-control input-lg tagsInput detalleCodigo" data-role="tagsinput" type="text" placeholder="Separe valores con coma"> 
                </div>

              </div>

              <!-- MARCA -->

              <div class="form-group row" style="display:none">

                <div class="col-xs-3">
                  <input class="form-control input-lg" type="text" value="Marca" readonly>
                </div>

                <div class="col-xs-9 editarMarca">
                  <!--   <input class="form-control input-lg tagsInput detalleMarca" data-role="tagsinput" type="text" placeholder="Separe valores con coma"> -->
                </div>

              </div>

            </div> 

           <!--=====================================
            AGREGAR CATEGORÍA
            ======================================-->

            <div class="form-group" style="display: none;">
                
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarCategoria">
                  
                    <option class="optionEditarCategoria"></option>

                    <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    foreach ($categorias as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                    }

                    ?>

                  </select>

                </div>

            </div>

            <!--=====================================
            AGREGAR SUBCATEGORÍA
            ======================================-->

            <div class="form-group entradaSubcategoria" style="display: none;">
                
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg seleccionarSubCategoria">
                  
                    <option class="optionEditarSubCategoria"></option>

                  </select>

                </div>

            </div>

           <!--=====================================
            AGREGAR DESCRIPCIÓN
            ======================================-->

            <div class="form-group" style="display: none;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span> 

                <textarea type="text" maxlength="5000" rows="3" class="form-control input-lg descripcionProducto"></textarea>

              </div>

            </div>

            <!--=====================================
            AGREGAR PALABRAS CLAVES
            ======================================-->

            <div class="form-group editarPalabrasClaves" style="display: none;">
              
              <!--   <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                  <input type="text" class="form-control input-lg tagsInput pClavesProducto" data-role="tagsinput"  placeholder="Ingresar palabras claves">

                </div> -->

            </div>

            <!--=====================================
            AGREGAR FOTO DE PORTADA
            ======================================-->

            <div class="form-group" style="display: none;">
              
              <div class="panel">SUBIR FOTO PORTADA</div>

              <input type="file" class="fotoPortada">
              <input type="hidden" class="antiguaFotoPortada">

              <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/cabeceras/default/default.jpg" class="img-thumbnail previsualizarPortada" width="100%">

            </div>

            <!--=====================================
            AGREGAR FOTO DE MULTIMEDIA
            ======================================-->

            <div class="form-group" style="display: none;">
                
              <div class="panel">SUBIR FOTO PRINCIPAL DEL PRODUCTO</div>

              <input type="file" class="fotoPrincipal">
              <input type="hidden" class="antiguaFotoPrincipal">

              <p class="help-block">Tamaño recomendado 400px * 450px <br> Peso máximo de la foto 2MB</p>

              <img src="vistas/img/productos/default/default.jpg" class="img-thumbnail previsualizarPrincipal" width="200px">

            </div>

            <!--=====================================
            AGREGAR PRECIO, PESO Y ENTREGA
            ======================================-->

            <div class="form-group row" style="display: none;">
               
              <!-- PRECIO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PRECIO</div>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                  <input type="number" class="form-control input-lg precio" min="0" step="any">

                </div>

              </div>

              <!-- PESO -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">PESO</div>
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 

                  <input type="number" class="form-control input-lg peso" min="0" step="any" value="0">

                </div>

              </div>

              <!-- ENTREGA -->

              <div class="col-md-4 col-xs-12">
  
                <div class="panel">DÍAS DE ENTREGA</div>
              
                <div class="input-group">
              
                  <span class="input-group-addon"><i class="fa fa-truck"></i></span> 

                  <input type="number" class="form-control input-lg entrega" min="0" value="0">

                </div>

              </div>

            </div>
            <!--=====================================
            AGREGAR LARGO , ANCHO , ALTO
            ======================================-->
            <div class="form-group row" style="display: none;">
              <div class="col-md-4 col-xs-12">
                <div class="panel">LARGO</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-archive"></i></span>

                  <input type="number" class="form-control input-lg largo" min="0" value="0" placeholder="Largo">

                </div>

              </div>
              <div class="col-md-4 col-xs-12">
                <div class="panel">ANCHO</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-archive"></i></span>

                  <input type="number" class="form-control input-lg ancho" min="0" value="0" placeholder="Ancho">
                  
                </div>

              </div>
              <div class="col-md-4 col-xs-12">
                <div class="panel">ALTO</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-archive"></i></i></span>

                  <input type="number" class="form-control input-lg alto" min="0" value="0" placeholder="Alto">
                  
                </div>

              </div>
            </div>

            <!--=====================================
            AGREGAR STOCK, STOCK MÍNIMO, STOCK MÁXIMO
            ======================================-->
            
            <div class="form-group row">
              <div class="col-md-6 col-xs-12">
                <div class="panel">STOCK MÍNIMO</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-cubes"></i></span>

                  <input type="number" class="form-control input-lg stockMin" min="1" max="10" value="0" placeholder="Stock mínimo" disabled="true">
                  
                </div>

              </div>
              <div class="col-md-6 col-xs-12">
                <div class="panel">STOCK MÁXIMO</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-cubes"></i></span>

                  <input type="number" class="form-control input-lg stockMax" min="1" max="20" value="0" placeholder="Stock máximo" disabled="true">
                  
                </div>

              </div>
            </div>
            <div class="form-group row">
               <div class="col-md-6 col-xs-12">
                <div class="panel">STOCK INICIAL</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-cubes"></i></span>

                  <input type="number" class="form-control input-lg stock" min="1" max="10" value="0" placeholder="Stock" disabled="true">

                </div>

              </div>
                <div class="col-md-6 col-xs-12">
                <div class="panel">AGREGAR STOCK</div>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-cubes"></i></span>

                  <input type="number" class="form-control input-lg validarStock agregarStock" min="1" max="10" value="0" placeholder="Agregar stock">

                </div>

              </div>
            </div>
        
            <!--=====================================
            AGREGAR OFERTAS
            ======================================-->

            <div class="form-group"  style="display:none">
              
              <select class="form-control input-lg selActivarOferta">
                
                <option value="">No tiene oferta</option>
                <option value="oferta">Activar oferta</option>
               
              </select>

            </div>

            <div class="datosOferta" style="display:none">
            
              <!--=====================================
              VALOR OFERTAS
              ======================================-->

              <div class="form-group row" style="display:none">
                  
                <div class="col-xs-6">

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 
                    
                    <input class="form-control input-lg valorOferta precioOferta" tipo="oferta" type="number" value="0" min="0" placeholder="Precio">

                  </div>

                </div>

                <div class="col-xs-6">
                     
                  <div class="input-group">
                       
                    <input class="form-control input-lg valorOferta descuentoOferta" tipo="descuento" type="number" value="0"  min="0" placeholder="Descuento">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

              <!--=====================================
              FECHA FINALIZACIÓN OFERTA
              ======================================-->

              <div class="form-group" style="display:none">
                  
                <div class="input-group date">
                      
                  <input type='text' class="form-control datepicker input-lg valorOferta finOferta">
                      
                  <span class="input-group-addon">
                          
                      <span class="glyphicon glyphicon-calendar"></span>
                      
                  </span>
                 
                </div>
              
              </div>

              <!--=====================================
              FOTO OFERTA
              ======================================-->

              <div class="form-group" style="display:none">
                
                <div class="panel">SUBIR FOTO OFERTA</div>

                <input type="file" class="fotoOferta valorOferta">
                <input type="hidden" class="antiguaFotoOferta">

                <p class="help-block">Tamaño recomendado 640px * 430px <br> Peso máximo de la foto 2MB</p>

                <img src="vistas/img/ofertas/default/default.jpg" class="img-thumbnail previsualizarOferta" width="100px">

              </div>

            </div>
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
  
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary guardarCambiosInventario">Agregar Stock</button>

        </div>

     </div>

   </div>

</div>

<?php

  $eliminarInventario = new ControladorInventarios();
  $eliminarInventario -> ctrEliminarInventario();

?>