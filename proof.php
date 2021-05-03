<!DOCTYPE html>
<html>
<body>

<input type="text" id="myText" value="Mickey">

<p>Click the button to change the value of the text field.</p>

<button onclick="myFunction()">Try it</button>

<script>
function myFunction() {
  let personaje = document.getElementById("myText").value;
  console.log('Este es el personaje:'+personaje);
}
</script>

</body>
</html>