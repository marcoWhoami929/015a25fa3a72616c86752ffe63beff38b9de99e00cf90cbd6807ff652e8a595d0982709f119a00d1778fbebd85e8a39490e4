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
      Pedidos
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Pedidos</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">  

      <div class="box-header with-border">

      </div>

      <div class="box-body">

        <div class="box-tools">

          <a href="vistas/modulos/reportes.php?reporte=pedidos">

            <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

          </a>

        </div> 

        <br>
         
        <table class="table table-bordered table-striped dt-responsive tablaPedidos" width="100%">

          <thead>
            
            <tr>
              <th>Id Pedido</th>
              <th>Usuario</th>
              <th>Total Productos</th>
            </tr>

          </thead>

        </table> 

      </div>
        
    </div>

  </section>

</div>



