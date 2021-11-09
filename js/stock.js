
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