function init(){
 //document.getElementById("terminado_section").style.display = "none";
 //document.getElementById("base_section").style.display = "none";
 //document.getElementById("semiterminado_section").style.display = "none";
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
    }      
  });//Fin Ajax  
});

function setStockTerminados(){
  let id_terminado = $("#id_lente_term").val();
  let cantidad_ingreso = $("#cant_ingreso").val();
  $.ajax({
    url:"../ajax/productos.php?op=update_stock_terminados",
    method:"POST",
    data:{id_terminado:id_terminado,cantidad_ingreso:cantidad_ingreso},
    cache: false,
    dataType:"json",
    success:function(data){
    
    }      
  });   
}

init();