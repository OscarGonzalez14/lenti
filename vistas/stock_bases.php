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
 require_once('../modales/warehouseIncome/modalIngresoBaseVs.php');
 require_once('../modales/new_barcode_lentes.php'); 
 require_once('../modelos/Stock.php');
 $marcas = ['Divel', 'Essilor'];

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

  .filasb:hover {
    background-color: lightyellow;
  }
</style>

  <script src="../plugins/exportoExcel.js"></script>
  <script src="../plugins/keymaster.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style='font-family: Helvetica, Arial, sans-serif;'><div class="wrapper">
<!-- top-bar -->
  <?php 
  require_once("../modelos/Pruebas.php");
  $productos = new Productos();  
  require_once('top_menu.php')?>

  <?php require_once('side_bar.php');   
  ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <?php
        $i=0;
        foreach ($marcas as $val) { 
         ($i % 2 == 0) ? $color='info': $color='primary';
         ($i % 2 == 0) ? $borde='#5bc0de': $borde='#0275d8';
        ?>
          <div class="col-md-12">
          <div class="card card-<?php echo $color;?> collapsed-card" style="border: solid 1px <?php echo $borde;?>">
          <div class="card-header">
              <h5 class="card-title" style="font-size: 16px"><?php echo "BASES VISIÓN SENCILLA ".strtoupper($val);?></h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" onClick="get_dataTableBase('<?php echo 'base'.$val;?>','<?php echo $val;?>');"><i class="fas fa-plus"></i>
                  </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
              </div>
          </div>
            <div class="card-body">
            <table id="<?php echo 'base'.$val;?>" width="100%" class="table-bordered" style="margin-top: 0px">
              
            </table>
            </div>
        </div>
      </div>
        <?php $i++; } ?>
      </div>
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


