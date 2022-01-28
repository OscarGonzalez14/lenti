
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>



<script>
	let departamento = ["Ahuachapán","Santa Ana","Sonsonate","Chalatenango","La Libertad","San Salvador","Cuscatlán","La Paz","Cabañas","San Vicente","Usulután","San Miguel","Morazán","La Unión"];
	let Ahuachapán=["Ahuachapán","Apaneca","Atiquizaya","Concepción de Ataco","El Refugio","Guaymango","Jujutla","San Francisco Menéndez","San Lorenzo","San Pedro Puxtla","Tacuba","Turín"];
	let Santa Ana =["Candelaria de la Frontera","Chalchuapa","Coatepeque","El Congo","El Porvenir","Masahuat","Metapán","San Antonio Pajonal","San Sebastián Salitrillo","Santa Ana","Santa Rosa Guachipilín","Santiago de la Frontera","Texistepeque"];
	let Sonsonate = ["Acajutla","Armenia","Caluco","Cuisnahuat","Izalco","Juayúa","Nahuizalco","Nahulingo","Salcoatitán","San Antonio del Monte","San Julián","Santa Catarina Masahuat","Santa Isabel Ishuatán","Santo Domingo Guzmán","Sonsonate","Sonzacate"];
	let Chalatenango = ["Agua Caliente","Arcatao","Azacualpa","Chalatenango","Comalapa","Citalá","Concepción Quezaltepeque","Dulce Nombre de María","El Carrizal","El Paraíso","La Laguna","La Palma","La Reina","Las Vueltas","Nueva Concepción","Nueva Trinidad","Nombre de Jesús","Ojos de Agua","Potonico","San Antonio de la Cruz","San Antonio Los Ranchos","San Fernando","San Francisco Lempa","San Francisco Morazán","San Ignacio","San Isidro Labrador","San José Cancasque","San José Las Flores","San Luis del Carmen","San Miguel de Mercedes","San Rafael","Santa Rita","Tejutla"];
	let La Libertad = ["Antiguo Cuscatlán","Chiltiupán","Ciudad Arce","Colón","Comasagua","Huizúcar","Jayaque","Jicalapa","La Libertad","Santa Tecla","Nuevo Cuscatlán","San Juan Opico","Quezaltepeque","Sacacoyo","San José Villanueva","San Matías","San Pablo Tacachico","Talnique","Tamanique","Teotepeque","Tepecoyo","Zaragoza"];
	let San Salvador = ["Aguilares","Apopa","Ayutuxtepeque","Cuscatancingo","Ciudad Delgado","El Paisnal","Guazapa","Ilopango","Mejicanos","Nejapa","Panchimalco","Rosario de Mora","San Marcos","San Martín","San Salvador","Santiago Texacuangos","Santo Tomás","Soyapango","Tonacatepeque"];
	let Cuscatlán = ["Candelaria","Cojutepeque","El Carmen","El Rosario","Monte San Juan","Oratorio de Concepción","San Bartolomé Perulapía","San Cristóbal","San José Guayabal","San Pedro Perulapán","San Rafael Cedros","San Ramón","Santa Cruz Analquito","Santa Cruz Michapa","Suchitoto","Tenancingo"];
	let La Paz = ["Cuyultitán","El Rosario","Jerusalén","Mercedes La Ceiba","Olocuilta","Paraíso de Osorio","San Antonio Masahuat","San Emigdio","San Francisco Chinameca","San Juan Nonualco","San Juan Talpa","San Juan Tepezontes","San Luis Talpa","San Luis La Herradura","San Miguel Tepezontes","San Pedro Masahuat","San Pedro Nonualco","San Rafael Obrajuelo","Santa María Ostuma","Santiago Nonualco","Tapalhuaca","Zacatecoluca"];
	let Cabañas = ["Cinquera","Dolores","Guacotecti","Ilobasco","Jutiapa","San Isidro","Sensuntepeque","Tejutepeque","Victoria"];
	let San Vicente = ["Apastepeque","Guadalupe","San Cayetano Istepeque","San Esteban Catarina","San Ildefonso","San Lorenzo","San Sebastián","San Vicente","Santa Clara","Santo Domingo","Tecoluca","Tepetitán","Verapaz"];
	let Usulután = ["Alegría","Berlín","California","Concepción Batres","El Triunfo","Ereguayquín","Estanzuelas","Jiquilisco","Jucuapa","Jucuarán","Mercedes Umaña","Nueva Granada","Ozatlán","Puerto El Triunfo","San Agustín","San Buenaventura","San Dionisio","San Francisco Javier","Santa Elena","Santa María","Santiago de María","Tecapán","Usulután"];
	let San Miguel = ["Carolina","Chapeltique","Chinameca","Chirilagua","Ciudad Barrios","Comacarán","El Tránsito","Lolotique","Moncagua","Nueva Guadalupe","Nuevo Edén de San Juan","Quelepa","San Antonio del Mosco","San Gerardo","San Jorge","San Luis de la Reina","San Miguel","San Rafael Oriente","Sesori","Uluazapa"];
	let Morazán = ["Arambala","Cacaopera","Chilanga","Corinto","Delicias de Concepción","El Divisadero","El Rosario","Gualococti","Guatajiagua","Joateca","Jocoaitique","Jocoro","Lolotiquillo","Meanguera","Osicala","Perquín","San Carlos","San Fernando","San Francisco Gotera","San Isidro","San Simón","Sensembra","Sociedad","Torola","Yamabal","Yoloaiquín"];
	let La Unión = ["Anamorós","Bolívar","Concepción de Oriente","Conchagua","El Carmen","El Sauce","Intipucá","La Unión","Lislique","Meanguera del Golfo","Nueva Esparta","Pasaquina","Polorós","San Alejo","San José","Santa Rosa de Lima","Yayantique","Yucuaiquín"];


	if (depto == "Ahuachapán") {
		municipios = ["Ahuachapán","Apaneca","Atiquizaya","Concepción de Ataco","El Refugio","Guaymango","Jujutla","San Francisco Menéndez","San Lorenzo","San Pedro Puxtla","Tacuba","Turín"];
	}else if (depto == "Santa Ana"){
		municipios = ["Candelaria de la Frontera","Chalchuapa","Coatepeque","El Congo","El Porvenir","Masahuat","Metapán","San Antonio Pajonal","San Sebastián Salitrillo","Santa Ana","Santa Rosa Guachipilín","Santiago de la Frontera","Texistepeque"];
	}else if (depto == "Sonsonate"){
		municipios = ["Acajutla","Armenia","Caluco","Cuisnahuat","Izalco","Juayúa","Nahuizalco","Nahulingo","Salcoatitán","San Antonio del Monte","San Julián","Santa Catarina Masahuat","Santa Isabel Ishuatán","Santo Domingo Guzmán","Sonsonate","Sonzacate"];
	}else if (depto == "Chalatenango"){
		municipios = ["Agua Caliente","Arcatao","Azacualpa","Chalatenango","Comalapa","Citalá","Concepción Quezaltepeque","Dulce Nombre de María","El Carrizal","El Paraíso","La Laguna","La Palma","La Reina","Las Vueltas","Nueva Concepción","Nueva Trinidad","Nombre de Jesús","Ojos de Agua","Potonico","San Antonio de la Cruz","San Antonio Los Ranchos","San Fernando","San Francisco Lempa","San Francisco Morazán","San Ignacio","San Isidro Labrador","San José Cancasque","San José Las Flores","San Luis del Carmen","San Miguel de Mercedes","San Rafael","Santa Rita","Tejutla"];
	}else if (depto == "La Libertad"){
		municipios = ["Antiguo Cuscatlán","Chiltiupán","Ciudad Arce","Colón","Comasagua","Huizúcar","Jayaque","Jicalapa","La Libertad","Santa Tecla","Nuevo Cuscatlán","San Juan Opico","Quezaltepeque","Sacacoyo","San José Villanueva","San Matías","San Pablo Tacachico","Talnique","Tamanique","Teotepeque","Tepecoyo","Zaragoza"];
	}else if (depto == "San Salvador"){
		municipios = ["Aguilares","Apopa","Ayutuxtepeque","Cuscatancingo","Ciudad Delgado","El Paisnal","Guazapa","Ilopango","Mejicanos","Nejapa","Panchimalco","Rosario de Mora","San Marcos","San Martín","San Salvador","Santiago Texacuangos","Santo Tomás","Soyapango","Tonacatepeque"];
	}else if (depto == "Cuscatlán"){
		municipios = ["Candelaria","Cojutepeque","El Carmen","El Rosario","Monte San Juan","Oratorio de Concepción","San Bartolomé Perulapía","San Cristóbal","San José Guayabal","San Pedro Perulapán","San Rafael Cedros","San Ramón","Santa Cruz Analquito","Santa Cruz Michapa","Suchitoto","Tenancingo"];
	}else if (depto == "La Paz"){
		municipios = ["Cuyultitán","El Rosario","Jerusalén","Mercedes La Ceiba","Olocuilta","Paraíso de Osorio","San Antonio Masahuat","San Emigdio","San Francisco Chinameca","San Juan Nonualco","San Juan Talpa","San Juan Tepezontes","San Luis Talpa","San Luis La Herradura","San Miguel Tepezontes","San Pedro Masahuat","San Pedro Nonualco","San Rafael Obrajuelo","Santa María Ostuma","Santiago Nonualco","Tapalhuaca","Zacatecoluca"];
	}else if (depto == "Cabañas"){
		municipios = ["Cinquera","Dolores","Guacotecti","Ilobasco","Jutiapa","San Isidro","Sensuntepeque","Tejutepeque","Victoria"];
	}else if (depto == "San Vicente"){
		municipios = ["Apastepeque","Guadalupe","San Cayetano Istepeque","San Esteban Catarina","San Ildefonso","San Lorenzo","San Sebastián","San Vicente","Santa Clara","Santo Domingo","Tecoluca","Tepetitán","Verapaz"];
	}else if (depto == "Usulután"){
		municipios = ["Alegría","Berlín","California","Concepción Batres","El Triunfo","Ereguayquín","Estanzuelas","Jiquilisco","Jucuapa","Jucuarán","Mercedes Umaña","Nueva Granada","Ozatlán","Puerto El Triunfo","San Agustín","San Buenaventura","San Dionisio","San Francisco Javier","Santa Elena","Santa María","Santiago de María","Tecapán","Usulután"];
	}else if (depto == "San Miguel"){
		municipios = ["Carolina","Chapeltique","Chinameca","Chirilagua","Ciudad Barrios","Comacarán","El Tránsito","Lolotique","Moncagua","Nueva Guadalupe","Nuevo Edén de San Juan","Quelepa","San Antonio del Mosco","San Gerardo","San Jorge","San Luis de la Reina","San Miguel","San Rafael Oriente","Sesori","Uluazapa"];
	}else if (depto == "Morazán"){
		municipios = ["Arambala","Cacaopera","Chilanga","Corinto","Delicias de Concepción","El Divisadero","El Rosario","Gualococti","Guatajiagua","Joateca","Jocoaitique","Jocoro","Lolotiquillo","Meanguera","Osicala","Perquín","San Carlos","San Fernando","San Francisco Gotera","San Isidro","San Simón","Sensembra","Sociedad","Torola","Yamabal","Yoloaiquín"];
	}else if(depto == "La Unión"){
		municipios = ["Anamorós","Bolívar","Concepción de Oriente","Conchagua","El Carmen","El Sauce","Intipucá","La Unión","Lislique","Meanguera del Golfo","Nueva Esparta","Pasaquina","Polorós","San Alejo","San José","Santa Rosa de Lima","Yayantique","Yucuaiquín"];
	}
 }
</script>

</body>
</html>