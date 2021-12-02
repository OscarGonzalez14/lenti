function init(){
 //document.getElementById("terminado_section").style.display = "none";
 //document.getElementById("base_section").style.display = "none";
 //document.getElementById("semiterminado_section").style.display = "none";
}
function alerts_productos(icono, titulo){
  Swal.fire({
        position: 'top-center',
        icon: icono,
        title: titulo,
        showConfirmButton: true,
        timer: 1000
      });
}
function valida_base_term(){
	let vs_term_check = $("#vs_term").is(":checked");
	let vs_semi_term_chk = $("#vs_semi_term").is(":checked");
	let bifo_flap_chk = $("#bifo_flap").is(":checked");
  let flap_terminado = $("#flap_terminado").is(":checked");
    
    if(vs_term_check) {
    	document.getElementById("terminado_section").style.display = "block";
    	document.getElementById("base_section").style.display = "none";
      document.getElementById("semiterminado_section").style.display = "none";
      document.getElementById("flap_terminado_section").style.display = "none";
    }else if(bifo_flap_chk ){
    	document.getElementById("base_section").style.display = "block";
    	document.getElementById("terminado_section").style.display = "none";
      document.getElementById("semiterminado_section").style.display = "none";
      document.getElementById("flap_terminado_section").style.display = "none";
    }else if(vs_semi_term_chk){
      document.getElementById("semiterminado_section").style.display = "block";
      document.getElementById("terminado_section").style.display = "none";
      document.getElementById("base_section").style.display = "none";
      document.getElementById("flap_terminado_section").style.display = "none";
    }else if(flap_terminado){
      document.getElementById("semiterminado_section").style.display = "none";
      document.getElementById("terminado_section").style.display = "none";
      document.getElementById("base_section").style.display = "none";
      document.getElementById("flap_terminado_section").style.display = "block";
    }
}

function focus_input(){
	$('input[name=codigob_lente]').focus();
}

$(document).on('shown.bs.modal', function (e) {
    $('[autofocus]', e.target).focus();
});
/*===================OBTENER Y VALIDAR CODIGO DE BARRA =========================*/
function set_code_bar(){
  let new_code = $("#codebar_lente").val();
  $.ajax({
    url:"../ajax/productos.php?op=verificar_existe_codigo",
    method:"POST",
    data:{new_code:new_code},
    cache: false,
    dataType:"json",
      success:function(data){
      console.log(data);
      if (data == 'Okcode') {
        let new_code = $("#codebar_lente").val();
        $("#categoria_codigo").val('Fabricante');
        $("#codigo_lente_term").val(new_code);
        $("#new_barcode_lens").modal('hide');
        $('#cant_ingreso').focus();
        $('#cant_ingreso').select();
      }else{
        Swal.fire({
        title: 'Error codigo!!',
        text: data,
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'NO',
        confirmButtonText: 'Ok'
        }).then((result) => {
        if (result.isConfirmed){
          $('#codigo_lente_term').val('');
          $('#codebar_lente').val('');
          $('#codebar_lente').focus();
        }
      });     
    }
    }      
  });
}

 function create_barcode_interno_term(){

  let tipo_lente = $("#tipo_lente_code").val();
  //let identificador = $("#id_td").val();
  console.log(tipo_lente);
  Swal.fire({
  title: 'Código interno?',
  text: "Desea generar un codigo Interno",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'NO',
  confirmButtonText: 'SI'
  }).then((result) => {
  if (result.isConfirmed){
    $.ajax({
    url:"../ajax/productos.php?op=get_codigo_barra",
    method:"POST",
    data:{tipo_lente:tipo_lente},
    cache: false,
    dataType:"json",
      success:function(data){
        let codigo = data.codigolente;
        $("#codigo_lente_term").val(data.codigolente);
        $("#new_barcode_lens").modal('hide');
        $("#categoria_codigo").val('Interno');        
    }      
  });
  }
})
 
}

 //////////////// AUTOCOMPLETADO CAMPOS NUEVO LENTE //////////////////
 var marcas_lente = ["Essilor","Divel"];
 autocomplete(document.getElementById("marca_lente"), marcas_lente); 
 let disenos_lente = [];
 function autocomplete_marcas(){
  var marcas_l = document.getElementById("marca_lente").value;
  if (marcas_l=="Essilor") {
    disenos_lente = ["Blue Capture","Transition","Transition 1.67","AR Green"];
  }else if (marcas_l=="Divel"){
    disenos_lente = ["Photocrom","Bifocal Blanco","Bifocal Photocrom","Index 1.67"];
  }

  autocomplete(document.getElementById("dis_lente"), disenos_lente); 
 }

 function valida_diseno(){
  var marcas_l = document.getElementById("marca_lente").value;
  if(marcas_l==""){
    $("#dis_lente").val("");
  }
 }

function read_barcode(){
  let codigo = $("#codigob_lente").val();
  if (codigo=='041820069754') {
    $("#marca_lente").val('Cremora');

  }
}

$(document).on('click', '.item_ingreso', function(){
  let id_item = $(this).attr("id");
  console.log(id_item);
  //////////////// agregar hover a celda /////////////  
  $("#vs_ar_green_essilor").modal("show");
  $.ajax({
    url:"../ajax/productos.php?op=get_data_item_ingreso",
    method:"POST",
    data:{id_item:id_item},
    cache: false,
    dataType:"json",
    success:function(data){
      console.log(data);
      $("#marca_lente").val(data.marca);
      $("#dis_lente").val(data.diseno);
      $("#esfera_terminado").val(data.esfera);
      $("#cilindro_terminado").val(data.cilindro);
      $("#id_lente_term").val(data.id_terminado);
      $("#codigo_lente_term").val(data.codigo);
      $("#stock_act").val(data.stock);
      $("#cant_ingreso").val('');
    }      
  });//Fin Ajax
   
});

function focus_input(){
    $('#codebar_lente').val("");
    $('#new_barcode_lens').on('shown.bs.modal', function() {
    $('#codebar_lente').focus();
  });
}

function setStockTerminados(){
  let id_terminado = $("#id_lente_term").val();
  let stock_act = $("#stock_act").val();
  let cantidad_ingreso = $("#cant_ingreso").val();
  let codigo_term = $("#codigo_lente_term").val();
  let new_stock = parseInt(stock_act)+parseInt(cantidad_ingreso);

  if (codigo_term=="" || codigo_term==null || codigo_term==undefined) {
    $("#new_barcode_lens").modal('show');
    $("#id_terminado_lense").val(id_terminado);
    $("#codebar_lente").val("");

    $('#new_barcode_lens').on('shown.bs.modal', function() {
      $('#codebar_lente').focus();
    });
    return false;
  }
  if(cantidad_ingreso=="") {
    alerts_productos("error", "Debe Especificar la cantidad a ingresar");
    return false; 
  }
  $.ajax({
    url:"../ajax/productos.php?op=update_stock_terminados",
    method:"POST",
    data:{id_terminado:id_terminado,new_stock:new_stock},
    cache: false,
    dataType:"json",
    success:function(data){
      if (data=="ok"){
        document.getElementById(id_terminado).style.background='#5bc0de';
        document.getElementById(id_terminado).style.color='white';
        alerts_productos("success", "Ingreso de productos exitosos");
        $("#new_barcode_lens").modal('hide');
        $("#vs_ar_green_essilor").modal('hide');
        document.getElementById(id_terminado).innerHTML=new_stock;
      }
    }      
  });   
}

//////////////////DESCARGOS DE INVENTARIO///////////
function put_cursor_order(){
  $('#modal_descargo').on('shown.bs.modal', function() {
      $('#cod_orden_current').val("");
      $('#cod_orden_current').focus();
      $('#cod_lente_inv').val("");
      $('#cod_lente_oi').val("");
  });

  document.getElementById("data_desc_derecho").innerHTML = "";
  document.getElementById("data_desc_izq").innerHTML = "";



}

let detalle_descargos= [];
function valida_tipo_lente(ojo){

  let codigo_lente='';

  ojo == 'derecho' ? codigo_lente = $("#cod_lente_inv").val() : codigo_lente = $("#cod_lente_oi").val(); 

  $.ajax({
    url:"../ajax/productos.php?op=get_tipo_lente",
    method:"POST",
    data : {codigo_lente:codigo_lente},
    cache:false,
    dataType:"json",
    success:function(data){
    
  if(data != 'errorx'){
    if(ojo=="derecho"){
      document.getElementById("cod_lente_inv").readOnly = true;     
      $('#cod_lente_oi').val("");
      $('#cod_lente_oi').focus();
    }else{
      document.getElementById("cod_lente_oi").readOnly = true; 
    }

    let codigo = data.codigo;
    let id_lente = data.id_lente;
    let categoria = data.tipo_lente;

    if (categoria=="Terminado") {
      getInfoTerminado(codigo,ojo,categoria);
    }else if(categoria=="Base"){
      console.log("LENTE BASE");
    }
  }else{/*Fin errorx*/
    if (ojo=='izquierdo') {
      alerts_productos("error","Codigo lente no existe!!"); 
      $('#cod_lente_oi').val("");
      $('#cod_lente_oi').focus();
      var z = document.getElementById("error_sound_desc"); 
      z.play();
      return false;
    }else{
      alerts_productos("error","Codigo lente no existe!!"); 
      $('#cod_lente_inv').val("");
      $('#cod_lente_inv').focus();
      var z = document.getElementById("error_sound_desc"); 
      z.play();
      return false;
    }
  }
}
  });
}

var terminado_od_data = [];
var terminado_oi_data = [];

function getInfoTerminado(codigo,ojo){ 

  $.ajax({
   url: "../ajax/productos.php?op=get_info_terminado",
   method: "POST",
   data: {codigo:codigo},
   cache: false,
   dataType: "json",
   success:function(data){
    
    let od_data = {      
      marca:data.marca,
      diseno:data.diseno,
      esfera:data.esfera,
      cilindro:data.cilindro,
      codigo:data.codigo,
      tipo_lente:data.tipo_lente
    }
      terminado_desc_data = [];
      terminado_desc_data.push(od_data);
      table_ojo_desc(ojo);
   
  }

  });
}

function table_ojo_desc(ojo){
  tabla = '';
  ojo == 'derecho' ? tabla = 'data_desc_derecho' : tabla = 'data_desc_izq';

  $("#"+tabla).html('');
  let filas = "";
  let header = "-LENTE TERMINADO"
  for(let j=0; j<terminado_desc_data.length;j++ ){
    filas = filas+
    "<table class='table-hover table-bordered'  width='100%'>"+
      "<tr style='text-align:center;text-transform: uppercase' class='bg-primary'><td colspan='100'>OJO "+ojo+"</td></tr>"+    
      "<tr style='text-align:center' class='bg-dark'>"+
      "<td>Codigo</td>"+
      "<td>Tipo lente</td>"+
      "<td>Marca</td>"+
      "<td>Diseño</td>"+
      "</tr>"+

      "<tr style='text-align:center'>"+
      "<td>"+terminado_desc_data[j].codigo+"</td>"+
      "<td>"+terminado_desc_data[j].tipo_lente+"</td>"+
      "<td>"+terminado_desc_data[j].marca+"</td>"+
      "<td>"+terminado_desc_data[j].diseno+"</td>"+
      "</tr>"+

      "<tr style='text-align:center' class='bg-dark'>"+
      "<td>Esfera</td>"+
      "<td>Cilindro</td>"+
      "<td>Stock Act.</td>"+
      "<td>Eliminar</td>"+
      "</tr>"+

      "<tr style='text-align:center'>"+
      "<td>"+terminado_desc_data[j].esfera+"</td>"+
      "<td>"+terminado_desc_data[j].cilindro+"</td>"+
      "<td>0</td>"+
      "<td><i class='fas fa-trash' style='color: red'></i></td>"+
      "</tr>"+
    "</table>";
  }
  //$("#"+title_tabla).html(header);
  //document.getElementById(title_tabla).style.background ="#112438";
  $("#"+tabla).html(filas);
  
}


function delete_item_od(){
  $("#cod_lente_inv").val("");
  document.getElementById("cod_lente_inv").focus();
  terminado_od_data = [];
  table_od();
}

function delete_item_oi(){
  $("#cod_lente_oi").val("");
  document.getElementById("cod_lente_oi").focus();
  terminado_oi_data = [];
  table_oi();
}

function registrarDescargo(){

  let codigo_orden = $("#cod_orden_current").val();
  let codebar = $("#cod_orden_current").val();
  let terminado_od = terminado_od_data;
  let terminado_oi = terminado_oi_data;

  if(terminado_od == undefined || terminado_od==null || terminado_od==0) {
    alerts_productos("error","OD campo obligatorio");
  }else{
    let long_od = terminado_od_data.length;
    if (long_od==0) {
      alerts_productos("error","OD campo obligatorio");
    }
  } 
  
  $.ajax({
  url:"../ajax/productos.php?op=registrarDescargo",
  method:"POST",
  data : {'ojoDerechoArray':JSON.stringify(terminado_od_data),'ojoIzquierdoArray':JSON.stringify(terminado_od_data)},
  cache:false,
  dataType:"json",
  success:function(data){
    console.log(data)      
  }
}); 
  
}

init();