<html>
<input type="text" id="input_uno" class="clear_orden_i">
<input type="text" id="input_dos" class="clear_orden_i">
<input type="text" id="input_tres" class="clear_orden_i">


<script>
    var element = document.getElementsByClassName("clear_orden_i");

    for(i=0;i<element.length;i++){
      let id_element = element[i].id;
      console.log(id_element);
      //document.getElementById(id_element).classList.remove('is-invalid');
      //document.getElementById(id_element).classList.remove('is-valid');
      //document.getElementById(id_element).value="";
    }
</script>
</html>