<!--=====================================
MENU
======================================-->	

<ul class="sidebar-menu">

	<li class="active"><a href="inicio"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

  <?php

  if($_SESSION["perfil"] == "administrador"){

	echo '<li><a href="comercio"><i class="fa fa-files-o"></i> <span>Gestor Comercio</span></a></li>';

  }

  ?>
  <?php 
  if ($_SESSION["perfil"] == "administrador") {
    echo '<li><a href="slide"><i class="fa fa-edit"></i> <span>Gestor Slide</span></a></li>';
  }
  ?>
	

	<li class="treeview">
      
      <a href="#">
        <i class="fa fa-th"></i>
        <span>Gestor Categorías</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>

      <ul class="treeview-menu" style="z-index: 101">
        
        <li><a href="categorias"><i class="fa fa-circle-o"></i> Categorías</a></li>
        <li><a href="subcategorias"><i class="fa fa-circle-o"></i> Subcategorías</a></li>
      
      </ul>

  </li>

  <li><a href="productos"><i class="fa fa-product-hunt"></i> <span>Gestor Productos</span></a></li>
  <?php

    if ($_SESSION["perfil"] == "administrador") {

     echo '<li><a href="inventario"><i class="fa fa-cubes"></i><span>Gestor Inventario</span></a></li>';
      echo '<li><a href="clientes"><i class="fa fa-users"></i><span>Gestor Clientes Mayoreo</span></a></li>';
    }
  
  ?>

  <li><a href="banner"><i class="fa fa-map-o"></i> <span>Gestor Banner</span></a></li>

  <?php

  if($_SESSION["perfil"] == "administrador"){

  echo '<li><a href="ventas"><i class="fa fa-shopping-cart"></i> <span>Gestor Ventas</span></a></li>';
  echo '<li><a href="pedidos-mayoreo"><i class="fa fa-shopping-cart"></i> <span>Gestor Pedidos</span></a></li>';

  echo '<li><a href="ventasCategorias"><i class="fa fa-shopping-bag"></i><span>Gestor Ventas Categorias</span></a></li>';

  }

  ?>

  <li><a href="visitas"><i class="fa fa-map-marker"></i> <span>Gestor Visitas</span></a></li>

  <li><a href="usuarios"><i class="fa fa-users"></i> <span>Gestor Usuarios</span></a></li>

  <li><a href="comentarios"><i class="fa fa-envelope"></i> <span>Gestor Comentarios</span></a></li>

  <li><a href="extras"><i class="fa fa-star"></i> <span>Extras</span></a></li>
  

  <?php

   if($_SESSION["perfil"] == "administrador"){

    echo '<li><a href="perfiles"><i class="fa fa-key"></i> <span>Gestor Perfiles</span></a></li>';

  }
   if ($_SESSION["perfil"] == "administrador") {
    echo '<li><a href="respaldo"><i class="fa fa-database"></i><span>Respaldo Base De Datos</span></a></li>';
  }
   if ($_SESSION["perfil"] == "administrador") {
    echo '<li><a href="restauracion"><i class="fa fa-refresh"></i><span>Restaurar Base De Datos</span></a></li>';
  }

  ?>

</ul>	