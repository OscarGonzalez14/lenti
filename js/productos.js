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
        timer: 2500
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


 function create_barcode_interno(){ 
  Swal.fire({
  title: 'Código interno?',
  text: "Desea generar un codigo Interno",
  icon: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'No',
  confirmButtonText: 'Si!'
}).then((result) => {
  if (result.isConfirmed) {
   $("#codigob_lente").val('12785')
  }
})
 
}

//////////////////////////AUTOCOMPLETADO DE CAMPOS ////////////////

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

$(document).on('click', '.id_lente', function(){
  let id_item = $(this).attr("id");
  console.log(id_item); //return false;

  ////////////////agregar hover a celda /////////////
  
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
    }      
  });//Fin Ajax
   
});

function set_code_bar(){

  let new_code = $("#codebar_lente").val();
  let id_terminado_term = $("#id_terminado_lense").val();

  if(new_code!=""){
    $.ajax({
    url:"../ajax/productos.php?op=set_code_bar_ini",
    method:"POST",
    data:{new_code:new_code,id_terminado_term:id_terminado_term},
    cache: false,
    dataType:"json",
    success:function(data){
      if (data=="exito") {
        $("#new_barcode_lens").modal('hide');
        $("#codigo_lente_term").val(new_code);
      }else{
        alerts_productos("error", "Este código ya existe!");
        setTimeout ("focus_input();", 2000);
    return false;
   }      
  }
  });//Fin Ajax 

  }else{
    alerts_productos("error", "Debe escanear o crear un codigo de barras para inicializar stock de producto");
    $('#new_barcode_lens').on('shown.bs.modal', function() {
        $('#codebar_lente').focus();
    });
    return false;
    }
  
}

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
      $('#cod_orden_current').focus();
  });
}

let detalle_descargos= [];
function valida_tipo_lente(ojo){
  console.log(det_orden);
  let codigo_lente=''
  if(ojo=="derecho"){
    codigo_lente = $("#cod_lente_inv").val();
  }else if(ojo=="izquierdo"){
    codigo_lente = $("#cod_lente_oi").val();
  }  

  $.ajax({
    url:"../ajax/productos.php?op=get_tipo_lente",
    method:"POST",
    data : {codigo_lente:codigo_lente},
    cache:false,
    dataType:"json",
    success:function(data){
      
    let codigo = data.codigo;
    let id_lente = data.id_lente;
    let categoria = data.tipo_lente;

    if (categoria=="Terminado") {
      getInfoTerminado(codigo,id_lente,ojo,categoria);
    }else if(categoria=="Base")
        console.log("LENTE BASE");
    }
  });
}

var terminado_od_data = [];
var terminado_oi_data = [];
function getInfoTerminado(codigo,id_lente,ojo,categoria){  
  terminado_od_data = [];
  terminado_oi_data = [];
  $.ajax({
   url: "../ajax/productos.php?op=get_info_terminado",
   method: "POST",
   data: {codigo:codigo,id_lente:id_lente},
   cache: false,
   dataType: "json",
   success:function(data){
    let od_data = {
      id_lente: id_lente,
      lente:data.lente,
      marca:data.marca,
      diseno:data.diseno,
      esfera:data.esfera,
      cilindro:data.cilindro,
      codigo:data.codigo
    }
    if(ojo=='derecho'){
      terminado_od_data.push(od_data);
      table_od();
    }else if(ojo=='izquierdo'){
      terminado_oi_data.push(od_data);
      table_oi(); 
    }
  }

  });
}

function table_od(){
  $("#od_term_info").html('');
  let filas = "";
  let header = "OJO DERECHO - LENTE TERMINADO"

  for(let j=0; j<terminado_od_data.length;j++ ){
    filas = filas+    
    "<tr style='text-align:center'>"+
    "<td>"+terminado_od_data[j].lente+"</td>"+
    "<td>"+terminado_od_data[j].marca+"</td>"+
    "<td>"+terminado_od_data[j].diseno+"</td>"+
    "</tr>"+
    "<tr style='text-align:center'>"+
    "<td>Esfera: "+terminado_od_data[j].esfera+"</td>"+
    "<td>Cilindro: "+terminado_od_data[j].cilindro+"</td>"+
    "<td>"+"<i class='fas fa-trash' style='color:red'></i>"+"</td>"+
    "</tr>";
  }
  $("#encabezado_od").html(header);
  document.getElementById("encabezado_od").style.background ="#112438";
  $("#od_term_info").html(filas);
  
}

function table_oi(){
  $("#oi_term_info").html('');
  let filas_oi = "";
  let header_oi = "OJO IZQUIERDO - LENTE TERMINADO"

  for(let j=0; j<terminado_oi_data.length;j++ ){
    filas_oi = filas_oi+    
    "<tr style='text-align:center'>"+
    "<td>"+terminado_oi_data[j].lente+"</td>"+
    "<td>"+terminado_oi_data[j].marca+"</td>"+
    "<td>"+terminado_oi_data[j].diseno+"</td>"+
    "</tr>"+
    "<tr style='text-align:center'>"+
    "<td>Esfera: "+terminado_oi_data[j].esfera+"</td>"+
    "<td>Cilindro: "+terminado_oi_data[j].cilindro+"</td>"+
    "<td>"+"<i class='fas fa-trash' style='color:red'></i>"+"</td>"+
    "</tr>";
  }
  $("#encabezado_oi").html(header_oi);
  document.getElementById("encabezado_oi").style.background ="#0275d8";
  $("#oi_term_info").html(filas_oi);
  
}


init();