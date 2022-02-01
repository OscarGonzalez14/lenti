 <style>
   #headModal{
  background-color: black;
  color: white;
  text-align: center;
}

<?php
require_once("../modelos/Opticas.php");
$optica = new Opticas();
$opti=$optica->obtener_opticas();
 ?>

 </style>
 <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../estilos/styles.css">
  </head>
  <body>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="nueva_sucursal_optica" style="border-radius:0px !important;">
    <div class="modal-dialog modal-lg" id="tanModal">
      <!-- cabecera de la modal-->
      <div class="modal-content" >
        <div class="modal-header" style="justify-content: space-between; background: black;color: white;">
          <span id="t_dinamico"><i class="fas fa-plus-square"></i><strong> CREAR SUCURSAL DE OPTICA</strong></span>
          <button type="button" class="close" id="cerrar" data-dismiss="modal" style="color:white;">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row">
            <div class=" form-group col-sm-4 select2-purple">
              <label for="ex3">Optica</label>
              <select class="select2 form-control clear_input" id="id_optica" multiple="multiple" data-placeholder="Seleccionar optica" data-dropdown-css-class="select2-purple" style="width: 100%;height: ">              
                <option value="0">Seleccione Optica</option>
                <?php
                for ($i=0; $i < sizeof($opti); $i++) { ?>
                  <option value="<?php echo $opti[$i]["id_optica"]?>"><?php echo strtoupper($opti[$i]["nombre"]);?></option>
                <?php  } ?>              
              </select>               
            </div>
            <div class="form-group col-md-6">
              <label for="ex3">Nombre Distintivo </label>
              <input type="text"  class="form-control clear_input" name="" placeholder="Nombre de sucursal" required="" id="nom_sucursal" >
            </div>
            <div class="form-group col-md-2">
              <label for="ex3">Categoría</label>
              <select name="" id="cat_descuento" class="form-control">
                <option value="Silver">Silver</option>
                <option value="Gold">Gold</option>
                <option value="Black">Black</option>
              </select>
            </div>
            <div class="form-group col-md-6">                  
              <label for="exampleFormControlSelect1">Departamento</label>
              <select class="form-control" id="dep_sucursal" class="class_depto">
                <option value="">Seleccione departamento</option>
                <option class="class_depto" value="Ahuachapán">Ahuachapán</option>
                <option class="class_depto" value="Santa Ana">Santa Ana</option>
                <option class="class_depto" value="Sonsonate">Sonsonate</option>
                <option class="class_depto" value="Chalatenango">Chalatenango</option>
                <option class="class_depto" value="La Libertad">La Libertad</option>
                <option class="class_depto" value="San Salvador">San Salvador</option>
                <option class="class_depto" value="Cuscatlán">Cuscatlán</option>
                <option class="class_depto" value="La Paz">La Paz</option>
                <option class="class_depto" value="Cabañas">Cabañas</option>
                <option class="class_depto" value="San Vicente">San Vicente</option>
                <option class="class_depto" value="Usulután">Usulután</option>
                <option class="class_depto" value="San Miguel">San Miguel</option>
                <option class="class_depto" value="Morazán">Morazán</option>
                <option class="class_depto" value="La Unión">La Unión</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label for="ex3">Municipio</label>
              <select class="form-control select2 clear_input" multiple="multiple" data-dropdown-css-class="select2-purple" id="mun_sucursal" data-placeholder='Seleccione Municipio' required=''> 
              </select>             
            </div>
            <div class="form-group col-md-7">
              <label for="ex3">Dirección</label>
              <input type="text"  class="form-control clear_input" name="" placeholder="Dirección" required="" id="dir_sucursal" onkeyup="mayus(this);" >
            </div>
            <div class="form-group col-md-5">
              <label for="ex3">Teléfono</label>
              <input type="text"  class="form-control clear_input" name="" placeholder="Teléfono de sucursal" required="" id="tel_sucursal">
            </div>
            <div class="form-group col-md-6">
              <label for="ex3">Correo</label>
              <input type="text"  class="form-control clear_input" name="" placeholder="Correo de sucursal" required="" id="correo_sucursal">
            </div>
            <div class="form-group col-md-6">
              <label for="ex3">Encargado</label>
              <input type="text"  class="form-control clear_input" name="" placeholder="Encargado de sucursal" required="" id="encargado_sucursal" onkeyup="mayus(this);" >
            </div>
          </div>
        </div>
        <input type="hidden" class="form-control" id='id_usuario' value="<?php echo $_SESSION['id_usuario']?>" >
        <input type="hidden" class="form-control clear_input" name="" id="id_sucursal" value="">
        <input type="hidden" class="form-control clear_input" id="codigo_suc" readonly="" style="background: white;border: 1px solid white;color:black;text-align:right;">
        <!-- Modal footer -->
        <div class="modal-footer btns_acciones" style="margin-top:3px;">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" id="guardar_suc" style="border-radius:0px" onClick="guardar_sucursal();"><i class="fas fa-save"></i> Guardar</button>
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" id="editar_suc" style="border-radius:0px" onClick="guardar_sucursal();"><i class="fas fa-save"></i> Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
  </body>
  </html>

<script>
function mayus(e) {
    e.value = e.value.toUpperCase();
}

</script>