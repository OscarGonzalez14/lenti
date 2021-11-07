function get_dataTableTerm(id_tabla,div_element){
      
	  $.ajax({
      url:"../ajax/stock.php?op=get_tableTerm",
      method:"POST",
      data : {id_tabla:id_tabla},
      cache:false,
      //dataType:"json",
      success:function(data){      
      	$("#table_term1").html(data);      
      }
    });

}