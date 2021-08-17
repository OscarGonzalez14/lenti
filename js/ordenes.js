function init(){
 listar_ordenes();
 get_numero_orden();
 //document.getElementById("btn-print-bc").style.display = "none";
}

function alerts(icono, titulo){
  Swal.fire({
        position: 'top-center',
        icon: icono,
        title: titulo,
        showConfirmButton: true,
        timer: 2500
      });
}


function ocultar_btn_print_rec_ini(){
  //document.getElementById("btn_print_recibos").style.display = "none";
}

/////////////// SELECCIONAR SUCURSAL //////////
$(document).ready(function(){
  $("#optica_orden").change(function () {         
    $("#optica_orden option:selected").each(function () {
     let optica = $(this).val();
        $.post('../ajax/ordenes.php?op=sucursales_optica',{optica:optica}, function(data){
        $("#optica_sucursal").html(data);
      });            
    });
  })
});

/////////validar ingreso de adicion////////////
function valida_adicion(){
  let vs_check = $("#lentevs").is(":checked");
  if(vs_check == true){
    document.getElementById('oddicionf_orden').readOnly = true;
    document.getElementById('oiadicionf_orden').readOnly = true;
    document.getElementById('oddicionf_orden').value = "";
    document.getElementById('oiadicionf_orden').value = "";
  }else{
    document.getElementById('oddicionf_orden').readOnly = false;
    document.getElementById('oiadicionf_orden').readOnly = false;
  }

  let lentebf_chk = $("#lentebf").is(":checked");

  if (lentebf_chk==true) {
    document.getElementById('ap_od').readOnly = true;
    document.getElementById('ap_oi').readOnly = true;
  }else{
    document.getElementById('ap_od').readOnly = false;
    document.getElementById('ap_oi').readOnly = false;
  }

  let lentemulti_chk = $("#lentemulti").is(":checked");

  if (lentemulti_chk==true) {
    document.getElementById('ao_od').readOnly = true;
    document.getElementById('ao_oi').readOnly = true;
  }else{
    document.getElementById('ao_od').readOnly = false;
    document.getElementById('ao_oi').readOnly = false;
  }
}

function status_checks_tratamientos(){

  let photocrom_check = $('#photocromphoto').is(":checked");

  if (photocrom_check) {

    $("#transitionphoto").attr("disabled", true);    
    $('#lbl_arsh').css('color', 'green');

    $("#arbluecap").attr("disabled", true);
    $('#arbluecap').prop('checked', false)
    $('#lbl_arbluecap').css('color', '#989898');

    $("#arnouv").attr("disabled", true);
    $('#arnouv').prop('checked', false)
    $('#lbl_arnouv').css('color', '#989898');

    $("#blanco").attr("disabled", true);
    $('#blanco').prop('checked', false)
    $('#lbl_blanco').css('color', '#989898');

    $("#transitionphoto").attr("disabled", true);
    $('#transitionphoto').prop('checked', false)
    $('#lbl_transitionphoto').css('color', '#989898');
    
  }else{  	
    $("#transitionphoto").removeAttr("disabled");
  }

}

//////////EJECUTAR ORDEN GUARDAR SPACE KEY ////
function space_guardar_orden(event){
  tecla = event.keyCode; 
    if(tecla==13)
    {
     create_barcode_interno();
    }
}

function create_barcode(){  

  let codigo = $('#codigoOrden').val();

  $.ajax({
    url:"../ajax/ordenes.php?op=crear_barcode",
    method:"POST",
    data:{codigo:codigo},
    cache: false,
    dataType:"json",
    error:function(data){
      setTimeout("guardar_orden();",1500);  
    },
    success:function(data){
      console.log(data)
    }
  });///fin ajax
}

window.onkeydown= space_guardar_orden;
/***********************************************************
/////////////////////  GUARDAR ORDEN ///////////////////////
/***********************************************************/
var tratamientos = [];
$(document).on('click', '.items_tratamientos', function(){
  let tratamiento = $(this).attr("value");
  let obj ={
    tratamientos : tratamiento
  }
  tratamientos.push(obj);
});

function guardar_orden(){
  // orden data general
  let codigo = $('#codigoOrden').val();
  let paciente = $("#paciente_orden").val();
  let observaciones = $("#observaciones_orden").val();
  let usuario = $("#id_usuario").val();
  let id_sucursal = $("#optica_sucursal").val();
  let id_optica = $("#optica_orden").val();
  let tipo_orden = "Laboratorio";
  let lentevs = $("#lentevs").val();
  let lentebf = $("#lentebf").val();
  let lentemulti = $("#lentemulti").val();
  // rx_orden
  let odesferasf_orden = $("#odesferasf_orden").val();
  let odcilindrosf_orden = $("#odcilindrosf_orden").val();
  let odejesf_orden = $("#odejesf_orden").val();
  let oddicionf_orden = $("#oddicionf_orden").val();
  let odprismaf_orden = $("#odprismaf_orden").val();
  let oiesferasf_orden = $("#oiesferasf_orden").val();
  let oicilindrosf_orden = $("#oicolindrosf_orden").val();
  let oiejesf_orden = $("#oiejesf_orden").val();
  let oiadicionf_orden = $("#oiadicionf_orden").val();
  let oiprismaf_orden = $("#oiprismaf_orden").val();
  // aro  
  let modelo = $("#modelo_aro_orden").val();
  let marca = $("#marca_aro_orden").val();
  let color = $("#color_aro_orden").val();
  let diseno = $("#diseno_aro_orden").val();
  let horizontal = $("#med_a").val();
  let diagonal = $("#med_b").val();
  let vertical = $("#med_c").val();
  let puente = $("#med_d").val();
  // alturas orden 
  let od_dist_pupilar = $("#dip_od").val();
  let od_altura_pupilar = $("#ap_od").val();
  let od_altura_oblea = $("#ao_od").val();
  let oi_dist_pupilar = $("#dip_oi").val();
  let oi_altura_pupilar = $("#ap_oi").val();
  let oi_altura_oblea = $("#ao_oi").val();

  let tipo_lente = $("input[type='radio'][name='tipo_lente']:checked").val();  
  if (tipo_lente==undefined || tipo_lente==null) {
    alerts('error','Debe seleccionar Lente');return false;
  }
   let trat_multifocal = $("input[type='radio'][name='tratamiento_multifocal']:checked").val();


  $.ajax({
    url:"../ajax/ordenes.php?op=registrar_orden",
    method:"POST",
    data:{'codigo':codigo,'paciente':paciente,'observaciones':observaciones,'usuario':usuario,'id_sucursal':id_sucursal,
    'id_optica':id_optica,'tipo_orden':tipo_orden,'tipo_lente':tipo_lente,
    'odesferasf_orden':odesferasf_orden,'odcilindrosf_orden':odcilindrosf_orden,'odejesf_orden':odejesf_orden,'oddicionf_orden':oddicionf_orden,
    'odprismaf_orden':odprismaf_orden,'oiesferasf_orden':oiesferasf_orden,'oicilindrosf_orden':oicilindrosf_orden,'oiejesf_orden':oiejesf_orden,
    'oiadicionf_orden':oiadicionf_orden,'oiprismaf_orden':oiprismaf_orden,
    'modelo':modelo,'marca':marca,'color':color,'diseno':diseno,'horizontal':horizontal,'diagonal':diagonal,'vertical':vertical,'puente':puente,
    'od_dist_pupilar':od_dist_pupilar,'od_altura_pupilar':od_altura_pupilar,'od_altura_oblea':od_altura_oblea,'oi_dist_pupilar':oi_dist_pupilar,
    'oi_altura_pupilar':oi_altura_pupilar,'oi_altura_oblea':oi_altura_oblea,'trat_multifocal':trat_multifocal},
    cache: false,
    dataType:"json",
      error:function(x,y,z){
      console.log(x);
      console.log(y);
      console.log(z);
    },
         
    success:function(data){
    console.log(data)
     if (data=='exito') {
      Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Codigo Registrado',
        showConfirmButton: true,
        timer: 2500
      });
      //////  GENERAR CODIGO DE BARRAS ///////
      $("#nueva_orden_lab").modal('hide');
      generate_barcode_print(codigo,paciente);    

     }else{
      Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Codigo ya existe',
        showConfirmButton: true,
        timer: 2500
      })
     }     
    }
  });//////FIN AJAX

}

function generate_barcode_print(codigo,paciente){

var form = document.createElement("form");
      form.target = "print_popup";
      form.method = "POST";
      form.action = "barcode_orden_print.php";
      var input = document.createElement("input");
        input.type = "hidden";
        input.name = "paciente";
        input.value = paciente;
        form.appendChild(input);

      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "codigo";
      input.value = codigo;
      form.appendChild(input);

      let alto = (parseInt(window.innerHeight) / 4);
      let ancho = (parseInt(window.innerWidth) / 4);
      let x = parseInt((screen.width - ancho) / 2);
      let y = parseInt((screen.height - alto) / 2);

    document.body.appendChild(form);//"width=600,height=500"
    window.open("about:blank","print_popup",`
            width=${ancho}
            height=${alto}
            top=${y}
            left=${x}`);
    form.submit();
    document.body.removeChild(form);

}


 function get_numero_orden(){

  $.ajax({
      url:"../ajax/ordenes.php?op=get_correlativo_orden",
      method:"POST",
      cache:false,
      dataType:"json",
      success:function(data){
       $("#codigoOrden").val(data.codigo_orden);
       $("#correlativo_op").html(data.codigo_orden);      
      }
    });
 }

 function listar_ordenes(){
  $("#datatable_ordenes").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //dom: 'Bfrti',
      //"buttons": [ "excel"],
      "searching": false,
      "ajax":
        {
          url: '../ajax/ordenes.php?op=get_ordenes',
          type : "post",
          dataType : "json",        
          error: function(e){
            console.log(e.responseText);  
          }
        },
    "language": {
      "sSearch": "Buscar:"
    }
    }).buttons().container().appendTo('#datatable_ordenes_wrapper .col-md-6:eq(0)');

 }
///////////////LIMPIAR CAMPOS NUEVA ORDEN LAB//////////
$(document).on('click', '#new_order', function(){
    let element = document.getElementsByClassName("clear_orden_i");
    for(i=0;i<element.length;i++){
      let id_element = element[i].id;
      document.getElementById(id_element).value="";
   }
/////////////////////////////UNCHECKED RADIO //////////
   let check_box = document.getElementsByClassName("checkit");
   for(i=0;i<check_box.length;i++){
    let id_check = check_box[i].id;
    document.getElementById(id_check).checked = false;
   }
});

////////////////ocultar input OTROS TRATAMIENTOS
$(document).on('click', '.new_order_class', function(){
  document.getElementById("otros_trat").style.display = "none";
});

function chk_otros_tratamientos(){
 var isChecked = document.getElementById('chk_trat').checked;
 if (isChecked) {
  document.getElementById("otros_trat").style.display = "block";
  document.getElementById("tratamientos_section").style.display = "none";
  }else{
    document.getElementById("otros_trat").style.display = "none";
    document.getElementById("tratamientos_section").style.display = "flex";
  }
}

$(document).on('click', '.ident', function(){
  let id_item = $(this).attr("id");
  alert(id_item)
});


init();