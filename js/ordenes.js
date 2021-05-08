function init(){
 //status_checks_tratamientos():
 get_numero_orden();
 document.getElementById("btn-print-bc").style.display = "none";
}


function ocultar_btn_print_rec_ini(){
  document.getElementById("btn_print_recibos").style.display = "none";
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
  }s

}

//////////EJECUTAR ORDEN GUARDAR SPACE KEY ////

function space_guardar_orden(event){
  tecla = event.keyCode; 
    if(tecla==13)
    {
     create_barcode();
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

init();