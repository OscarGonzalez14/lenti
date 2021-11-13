
function get_dataTableTerm(id_tabla,div_element){
      console.log(id_tabla);
	  $.ajax({
      url:"../ajax/stock.php?op=get_tableTerm",
      method:"POST",
      data : {id_tabla:id_tabla},
      cache:false,
      //dataType:"json",
      success:function(data){      
      	$("#"+div_element).html(data);
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
	if (codigo=="" || codigo==null || codigo==undefined){
		$("#new_barcode_lens").modal('show');
		$('#new_barcode_lens').on('shown.bs.modal', function() {
		$('#codebar_lente').val('');
		$('#codebar_lente').focus();
	});

   }
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
  let titulo = $("#title_modal_term").html()


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
    	document.getElementById(id_td).style.background='#5bc0de';
        document.getElementById(id_td).style.color='white';
        $("#modal_ingresos_term").modal('hide');
      if(data=="insertar"){        
        alerts_productos("success", "Producto inicializado en bodega");
      }else if(data=="Editar"){
      	alerts_productos("info", "El stock ha sido actualizado");
      }else if(data=='error'){
      	alerts_productos("warning", "Ya existe lente con codigo actual");
      }
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
    }      
  }); 
}/*============= FIN GET NEW STOCK ITEM ====================*/


let $btnExportar = document.querySelector("#btnExportar");
let $tablessilor = document.querySelector("#tablessilor");
$btnExportar.addEventListener("click", function() {
    let tableExport = new TableExport($tablessilor, {
        exportButtons: false, // No queremos botones
        filename: "Inventario", //Nombre del archivo de Excel
        sheetname: "Inventario", //Título de la hoja
    });
    let datos = tableExport.getExportData();
    let preferenciasDocumento = datos.tablessilor.xlsx;
    tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
});