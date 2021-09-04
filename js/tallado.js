
$(document).on('click', '#ingresos_t', function(){ 
  items_tallado = [];
  show_items();
});

function alerts_tallado(icono, titulo){
    Swal.fire({
        position: 'top-center',
        icon: icono,
        title: titulo,
        showConfirmButton: true,
        timer: 2500
    });
}

var items_tallado = [];
function registrar_ingreso_tallado(){    
	let cod_orden_act = $("#reg_intreso_tallado").val();	
	$.ajax({
      url:"../ajax/ordenes.php?op=get_data_oden",
      method:"POST",
      data : {cod_orden_act:cod_orden_act},
      cache:false,
      dataType:"json",
      success:function(data){
      if(data !="error"){
        let codigo = data.codigo; 
        let indice = items_tallado.findIndex((objeto, indice, items_tallado) =>{
        return objeto.n_orden == codigo;
        });
        console.log(indice);
        if(indice>=0){
            var y = document.getElementById("error_sound"); 
            y.play();
            //alerts_tallado("error","Ya existe orden en la lista");
            input_focus_clear();
      	}else{
      		var x = document.getElementById("success_sound"); 
            x.play();
        	let items_ingresos = {
      		n_orden : data.codigo,
      		paciente: data.paciente,
      		optica: data.optica
            }
            items_tallado.push(items_ingresos);
            show_items();       
            input_focus_clear();  
        }          
        }else{
        	var z = document.getElementById("error_sond"); 
            z.play();
            alerts_tallado("error","Orden No existe");
            input_focus_clear();
        }
    }
    });
}

function input_focus_clear(){
	$("#reg_intreso_tallado").val("");
	$('#ing_tallado').on('shown.bs.modal', function() {
    $('#reg_intreso_tallado').focus();
    });
    //

}

function show_items(){

  $("#items_orden_tallado_ingresos").html('');

  let filas = "";
  for(let i=0;i<items_tallado.length;i++){
  	filas = filas +    
    "<tr style='text-align:center' id='item_t"+i+"'>"+
    "<td>"+(i+1)+"</td>"+
    "<td>"+items_tallado[i].n_orden+"</td>"+
    "<td>"+items_tallado[i].paciente+"</td>"+
    "<td>"+items_tallado[i].optica+"</td>"+
    "<td>"+"<button type='button'  class='btn btn-sm bg-light' onClick='detOrdenes("+items_tallado[i].n_orden+")'><i class='fa fa-eye' aria-hidden='true' style='color:blue'></i></button>"+"</td>"+
    "<td>"+"<button type='button'  class='btn btn-sm bg-light' onClick='eliminarItemTallado("+i+")'><i class='fa fa-times-circle' aria-hidden='true' style='color:red'></i></button>"+"</td>"+
    "</tr>";
  }

  $("#items_orden_tallado_ingresos").html(filas);
}

function eliminarItemTallado(index) {
  $("#item_t" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  items_tallado.splice(position_element, 1);
}