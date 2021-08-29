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
 require_once('../modelos/Productos.php');
 require_once('../modales/warehouseIncome/vs_argreen_essilor.php');
 require_once('../modales/new_barcode_lentes.php');
 ?>
<style>
  .buttons-excel{
      background-color: green !important;
      margin: 2px;
      max-width: 150px;
  }

    .stilot1{
       border: 1px solid black;
       padding: 5px;
       font-size: 12px;
       font-family: Helvetica, Arial, sans-serif;
       border-collapse: collapse;
       text-align: center;
    }

    .stilot2{
       border: 1px solid black;
       text-align: center;
       font-size: 11px;
       font-family: Helvetica, Arial, sans-serif;
    }
    .stilot3{
       text-align: center;
       font-size: 11px;
       font-family: Helvetica, Arial, sans-serif;
    }

    #table2 {
       border-collapse: collapse;
    }

  .fila:hover {
  background-color: lightyellow;
}
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style='font-family: Helvetica, Arial, sans-serif;'>
<div class="wrapper">
<!-- top-bar -->
  <?php 
  require_once("../modelos/Pruebas.php");
  $productos = new Productos();
  $data = $productos->get_data_ar_green_term();
  require_once('top_menu.php')?>

  <?php require_once('side_bar.php');   
  ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        
      <div class="card card-dark card-outline" style="margin: 2px;">
        <h5 style="text-align: center;background:#034f84;color:white;font-family: Helvetica, Arial, sans-serif;font-size: 16px;">LENTE TERMINADO SPH GREEN, LENTES POR PARES</h5>
       
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong> Lenti || <b>Version</b> 1.0</strong>
     &nbsp;All rights reserved.
    <div class="float-right d-none d-sm-inline-block">      
    </div>
    <?php 
require_once("links_js.php");
?>
<script type="text/javascript" src="../js/productos.js"></script>
  </footer>
</div>

<!-- ./wrapper -->

</body>
</html>
 <?php } else{
echo "Acceso denegado";
  } ?>
