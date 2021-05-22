function init(){
 listar_ordenes();
 get_numero_orden();
 document.getElementById("btn-print-bc").style.display = "none";
}


function ocultar_btn_print_rec_ini(){
  document.getElementById("btn_print_recibos").style.display = "none";
}

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

function guardar_orden(){

  let codigo = $('#codigoOrden').val();
   let paciente = $("#paciente_orden").val();
  let optica = $("#optica_orden").val();
  let observaciones = $("#observaciones_orden").val();
  let id_usuario = $("#id_usuario").val();
  let lentevs = $("#lentevs").val();
  let lentebf = $("#lentebf").val();
  let lentemulti = $("#lentemulti").val();

  ////GRADUACIONES///////
  let odesferasf_orden = $("#odesferasf_orden").val();
  let odcilindrosf_orden = $("#odcilindrosf_orden").val();
  let odejesf_orden = $("#odejesf_orden").val();
  let oddicionf_orden = $("#oddicionf_orden").val();
  let odprismaf_orden = $("#odprismaf_orden").val();
  let oiesferasf_orden = $("#oiesferasf_orden").val();
  let oicolindrosf_orden = $("#oicolindrosf_orden").val();
  let oiejesf_orden = $("#oiejesf_orden").val();
  let oiadicionf_orden = $("#oiadicionf_orden").val();
  let oiprismaf_orden = $("#oiprismaf_orden").val();


  let bf_check = $("#lentebf").is(":checked");
  let multi_check = $("#lentemulti").is(":checked");

  if((bf_check == true || multi_check == true) &&  (oddicionf_orden=="" || oiadicionf_orden=="")){
        Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Adicion incompleta',
        showConfirmButton: true,
        timer: 2500
      });
    return false;    
  }
  
  $.ajax({
    url:"../ajax/ordenes.php?op=registrar_orden",
    method:"POST",
    data:{codigo:codigo,paciente:paciente,optica:optica,observaciones:observaciones,id_usuario:id_usuario},
    cache: false,
    dataType:"json",
   /* error:function(){
      Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Orden Registrada Exitosamente',
        showConfirmButton: true,
        timer: 2500
      })
    document.getElementById("btn-print-bc").style.display = "block";
    //document.getElementById("btn_print_recibos").style.display = "none";

    },  */   
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
      document.getElementById("btn-print-bc").style.display = "block";
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

 function get_numero_orden(){

  $.ajax({
      url:"../ajax/ordenes.php?op=get_correlativo_orden",
      method:"POST",
      cache:false,
      dataType:"json",
      success:function(data){
       console.log(data)   
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



init();