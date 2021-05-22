function init(){
 document.getElementById("terminado_section").style.display = "none";
 document.getElementById("base_section").style.display = "none";
 document.getElementById("semiterminado_section").style.display = "none";
}

function valida_base_term(){
	let vs_term_check = $("#vs_term").is(":checked");
	let vs_semi_term_chk = $("#vs_semi_term").is(":checked");
	let bifo_flap_chk = $("#bifo_flap").is(":checked");

    
    if (vs_term_check) {
    	document.getElementById("terminado_section").style.display = "block";
    	document.getElementById("base_section").style.display = "none";
      document.getElementById("semiterminado_section").style.display = "none";
    }else if(bifo_flap_chk ){
    	document.getElementById("base_section").style.display = "block";
    	document.getElementById("terminado_section").style.display = "none";
      document.getElementById("semiterminado_section").style.display = "none";

    }else if(vs_semi_term_chk){
      document.getElementById("semiterminado_section").style.display = "block";
      document.getElementById("terminado_section").style.display = "none";
      document.getElementById("base_section").style.display = "none";
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
    disenos_lente = ["Blue Capture","Transition","Transition 1.67"];
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

function proof(){
  let codigo = $("#base_flap").val();
  if (codigo=='088169004688') {
    $("#add_flap").val('Es cafe musun');

  }else{
    $("#add_flap").val('Producto No identificado');
  }
}

init();