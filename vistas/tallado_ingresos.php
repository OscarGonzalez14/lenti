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
 require_once('../modales/ingresos_tallado.php');
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
  require_once('top_menu.php')?>

  <?php require_once('side_bar.php');   
  ?>
  <div class="content-wrapper">       
    <button class="btn btn-info btn-sm btn-flat new_order_class" data-toggle="modal" data-target="#ing_tallado" data-backdrop="static" data-keyboard="false"  onClick="input_focus_clear()();" style="border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px;text-align: center;margin-top: 5px;margin-left: 4px"><i class="fas fa-sort" style="margin-top: 2px"> Registrar ingresos</i></button>
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
<script type="text/javascript" src="../js/tallado.js"></script>

  </footer>
</div>

<!-- ./wrapper -->

</body>
</html>
 <?php } else{
echo "Acceso denegado";
  } ?>
