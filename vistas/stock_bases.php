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
 require_once('../modales/new_barcode_lentes.php');
 require_once('../modelos/Stock.php');

 date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H-i-s");
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

  .filas:hover {
    background-color: lightyellow;
  }
</style>

  <script src="../plugins/exportoExcel.js"></script>
  <script src="../plugins/keymaster.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style='font-family: Helvetica, Arial, sans-serif;'>
<div class="wrapper">
<!-- top-bar -->
  <?php 
  require_once("../modelos/Pruebas.php");
  $productos = new Productos();  
  require_once('top_menu.php')?>

  <?php require_once('side_bar.php');   
  ?>
  <div class="content-wrapper">
    <section class="content">     
    <table width="100%" class="table-bordered" id="tabla_base">
    <button type="button" class="btn btn-tool" onClick="downloadExcelTermx()"><i class="fas fa-file-excel"></i>DESC</button>
       <?php
        $stock = new Stock();
        $stock->getTablesBases('Divel');
       ?> 
    </table>
    </section>    
  </div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>2021 Lenti || <b>Version</b> 1.0</strong>
   &nbsp;All rights reserved.
  <div class="float-right d-none d-sm-inline-block">      
</div>
<?php require_once("links_js.php"); ?>

<script type="text/javascript" src="../js/productos.js"></script>
<script type="text/javascript" src="../js/stock.js"></script>
</footer>
</div>
</body>
</html>
<?php } else{
  echo "Acceso denegado";
} ?>


