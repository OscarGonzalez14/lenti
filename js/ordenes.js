function init(){
 //status_checks_tratamientos():
 get_numero_orden();
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

function guardar_orden(){

  let codigo = $('#codigoOrden').val();
   let paciente = $("#paciente_orden").val();
  let optica = $("#optica_orden").val();
  let observaciones = $("#observaciones_orden").val();
  let id_usuario = $("#id_usuario").val();
  //document.getElementById("btn_print_recibo").href='imprimir_recibo_pdf.php?n_recibo='+n_recibo
  console.log(`paciente ${paciente} optica ${optica} observaciones ${observaciones} id_usuario ${id_usuario}`)

  $.ajax({
    url:"../ajax/ordenes.php?op=registrar_orden",
    method:"POST",
    data:{codigo:codigo,paciente:paciente,optica:optica,observaciones:observaciones,id_usuario:id_usuario},
    cache: false,
    dataType:"json",
    error:function(x,y,z){
      d_pacole.log(x);
      console.log(y);
      console.log(z);
    },     
    success:function(data){
    
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