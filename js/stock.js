document.addEventListener('keydown',handleInputFocusTransfer);
function handleInputFocusTransfer(e){
  const focusableInputElements= document.querySelectorAll('.cant_ingreso');  
  const focusable= [...focusableInputElements]; 
  const index = focusable.indexOf(document.activeElement);
  let nextIndex = 0;
  if (e.keyCode === 38) {
    e.preventDefault();
    nextIndex= index > 0 ? index-1 : 0;
    focusableInputElements[nextIndex-1].focus();
    focusableInputElements[nextIndex-1].select();  

  }
  else if (e.keyCode === 40) {
    e.preventDefault();
    nextIndex= index+1 < focusable.length ? index+1 : index;
    focusableInputElements[nextIndex+1].focus();
    let ids = focusableInputElements[nextIndex+1].select();
  }else if(e.keyCode === 37){
    e.preventDefault();
    nextIndex= index > 0 ? index-1 : 0;
    focusableInputElements[nextIndex].focus();
    let ids = focusableInputElements[nextIndex].select();
  }else if(e.keyCode === 39){
    e.preventDefault();
    nextIndex= index+1 < focusable.length ? index+1 : index;
    focusableInputElements[nextIndex].focus();
    let ids = focusableInputElements[nextIndex].select();
  }
}


function init(){
  $(".modal-header").on("mousedown", function(mousedownEvt) {
    let $draggable = $(this);
    let x = mousedownEvt.pageX - $draggable.offset().left,
        y = mousedownEvt.pageY - $draggable.offset().top;
    $("body").on("mousemove.draggable", function(mousemoveEvt) {
    $draggable.closest(".modal-dialog").offset({
    "left": mousemoveEvt.pageX - x,
      "top": mousemoveEvt.pageY - y
    });
    });
    $("body").one("mouseup", function() {
      $("body").off("mousemove.draggable");
    });
    $draggable.closest(".modal").one("bs.modal.hide", function() {
        $("body").off("mousemove.draggable");
    });
  });
}


function get_dataTableTerm(id_tabla,div_tabla){
	  $.ajax({
      url:"../ajax/stock.php?op=get_tableTerm",
      method:"POST",
      data : {id_tabla:id_tabla},
      cache:false,
      //dataType:"json",
      success:function(data){   
      	$("#"+div_tabla).html(data);
      }
    });

}

function getDataIngresoModal(esfera,cilindro,codigo,marca,diseno,titulo,id_td,id_tabla){
	$('#modal_ingresos_term').modal('show');
	$('#codigo_lente_term').val(codigo);
	$('#marca_lente').val(marca);
	$('#dis_lente').val(diseno);
	$('#esfera_terminado').val(esfera);
	$('#cilindro_terminado').val(cilindro);
	$('#title_modal_term').html(titulo);
	$('#id_td').val(id_td);
	$('#id_tabla').val(id_tabla);
  $('#cant_ingreso').val('0');
	if (codigo=="" || codigo==null || codigo==undefined){
		$("#new_barcode_lens").modal('show');
		$('#new_barcode_lens').on('shown.bs.modal', function() {
		$('#codebar_lente').val('');
		$('#codebar_lente').focus();
	});

   }
}

function editCode(){
  $("#new_barcode_lens").modal('show');
  $('#new_barcode_lens').on('shown.bs.modal', function() {
  $('#codebar_lente').val('');
  $('#codebar_lente').focus();
  });
}

key('⌘+space, control+space', function(){ 
  clearCode();
});

function clearCode(){
  $('#codigo_term_ingreso').val('');
  $('#codigo_term_ingreso').focus();
}

function set_code_bar(){
  let new_code = $("#codebar_lente").val();
  $("#codigo_lente_term").val(new_code);
  $("#new_barcode_lens").modal('hide');
}
/*================UPDATE STOCK TERMINADOS====================*/
function setStockTerminados(){
  let codigoProducto = $("#codigo_lente_term").val();
  let cantidad_ingreso = $("#cant_ingreso").val();
  let marca = $("#marca_lente").val();
  let diseno = $("#dis_lente").val();
  let esf = $("#esfera_terminado").val();
  let cil = $("#cilindro_terminado").val();
  let id_td = $("#id_td").val();
  let id_tabla = $("#id_tabla").val();
  let titulo = $("#title_modal_term").html();

  if (codigoProducto=="" || codigoProducto==null || codigoProducto==undefined){
	$("#new_barcode_lens").modal('show');
	$('#new_barcode_lens').on('shown.bs.modal', function() {
	$('#codebar_lente').val('');
	$('#codebar_lente').focus();
	});
	  return false;
  }

  if(cantidad_ingreso=="0") {
	  alerts_productos("error", "Debe Especificar la cantidad a ingresar");
	  return false; 
	}

   $.ajax({
    url:"../ajax/stock.php?op=update_stock_terminados",
    method:"POST",
    data:{codigoProducto:codigoProducto,cantidad_ingreso:cantidad_ingreso,id_tabla:id_tabla,esf:esf,cil:cil,id_td:id_td},
    cache: false,
    dataType:"json",
    success:function(data){
    	console.log(data);
        $("#modal_ingresos_term").modal('hide');
      if(data=="insertar"){        
        alerts_productos("success", "Producto inicializado en bodega");
      }else if(data=="Editar"){
      	alerts_productos("info", "El stock ha sido actualizado");
      }else if(data=='error'){
      	alerts_productos("warning", "Ya existe lente con codigo actual");
      }
      id_div = 'tabla_term'+id_tabla
      get_dataTableTerm(id_tabla,id_div);
      getNewStockTerm(id_td,id_tabla,codigoProducto);      
    }      
  });  


}/*============ FIN UPDATE STOCK TERMINADOS ================*/

/*============= GET NEW STOCK ITEM ====================*/
function getNewStockTerm(id_td,id_tabla,codigoProducto){
	$.ajax({
    url:"../ajax/stock.php?op=new_stock_terminados",
    method:"POST",
    data:{codigoProducto:codigoProducto,id_tabla:id_tabla,id_td:id_td},
    cache: false,
    dataType:"json",
    success:function(data){
    console.log(data);
    document.getElementById(id_td).innerHTML=data.stock;
    document.getElementById(id_td).style.background='#5bc0de';
    document.getElementById(id_td).style.color='white';
    }      
  }); 
}/*============= FIN GET NEW STOCK ITEM ====================*/

function downloadExcelTerm(tabla,title,fecha){
  let titulo = fecha+"_"+title;
  let tablaExport = document.getElementById(tabla);
  if(tablaExport == null || tablaExport == undefined ){
  	alerts_productos("warning", "Debe desplegar la tabla para poder ser descargada");
  	return false;
  }
  let table2excel = new Table2Excel();
  table2excel.export(document.getElementById(tabla),titulo);
}

key('⌘+i, ctrl+i', function(){ 
  ingresosGeneral();
});

function ingresosGeneral(){  
  $("#modal_ingresos_term_general").modal('show');
  $('#modal_ingresos_term_general').on('shown.bs.modal', function() {
  $('#codigo_term_ingreso').val('');
  $('#codigo_term_ingreso').focus();
  });
  ingresos_inventario = [];
  $("#items_ingresos_terminados").html("");
}

var ingresos_inventario = [];
function getLenteTermData(){  
    let codigoTerminado = $('#codigo_term_ingreso').val();
    $.ajax({
    url:"../ajax/stock.php?op=getDataTerminados",
    method:"POST",
    data:{codigoTerminado:codigoTerminado},
    cache: false,
    dataType:"json",
      success:function(data){
      console.log(data)
      if(data!="Vacio"){
        let item_lente = {
          marca : data.marca,
          diseno : data.diseno,
          esfera : data.esfera,
          cilindro : data.cilindro,
          cantidad : 1,
          costo : 0
        }
        ingresos_inventario.push(item_lente);
        listar_items_ingreso_term();
        clearCode();
      }else if(data=="Vacio"){
        alerts_productos("error", "Codigo no existe");
          return false;
      } 
    }     
  });

}

function listar_items_ingreso_term(){
  $("#items_ingresos_terminados").html("");
  var filas = '';

  for(var i=0; i<ingresos_inventario.length; i++){
    var filas = filas + "<tr>"+
    "<td>"+(i+1)+"</td>"+
    "<td>"+ingresos_inventario[i].esfera+"</td>"+
    "<td>"+ingresos_inventario[i].cilindro+"</td>"+
    "<td>"+ingresos_inventario[i].marca+"</td>"+
    "<td>"+ingresos_inventario[i].diseno+"</td>"+
    "<td>"+"<input type='text' value='1' class='form-control cant_ingreso' style='height:25px;text-align:center'>"+"</td>"+
    "<td>"+"<input type='text' value='1' class='form-control cant_ingreso'style='height:25px;text-align:center'>"+"</td>"+
    "<td>"+"<i class='fas fa-trash'></i>"+"</td>"+        
    "</tr>";
  }
   $('#items_ingresos_terminados').html(filas);  
}


function setStockTerminadosUpdate(){
  let codigo = $("#codigo_ingreso").val();
  let td = $("#id_td_ingreso").val();
  let id_tabla = $("#id_tabla_ingreso").val();

  $.ajax({
    url:"../ajax/stock.php?op=updateTerminados",
    method:"POST",
    data:{codigo:codigo,td:td,id_tabla:id_tabla},
    cache: false,
    dataType:"json",
    success:function(data){

    }
  });
}

init();