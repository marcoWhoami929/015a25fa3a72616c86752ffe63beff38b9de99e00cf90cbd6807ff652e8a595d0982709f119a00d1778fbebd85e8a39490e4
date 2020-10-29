<?php

$deseos = ControladorPlantilla::ctrMostrarTotalDeseos("id");
$totalDeseos = count($deseos);

$listadeseos=ControladorPlantilla::CtrMostrarDeseos("id");

$deseos = ControladorPlantilla::ctrMostrarTotalDeseosUsuario("id");
$totalUsuarios = count($deseos);

$deseos = ControladorPlantilla::ctrMostrarTotalDeseoProductos("id");
$totalProductos = count($deseos);

?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Extras
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Extras</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
      <div class="col-lg-12">
      <div class="box box-primary pre-scrollable">
        <div class="box-header with-border">
          <h3 class="box-title">Productos deseados por los usuarios</h3>
        </div>
        <div class="box-body">
         <ul class="products-list product-list-in-box">
           <?php

        for($i = 0; $i < 9; $i++){

          echo '<li class="item">
                <div class="product-img">
                  <img src="'.$listadeseos[$i]["portada"].'" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="" class="product-title">'.$listadeseos[$i]["titulo"];

                if($listadeseos[$i]["precio"] == 0){
                    
                    echo '<span class="label label-warning pull-right">GRATIS</span></a>';

                 }else{

                  echo '<span class="label label-warning pull-right">$'.$listadeseos[$i]["precio"].'</span></a>';

                }
                      
             echo '</div>
              </li>';

        }

      ?>
          
        </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
         
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </div>
    <div class="col-lg-4">
    <div  class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-heart-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Deseos</span>
        <span class="info-box-number"><?php echo number_format($totalDeseos); ?></span>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div  class="info-box">
      <span class="info-box-icon bg-primary"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Usuarios</span>
        <span class="info-box-number"><?php echo number_format($totalUsuarios); ?></span>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div  class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-paint-brush"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Productos</span>
        <span class="info-box-number"><?php echo number_format($totalProductos); ?></span>
      </div>
    </div>
  </div>
  </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->