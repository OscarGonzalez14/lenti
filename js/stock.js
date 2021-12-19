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

  }else if (e.keyCode === 40) {
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


key('escape', function(){
  clearCode();
});


function clearCode(){
  $('#codigo_term_ingreso').focus();
  $('#codigo_term_ingreso').val('');
}

/*================UPDATE STOCK TERMINADOS====================*/
key('enter', function(){
  setStockTerminados();
});

function setStockTerminados(){

  let cat_codigo = $("#categoria_codigo").val();
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
    data:{codigoProducto:codigoProducto,cantidad_ingreso:cantidad_ingreso,id_tabla:id_tabla,esf:esf,cil:cil,id_td:id_td,cat_codigo:cat_codigo},
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

function downloadExcelTermx(){


  let table2excel = new Table2Excel();
  table2excel.export(document.getElementById("tabla_base"));
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

  $('#modal_ingresos_term_general').modal({
  backdrop: 'static',
  keyboard: true
})
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
          costo : 0,
          stock : data.stock,
          codigo : data.codigo
        }
        ingresos_inventario.push(item_lente);
        listar_items_ingreso_term();
        clearCode();
      }else if(data=="Vacio"){
        alerts_productos("error", "Codigo no existe");
        var error = document.getElementById("error_sound_ingreso"); 
        error.play();
        clearCode();
      } 
    }     
  });
}


function listar_items_ingreso_term(){
  $("#items_ingresos_terminados").html("");
  var filas = '';
  let tam_array = (ingresos_inventario.length)-1; 
  for(var i=tam_array; i >= 0; i--){
    var filas = filas + "<tr id='fila"+i+"'>"+
    "<td>"+(i+1)+"</td>"+
    "<td>"+ingresos_inventario[i].codigo+"</td>"+
    "<td>"+ingresos_inventario[i].marca+"</td>"+
    "<td>"+ingresos_inventario[i].diseno+"</td>"+
    "<td>"+ingresos_inventario[i].stock+" U."+"</td>"+
    "<td>"+ingresos_inventario[i].esfera+"</td>"+
    "<td>"+ingresos_inventario[i].cilindro+"</td>"+
    "<td>"+"<input type='text' value='1' class='form-control cant_ingreso' style='height:25px;text-align:center' id='cant_"+i+"' onClick='setCantidadIng(event, this, "+(i)+");' onKeyUp='setCantidadIng(event, this, "+(i)+");'>"+"</td>"+
    "<td>"+"<input type='text' value='1' class='form-control cant_ingreso'style='height:25px;text-align:center'>"+"</td>"+
    "<td>"+"<i class='fas fa-trash' onClick='eliminarFila("+i+");'></i>"+"</td>"+        
    "</tr>";
  }
    $('#items_ingresos_terminados').html(filas);
}

function setCantidadIng(event, obj, idx){
    event.preventDefault();
    ingresos_inventario[idx].cantidad = parseInt(obj.value);
}

  function eliminarFila(index) {
    $("#fila" + index).remove();
    drop_index(index);
  }

  function drop_index(position_element){
    ingresos_inventario.splice(position_element, 1);
    listar_items_ingreso_term();
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


function registroMultiple(){
 $.ajax({
 url:"../ajax/stock.php?op=registroMultiple",
 method: "POST",
 data: {'lentesUpdate':JSON.stringify(ingresos_inventario)},
 cache:  false,
 dataType: "json",
 success:function(data){
   $("#modal_ingresos_term_general").modal("hide");
   alerts_productos("success", "El inventario ha sido actualizado exitosamente");
   //get_dataTableTerm();
 }
 });//Fin Ajax
}

/**************************************************
==================== BASES INVENTARIO =============
****************************************************/
/*-------------- SHOW TABLAS BASES----------*/
function get_dataTableBase(id_div,marca){
 $.ajax({
      url:"../ajax/stock.php?op=get_tableBaseVs",
      method:"POST",
      data : {marca:marca},
      cache:false,
      //dataType:"json",
      success:function(data){   
        $("#"+id_div).html(data);
      }
    });
}

function initStockBasesvs(base,codigo,id_tabla,marca,diseno,id_td){
  $("#tipo_lente_code").val("Base");
  $("#modal_ingresos_basevs").modal('show');
  $("#title_modal_bases").html(`Ingreso a Inventario base ${base}, ${diseno}`);
  $("#codigo_lente_term").val(codigo);
  $("#marca_basevs").val(marca);
  $("#base_basevs").val(base);
  $("#id_td_base").val(id_td);
  $("#id_tabla_base").val(id_tabla);
  $("#dis_base").val(diseno);
  $("#cant_ingreso_base").val('0');

  if (codigo==''){
    $("#new_barcode_lens").modal('show');
    $('#new_barcode_lens').on('shown.bs.modal', function() {
    $('#codebar_lente').val('');
    $('#codebar_lente').focus();
  });
  }
}
/*===============  INICIALIZAR STOCK BASES =================*/
function setStockBases(){

  let codigoProducto = $("#codigo_lente_term").val();
  let diseno = $("#dis_base").val();
  let base = $("#base_basevs").val();
  let cantidad = $("#cant_ingreso_base").val();
  let comprobante = $("#comprobante_base").val();
  let costo = $("#comprobante_base").val();
  let id_td = $("#id_td_base").val();
  let id_tabla = $("#id_tabla_base").val();
  let cat_codigo = $("#categoria_codigo").val();
  let marca = $("#marca_basevs").val();
  let id_div = "base"+marca;

  if (codigoProducto=="" || codigoProducto==null || codigoProducto==undefined){
    $("#new_barcode_lens").modal('show');
    $('#new_barcode_lens').on('shown.bs.modal', function() {
    $('#codebar_lente').val('');
    $('#codebar_lente').focus();
  });
  return false;
  }

  if(cantidad=="0") {
    alerts_productos("error", "Debe Especificar la cantidad a ingresar");
    return false; 
  }

  $.ajax({
  url:"../ajax/stock.php?op=update_stock_basevs",
  method:"POST",
  data:{codigoProducto:codigoProducto,id_td,base:base,cantidad:cantidad,id_tabla:id_tabla,comprobante:comprobante,costo:costo,cat_codigo:cat_codigo},
  cache: false,
  dataType:"json",
  success:function(data){
    $("#modal_ingresos_basevs").modal('hide');
    if (data=='Insert'){
      alerts_productos("success", "Producto inicializado en bodega");
    }else if(data=="Edit"){
      alerts_productos("info", "El stock ha sido actualizado");
    }

     setStockBasevs(id_td,base,codigoProducto);           
  }          
  });
}
  function setStockBasevs(id_td,base,codigo){

    $.ajax({
    url:"../ajax/stock.php?op=new_stock_basevs",
    method:"POST",
    data:{codigo:codigo,base:base,id_td:id_td},
    cache: false,
    dataType:"json",
    success:function(data){    
    document.getElementById(id_td).innerHTML=data.stock;
    document.getElementById(id_td).style.background='#5bc0de';
    document.getElementById(id_td).style.color='white';
    }      
  }); 

  }

  function eliminarItemDescargo(codigo,tabla,ojo){
   document.getElementById(tabla).innerHTML="";
   if (ojo=='derecho') {
    document.getElementById("cod_lente_inv").readOnly = false;
    document.getElementById("cod_lente_inv").value = "";
    $('#cod_lente_inv').focus();
   }else{
    document.getElementById("cod_lente_oi").readOnly = false;
    document.getElementById("cod_lente_oi").value = "";
    $('#cod_lente_oi').focus();
   }
   let indice = array_items_desc.findIndex((objeto, indice, array_items_desc) =>{
      return objeto.codigo == codigo
    });
    array_items_desc.splice(indice,1)
  }



init();