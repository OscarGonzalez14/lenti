
function registrar_ingreso_tallado(){
    
	let cod_orden_act = $("#reg_intreso_tallado").val();	
	$.ajax({
      url:"../ajax/ordenes.php?op=get_data_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){       
      console.log(data)
      
      input_focus_clear();

      //;            
    }
    });
}

function input_focus_clear(){
	$("#reg_intreso_tallado").val("");
	$('#ing_tallado').on('shown.bs.modal', function() {
        $('#reg_intreso_tallado').focus();
    });
}