<?php
  $comentarios = ControladorComentarios::ctrMostrarComentarios("comentarios");
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor Comentarios Clientes
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Gestor Comentarios Clientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">

         <table class="table table-bordered table-striped dt-responsive tablaComentarios" width="100%">
           <thead>

             <tr>
               <th style="width:10px">#</th>
               <th>Usuario</th>
               <th>Producto</th>
               <th>Calificación</th>
               <th>Comentario</th>
               <th>Fecha</th>
               <th>Acciones</th>
             </tr>

           </thead>

         </table>

        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php
        
    $eliminarComentario = new ControladorComentarios();
    $eliminarComentario -> ctrEliminarComentario();

  ?>