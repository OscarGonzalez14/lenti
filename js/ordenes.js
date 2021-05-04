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

  console.log('Save Orden')
  let codigo = $('#codigo').val();
 // var nom_user =$("#nom_user").val();
  console.log(codigo);

   $.ajax({
    url:"../ajax/ordenes.php?op=registrar_orden",
    method:"POST",
    data:{codigo:codigo},
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
      }
    });
 }


init();