function init(){
 listar_ordenes();
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

//window.onkeydown= space_guardar_orden;
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
  let trat_multifocal = '';
  let trat_mult = $("input[type='radio'][name='tratamiento_multifocal']:checked").val();
  if(trat_mult!=undefined || trat_mult!=null){

    trat_multifocal = trat_mult;
  }else{
      trat_multifocal = '';
  }

  $.ajax({
    url:"../ajax/ordenes.php?op=registrar_orden",
    method:"POST",
    data:{'paciente':paciente,'observaciones':observaciones,'usuario':usuario,'id_sucursal':id_sucursal,
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
     if (data !='error') {
     let codigo = data;
      Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Orden creada exitosamente',
        showConfirmButton: true,
        timer: 2500
      });
      //////  GENERAR CODIGO DE BARRAS ///////
      $("#nueva_orden_lab").modal('hide');
      $("#datatable_ordenes").DataTable().ajax.reload();
      generate_barcode_print(codigo,paciente,id_sucursal,id_optica);    

     }else{
      Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Orden ya ha sido digitada',
        showConfirmButton: true,
        timer: 2500
      })
     }     
    }
  });//////FIN AJAX

}

function validar_est_orden(){
  alerts("error", "La orden debe ser recibida")
}


function generate_barcode_print(codigo,paciente,id_sucursal,id_optica){

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

      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "id_optica";
      input.value = id_optica;
      form.appendChild(input);

      var input = document.createElement("input");
      input.type = "hidden";
      input.name = "id_sucursal";
      input.value = id_sucursal;
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
var det_orden = []
function get_dets_orden(){
  let cod_orden_act = $("#cod_orden_current").val();
    /////////GET DATA ORDEN /////////////
    $.ajax({
      url:"../ajax/ordenes.php?op=get_data_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){

      $("#cod_det_orden_descargo").html(data.codigo);
      $("#pac_orden_desc").html(data.paciente);
      $("#optica_orden_suc").html(data.optica);
      $("#sucursal_optica_orden").html(data.sucursal);
      $("#tipo_lente_ord").html(data.tipo_lente);
      $("#trat_multi_orden").html(data.trat_orden);
      $("#obs_orden").val(data.observaciones);

      let items_orden = {
      codigo : data.codigo,
      paciente :data.paciente,
      id_optica: data.id_optica,
      id_sucursal: data.id_sucursal
      } 
      det_orden.push(items_orden);
       
      }
    });

  /////////////////GET DATA RX FINAL   

  $.ajax({
      url:"../ajax/ordenes.php?op=get_rxfinal_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
       $("#esf_od").html(data.odesferas);
       $("#cil_od").html(data.odcindros);
       $("#eje_od").html(data.odeje);
       $("#adi_od").html(data.odadicion);
       $("#pri_od").html(data.odprisma);

       $("#esf_oi").html(data.oiesferas);
       $("#cil_oi").html(data.oicindros);
       $("#eje_oi").html(data.oieje);
       $("#adi_oi").html(data.oiadicion);
       $("#pri_oi").html(data.oiprisma);
       
      }
    });

  /////////// GET DATA ALTURA PUPILAR /////
   $.ajax({
      url:"../ajax/ordenes.php?op=get_altdist_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
       $("#od_dip").html(data.od_dist_pupilar);
       $("#od_ap").html(data.od_altura_pupilar);
       $("#od_ao").html(data.od_altura_oblea);
       $("#oi_dip").html(data.oi_dist_pupilar);
       $("#oi_ap").html(data.oi_altura_pupilar);
       $("#oi_ao").html(data.oi_altura_oblea);
       
      }
    });
  /////////////////////  GET DATA AROS ORDEN ////
     $.ajax({
      url:"../ajax/ordenes.php?op=get_aros_orden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
      $("#mod_aro_orden").html(data.modelo);
       $("#marca_aro_orden").html(data.marca);
       $("#color_aro_orden").html(data.color);
       $("#dis_aro_orden").html(data.diseno);
       $("#hor_aro_orden").html(data.horizontal);
       $("#diagonal_aro_orden").html(data.diagonal);
       $("#vertical_aro_orden").html(data.vertical);
       $("#puente_aro_orden").html(data.puente);
         
      }
    });



}

function detOrdenes(cod_orden_act){

  $("#detalle_orden").modal('show');
  $.ajax({
      url:"../ajax/ordenes.php?op=get_data_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){

      $("#cod_det_orden_descargo").html(data.codigo);
      $("#pac_orden_desc").html(data.paciente);
      $("#optica_orden_suc").html(data.optica);
      $("#sucursal_optica_orden").html(data.sucursal);
      $("#tipo_lente_ord").html(data.tipo_lente);
      $("#trat_multi_orden").html(data.trat_orden);
      $("#obs_orden").val(data.observaciones);

      let items_orden = {
      codigo : data.codigo,
      paciente :data.paciente,
      id_optica: data.id_optica,
      id_sucursal: data.id_sucursal
      } 
      det_orden.push(items_orden);
       
      }
    });

  /////////////////GET DATA RX FINAL   

  $.ajax({
      url:"../ajax/ordenes.php?op=get_rxfinal_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
       $("#esf_od").html(data.odesferas);
       $("#cil_od").html(data.odcindros);
       $("#eje_od").html(data.odeje);
       $("#adi_od").html(data.odadicion);
       $("#pri_od").html(data.odprisma);

       $("#esf_oi").html(data.oiesferas);
       $("#cil_oi").html(data.oicindros);
       $("#eje_oi").html(data.oieje);
       $("#adi_oi").html(data.oiadicion);
       $("#pri_oi").html(data.oiprisma);
       
      }
    });

  /////////// GET DATA ALTURA PUPILAR /////
   $.ajax({
      url:"../ajax/ordenes.php?op=get_altdist_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
       $("#od_dip").html(data.od_dist_pupilar);
       $("#od_ap").html(data.od_altura_pupilar);
       $("#od_ao").html(data.od_altura_oblea);
       $("#oi_dip").html(data.oi_dist_pupilar);
       $("#oi_ap").html(data.oi_altura_pupilar);
       $("#oi_ao").html(data.oi_altura_oblea);
       
      }
    });
  /////////////////////  GET DATA AROS ORDEN ////
     $.ajax({
      url:"../ajax/ordenes.php?op=get_aros_orden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
      $("#mod_aro_orden").html(data.modelo);
       $("#marca_aro_orden").html(data.marca);
       $("#color_aro_orden").html(data.color);
       $("#dis_aro_orden").html(data.diseno);
       $("#hor_aro_orden").html(data.horizontal);
       $("#diagonal_aro_orden").html(data.diagonal);
       $("#vertical_aro_orden").html(data.vertical);
       $("#puente_aro_orden").html(data.puente);
         
      }
    });
}
init();