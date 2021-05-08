<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=	, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<script>
    
    function PulsarTecla(event)
{
    tecla = event.keyCode; 
    if(tecla==32)
    {
      space();
    }
}
 
window.onkeydown=PulsarTecla;

		function space() {
			console.log('Hello mundo')
		}
	</script>
</body>
</html>