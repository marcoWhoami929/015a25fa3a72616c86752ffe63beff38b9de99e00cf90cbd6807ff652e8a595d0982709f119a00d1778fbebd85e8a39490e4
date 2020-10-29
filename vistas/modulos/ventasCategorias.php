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
      Gestor ventas Categorias
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Ventas Categorias</li>
      
    </ol>

  </section>


  <section class="content">

    <div class="box"> 

      <div class="box-header with-border">
        
        <?php

            include("inicio/grafico-ventas-categorias.php");

        ?>

      </div>

      <div class="box-body">

        <div class="box-tools">

          <a href="vistas/modulos/reportes.php?reportes=productos">
            
              <button class="btn btn-success">Descargar reporte en Excel</button>

          </a>

        </div>

        <br>
        
        <table class="table table-bordered table-striped dt-responsive tablaVentasCategorias" width="100%">
        
          <thead>
            
            <tr>

              <th>Id Categoria</th>
              <th>Categoria</th>
              <th>Ventas</th>
             
            </tr>

          </thead> 


        </table>


      </div>

    </div>

  </section>

</div>