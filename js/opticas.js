function init(){
	listar_sucursales_optica();
	ocultar_btn_edit_sucursal();
}

function ocultar_btn_edit_sucursal(){
  document.getElementById("editar_suc").style.display = "none";
}

function ocultar_btn_guardar_sucursal(){
  document.getElementById("guardar_suc").style.display = "none";
}

function mostrar_btn_edit_sucursal(){
  document.getElementById("editar_suc").style.display = "block";
}

function mostrar_btn_guardar_sucursal(){
  document.getElementById("guardar_suc").style.display = "block";
} 

function guardar_optica(){
	let nom_optica=$("#nom_optica").val();
	let num_optica=$("#num_optica").val();
	let id_usuario=$("#id_usuario").val();
	
	if(nom_optica !="" && num_optica !=""){
		$.ajax({
			url:"../ajax/opticas.php?op=guardar_optica",
			method:"POST",
			data:{nom_optica:nom_optica,num_optica:num_optica,id_usuario:id_usuario},
			cache: false,
			dataType: "json",
			error:function(x,y,z){
				d_pacole.log(x);
				console.log(y);
				console.log(z);
			},
			success:function(data){
				console.log(data);	
				if(data=='error'){
					Swal.fire('Optica ya existe!','','error')
					return false;

				}else if (data=="ok") {
					Swal.fire('La optica ha sido creada!','','success')
					setTimeout ("explode();", 2000);
				}else{
					Swal.fire('Modificación ha sido un éxito!','','success')
					setTimeout ("explode();", 2000);
				}
			}
		});
	}
	Swal.fire('Debe llenar todos los campos!','','error')
}


function explode(){
    location.reload();
  }

///LISTAR OPTICAS INGRESADAS EN SISTEMA
  function listar_sucursales_optica(){

    $("#dt_sucursales_opti").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      dom: 'frti',
      //"buttons": [ "excel"],
      "searching": true,
      "ajax":
      {
        url: '../ajax/opticas.php?op=listar_sucursales_optica',
        type : "post",
        dataType : "json",        
        error: function(e){
          //console.log(e.responseText);  
        } 
      },
      "language": {
        "sSearch": "Buscar:"
      }
    }).buttons().container().appendTo('#dt_sucursales_opti_wrapper .col-md-6:eq(0)');

  }

//DESIGNAR CODIGO INTERNO A SUCURSALES
function get_correlativo_sucursal(){
  $.ajax({
    url:"../ajax/opticas.php?op=get_correlativo_sucursal",
    method:"POST",
    data:{},
    cache:false,
    dataType:"json",
      success:function(data){
      console.log(data);
      $("#codigo_suc").val(data.correlativo);  
      }
    });
}

//LIMPIAR CAMPOS DE MODAL NUEVA SUCURSAL OPTICA
$(document).on('click', '#nueva_sucursal', function(){
   let elements = document.getElementsByClassName("clear_input");

    for(i=0;i<elements.length;i++){
      let id_element = elements[i].id;
      document.getElementById(id_element).value="";
    }
});

$(document).ready(function(){
  $("#dep_sucursal").change(function () {         
    $("#dep_sucursal option:selected").each(function () {
      depto = $(this).val();
      municipio(depto);        
    });
  })
});

function municipio(depto){
 
	if (depto == "Ahuachapán") {
		$("#mun_sucursal").empty();
		municipios = ["Ahuachapán","Apaneca","Atiquizaya","Concepción de Ataco","El Refugio","Guaymango","Jujutla","San Francisco Menéndez","San Lorenzo","San Pedro Puxtla","Tacuba","Turín"];
		$("#mun_sucursal").select2({
  	data: municipios
		})
	}else if (depto == "Santa Ana"){
		$("#mun_sucursal").empty();
		municipios = ["Candelaria de la Frontera","Chalchuapa","Coatepeque","El Congo","El Porvenir","Masahuat","Metapán","San Antonio Pajonal","San Sebastián Salitrillo","Santa Ana","Santa Rosa Guachipilín","Santiago de la Frontera","Texistepeque"];
		$("#mun_sucursal").select2({
  	data: municipios
		})
	}else if (depto == "Sonsonate"){
		$("#mun_sucursal").empty();
		municipios = ["Acajutla","Armenia","Caluco","Cuisnahuat","Izalco","Juayúa","Nahuizalco","Nahulingo","Salcoatitán","San Antonio del Monte","San Julián","Santa Catarina Masahuat","Santa Isabel Ishuatán","Santo Domingo Guzmán","Sonsonate","Sonzacate"];
		$("#mun_sucursal").select2({
  	data: municipios
		})
	}else if (depto == "Chalatenango"){
		$("#mun_sucursal").empty()
			municipios = ["Agua Caliente","Arcatao","Azacualpa","Chalatenango","Comalapa","Citalá","Concepción Quezaltepeque","Dulce Nombre de María","El Carrizal","El Paraíso","La Laguna","La Palma","La Reina","Las Vueltas","Nueva Concepción","Nueva Trinidad","Nombre de Jesús","Ojos de Agua","Potonico","San Antonio de la Cruz","San Antonio Los Ranchos","San Fernando","San Francisco Lempa","San Francisco Morazán","San Ignacio","San Isidro Labrador","San José Cancasque","San José Las Flores","San Luis del Carmen","San Miguel de Mercedes","San Rafael","Santa Rita","Tejutla"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "La Libertad"){
		$("#mun_sucursal").empty()
			municipios = ["Antiguo Cuscatlán","Chiltiupán","Ciudad Arce","Colón","Comasagua","Huizúcar","Jayaque","Jicalapa","La Libertad","Santa Tecla","Nuevo Cuscatlán","San Juan Opico","Quezaltepeque","Sacacoyo","San José Villanueva","San Matías","San Pablo Tacachico","Talnique","Tamanique","Teotepeque","Tepecoyo","Zaragoza"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "San Salvador"){
		$("#mun_sucursal").empty()
			municipios = ["Aguilares","Apopa","Ayutuxtepeque","Cuscatancingo","Ciudad Delgado","El Paisnal","Guazapa","Ilopango","Mejicanos","Nejapa","Panchimalco","Rosario de Mora","San Marcos","San Martín","San Salvador","Santiago Texacuangos","Santo Tomás","Soyapango","Tonacatepeque"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "Cuscatlán"){
		$("#mun_sucursal").empty()
			municipios = ["Candelaria","Cojutepeque","El Carmen","El Rosario","Monte San Juan","Oratorio de Concepción","San Bartolomé Perulapía","San Cristóbal","San José Guayabal","San Pedro Perulapán","San Rafael Cedros","San Ramón","Santa Cruz Analquito","Santa Cruz Michapa","Suchitoto","Tenancingo"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "La Paz"){
		$("#mun_sucursal").empty()
			municipios = ["Cuyultitán","El Rosario","Jerusalén","Mercedes La Ceiba","Olocuilta","Paraíso de Osorio","San Antonio Masahuat","San Emigdio","San Francisco Chinameca","San Juan Nonualco","San Juan Talpa","San Juan Tepezontes","San Luis Talpa","San Luis La Herradura","San Miguel Tepezontes","San Pedro Masahuat","San Pedro Nonualco","San Rafael Obrajuelo","Santa María Ostuma","Santiago Nonualco","Tapalhuaca","Zacatecoluca"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "Cabañas"){
		$("#mun_sucursal").empty()
			municipios = ["Cinquera","Dolores","Guacotecti","Ilobasco","Jutiapa","San Isidro","Sensuntepeque","Tejutepeque","Victoria"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "San Vicente"){
		$("#mun_sucursal").empty()
			municipios = ["Apastepeque","Guadalupe","San Cayetano Istepeque","San Esteban Catarina","San Ildefonso","San Lorenzo","San Sebastián","San Vicente","Santa Clara","Santo Domingo","Tecoluca","Tepetitán","Verapaz"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "Usulután"){
		$("#mun_sucursal").empty()
			municipios = ["Alegría","Berlín","California","Concepción Batres","El Triunfo","Ereguayquín","Estanzuelas","Jiquilisco","Jucuapa","Jucuarán","Mercedes Umaña","Nueva Granada","Ozatlán","Puerto El Triunfo","San Agustín","San Buenaventura","San Dionisio","San Francisco Javier","Santa Elena","Santa María","Santiago de María","Tecapán","Usulután"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "San Miguel"){
		$("#mun_sucursal").empty()
			municipios = ["Carolina","Chapeltique","Chinameca","Chirilagua","Ciudad Barrios","Comacarán","El Tránsito","Lolotique","Moncagua","Nueva Guadalupe","Nuevo Edén de San Juan","Quelepa","San Antonio del Mosco","San Gerardo","San Jorge","San Luis de la Reina","San Miguel","San Rafael Oriente","Sesori","Uluazapa"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if (depto == "Morazán"){
		$("#mun_sucursal").empty()
			municipios = ["Arambala","Cacaopera","Chilanga","Corinto","Delicias de Concepción","El Divisadero","El Rosario","Gualococti","Guatajiagua","Joateca","Jocoaitique","Jocoro","Lolotiquillo","Meanguera","Osicala","Perquín","San Carlos","San Fernando","San Francisco Gotera","San Isidro","San Simón","Sensembra","Sociedad","Torola","Yamabal","Yoloaiquín"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}else if(depto == "La Unión"){
		$("#mun_sucursal").empty()
			municipios = ["Anamorós","Bolívar","Concepción de Oriente","Conchagua","El Carmen","El Sauce","Intipucá","La Unión","Lislique","Meanguera del Golfo","Nueva Esparta","Pasaquina","Polorós","San Alejo","San José","Santa Rosa de Lima","Yayantique","Yucuaiquín"];
		$("#mun_sucursal").select2({
			data:municipios
		})
	}
 }

function guardar_sucursal(){

	let nom_sucursal=$("#nom_sucursal").val();
	let direccion=$("#dir_sucursal").val();	
	let telefono=$("#tel_sucursal").val();
	let correo=$("#correo_sucursal").val();
	let encargado=$("#encargado_sucursal").val();
	let usuario=$("#id_usuario").val();
	let codigo=$("#codigo_suc").val();
	let id_opt=$("#id_optica").val();
	let id_sucursal=$("#id_sucursal").val();
	let id_optica=id_opt.toString();
	let departamento=$("#dep_sucursal").val();
	let mun=$("#mun_sucursal").val();
	let municipio=mun.toString();
	let categoria=$("#cat_descuento").val();
	
	if (nom_sucursal !="" && direccion !="" && telefono!="" && correo !="" && encargado !="" && departamento !="" && municipio !="" && categoria !=""){
	
		$.ajax({
			url:"../ajax/opticas.php?op=guardar_sucursal",
			method:"POST",
			data:{nom_sucursal:nom_sucursal,direccion:direccion,telefono:telefono,correo:correo,encargado:encargado,usuario:usuario,codigo:codigo,id_optica:id_optica,id_sucursal:id_sucursal,departamento:departamento,municipio:municipio,categoria:categoria},
			cache: false,
			dataType: "json",
			error:function(x,y,z){
				d_pacole.log(x);
				console.log(y);
				console.log(z);
			},
			success:function(data){
				console.log(data);	
				if(data=='error'){
					Swal.fire('Sucursal no se guardó!','','error')
					return false;
				}else if (data=="creado"){
					Swal.fire('La sucursal ha sido creada!','','success')
					$("#dt_sucursales_opti").DataTable().ajax.reload();
					setTimeout ("explode();", 2000);
				}else{
					Swal.fire('Modificación fué un éxito!','','success')
					$("#dt_sucursales_opti").DataTable().ajax.reload();
				}
			}
		});
}
Swal.fire('Llenar todos los campos, es importante ! :)','','error')
}

//VER DATA EN MODAL EN MODAL DE EDITAR
function show_datos_sucursal(id_sucursal,codigo){

	$('#t_dinamico').html('EDITAR SUCURSAL');
  
		$.ajax({
		url:'../ajax/opticas.php?op=show_datos_sucursal',
		method:"POST",
		data:{id_sucursal:id_sucursal,codigo:codigo},
		cache:false,
		dataType:"json",
		success:function(data){	
		console.log(data);
		$("#id_optica").val(data.optica);
		$("#nom_sucursal").val(data.nombre_sucursal);
		$("#dir_sucursal").val(data.direccion);
		$("#tel_sucursal").val(data.telefono);
		$("#correo_sucursal").val(data.correo);
		$("#encargado_sucursal").val(data.encargado);
		$("#id_usuario").val(data.id_usuario);
		$("#codigo_suc").val(data.codigo);
		$("#id_sucursal").val(data.id_sucursal);
		$("#dep_sucursal").val(data.departamento);
		$("#mun_sucursal").val(data.municipio);
		$("#cat_descuento").val(data.categoria);
    }
	});
}

function eliminar_sucursal(id_sucursal){
	  
	bootbox.confirm("¿Está Seguro de eliminar esta sucursal", function(result){
    if(result){

	$.ajax({
		url:"../ajax/opticas.php?op=eliminar_sucursal",
		method:"POST",
		data:{id_sucursal:id_sucursal},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			if(data=="ok"){
				setTimeout ("Swal.fire('Sucursal eliminada existosamente','','success')", 100);
			}else if(data=="existe"){
				setTimeout ("Swal.fire('La sucursal posee orden','','error')", 100);
			}						//alert(data);
			$("#dt_sucursales_opti").DataTable().ajax.reload();
		}
	});

}
});//bootbox

}


init();
