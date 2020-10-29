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
      Gestor Clientes Mayoreo
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Clientes Mayoreo</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">  

      <div class="box-header with-border">

      </div>

      <div class="box-body">

        <div class="box-tools">

          <a href="vistas/modulos/reportes.php?reporte=usuariosmayoreo">

            <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

          </a>

        </div> 

        <br>
         
        <table class="table table-bordered table-striped dt-responsive tablaUsuariosMayoreo" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Nombre de Usuario</th>
              <th>Email</th>
              <th>Modo</th>
              <th>Foto</th>
              <th>Estado</th>
              <th>Rfc</th>
              <th>Teléfono</th>
              <th>Fecha</th>

            </tr>

          </thead>

        </table> 

      </div>
        
    </div>

  </section>

</div>



