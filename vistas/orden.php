<?php 
require_once("../config/conexion.php");
if(isset($_SESSION["usuario"])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
<?php require_once("links_plugin.php"); 
 require_once('../modelos/Ordenes.php');
 $ordenes = new Ordenes();
 $suc = $ordenes->get_opticas();
 require_once('../modales/nueva_orden_lab.php');
 ?>
<style>
  .buttons-excel{
      background-color: green !important;
      margin: 2px;
      max-width: 150px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style='font-family: Helvetica, Arial, sans-serif;'>
<div class="wrapper">
<!-- top-bar -->
  <?php require_once('top_menu.php')?>
  <!-- /.top-bar -->

  <!-- Main Sidebar Container -->
  <?php require_once('side_bar.php')?>
  <!--End SideBar Container-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
      <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
        <div style="border-top: 0px">
      <!--<a class="btn btn-app bg-info btn-sm btn-flat" data-toggle="modal" data-target="#nueva_orden_lab" onClick='get_numero_orden();' style="border-radius: 5px;margin:2px;">
            <i class="fas fa-glasses"></i> Crear orden
        </a>-->
        </div>
      <button class="btn btn-outline-primary btn-sm btn-flat" data-toggle="modal" data-target="#nueva_orden_lab" onClick='get_numero_orden();'><i class="fa fa-glasses" style="margin-top: 2px"> Crear Orden</i></button>
      <div class="row">
         <div class="col-sm-4"></div>
         <div class="col-sm-4"></div>
         <div class="col-sm-4"><input type="text" class="form-control"></div>
       </div>
      <div class="card card-dark card-outline" style="margin: 2px;">
       <table width="100%" class="table-hover table-bordered" id="datatable_ordenes">        
         <thead class="style_th bg-dark" style="color: white">
           <th>Códgo</th>
           <th>Óptica</th>
           <th>Paciente</th>
           <th>Estado</th>
           <th>Detalles</th>
           <th>Imprimir</th>
           <th>Aciones</th>
         </thead>
         <tbody class="style_th"></tbody>
       </table>
      </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>2021 Lenti || <b>Version</b> 1.0</strong>
     &nbsp;All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
</div>

<!-- ./wrapper -->
<?php 
require_once("links_js.php");
?>
<script type="text/javascript" src="../js/ordenes.js"></script>
</body>
</html>
 <?php } else{
echo "Acceso denegado";
  } ?>
