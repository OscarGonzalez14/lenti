<?php 
require_once("../config/conexion.php");
if(isset($_SESSION["usuario"])){
$cat_admin = $_SESSION["categoria"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
<?php require_once("links_plugin.php"); 
 require_once('../modelos/Ordenes.php');
 require_once('../modales/detalle_orden.php');
 $ordenes = new Ordenes();
 $suc = $ordenes->get_opticas(); 
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
  <?php require_once('top_menu.php');?>
  <!-- /.top-bar -->

  <!-- Main Sidebar Container -->
  <?php require_once('side_bar.php');
    require_once('../modales/nueva_orden_lab.php');
  ?>
  <!--End SideBar Container-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION['codigo_emp']?>"/>
      <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["usuario"];?>"/>
        <div style="border-top: 0px">
      <!--<a class="btn btn-app bg-info btn-sm btn-flat" data-toggle="modal" data-target="#nueva_orden_lab" onClick='get_numero_orden();' style="border-radius: 5px;margin:2px;">
            <i class="fas fa-glasses"></i> Crear orden
        </a>-->
        </div>
      <button class="btn btn-outline-primary btn-sm btn-flat new_order_class" data-toggle="modal" data-target="#nueva_orden_lab" data-backdrop="static" data-keyboard="false" onClick='get_numero_orden();' id="new_order"><i class="fa fa-glasses" style="margin-top: 2px"> Crear Orden</i></button>
      <div class="card card-dark card-outline" style="margin: 2px;">
        <h5 style="text-align: center; font-size: 14px" align="center" class="bg-info">ORDENES DIGITADAS-LABORATORIO</h5>
       <table width="100%" class="table-hover table-bordered" id="datatable_ordenes" data-order='[[ 0, "desc" ]]'>        
         <thead class="style_th bg-dark" style="color: white">
           <th>Id</th>
           <th>Códgo</th>
           <th>Óptica</th>
           <th>Paciente</th>
           <th>Estado</th>
           <th>Detalles</th>
           <th>Viñeta</th>
           <th>Aciones</th>
         </thead>
         <tbody class="style_th"></tbody>
       </table>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



  <div class="modal fade" id="contenedor">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-body">
        <div class="dropdown-divider"></div>
          <label for=""># Contenedor</label>
          <input type="text" class="form-control clear_orden_i is-error" id="contenedor_orden">
        </div><!--./Modal body-->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-block" onClick='guardar_orden();' id="reg_orden"><i class="fas fa-save"></i> Guardar Orden</button>
          <button type="button" class="btn btn-dark btn-block" onClick='printEtiqueta();' id="print_etiqueta"><i class="fas fa-barcode"></i> Imprimir etiqueta</button>
        </div>
        <input type="hidden" id="numero_etiqueta">    
    </div><!--./Modal content-->
  </div>
  </div><!--Fin Modal-->
  <!-- /.modal-dialog -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>2021 Lenti || <b>Version</b> 1.0</strong>
     &nbsp;All rights reserved.
    <div class="float-right d-none d-sm-inline-block">      
    </div>
    <?php 
require_once("links_js.php");
?>
<script type="text/javascript" src="../js/ordenes.js"></script>
  </footer>
</div>

<!-- ./wrapper -->

</body>
</html>
 <?php } else{
echo "Acceso denegado";
  } ?>


