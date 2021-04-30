<script>  
function disable_check(){
  document.getElementById("bluecap").disabled = false;
}

</script>

<div class="modal fade" id="nueva_orden_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 85% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">NUEVA ORDEN DE PRODUCCION -- LABORATORIOS LENTI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="eight" style="">
    <strong><h1>DATOS GENERALES</h1></strong>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-8">
      <label for="inlineFormInputGroup">Paciente</label>
      <div class="input-group">
        <input type="text" class="form-control clear_orden_i" id="paciente_orden" autocomplete='off'>
      </div>
    </div>

    <div class="form-group col-sm-4">
      <label for="inputPassword4">Óptica</label>
      <select class="form-control clear_orden_i" id="laboratorio_orden" required>
        <option value="">Optica AV Plus</option>
      </select>
    </div>

<div class="eight">
  <strong><h1 style="color: #034f84">GRADUACIÓN(Rx Final) Y MEDIDAS</h1></strong>
  <div class="row">
  <div class="col-sm-6">    
  <table style="margin:0px;width:100%">
    <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>      
        <th style="text-align:center">ADICION</th>
        <th style="text-align:center">PRISMA</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odesferasf_orden"  style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odcilindrosf_orden"  style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odejesf_orden"  style="text-align: center"></td>             
        <td> <input type="text" class="form-control clear_orden_i"  id="oddicionf_orden"  style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="odprismaf_orden"  style="text-align: center"></td>                
      </tr>
      <tr>
        <td>OI</td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiesferasf_orden"   style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oicolindrosf_orden"   style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiejesf_orden"   style="text-align: center"></td>              
        <td> <input type="text" class="form-control clear_orden_i"  id="oiadicionf_orden"  style="text-align: center"></td>
        <td> <input type="text" class="form-control clear_orden_i"  id="oiprismaf_orden"  style="text-align: center"></td>     
      </tr>
     </tbody>
  </table>
  </div>  
  <div class="col-sm-6" style="margin-left: 0px">
      <table width="100%">
      <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
        <th colspan="5" style="width: 5%"></th>
        <th colspan="5" style="width: 5%;text-align: center">DIP</th>
        <th colspan="5" style="width: 5%;text-align: center">AP</th>
        <th colspan="5" style="width: 5%;text-align: center">AO</th>
      </thead>
      <tr>
        <td colspan="5" style="text-align:right;">OD</td>
        <td colspan="5"><input style="text-align: center"  id="dip_od" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center"  id="ap_od" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center"  id="ao_od" class="form-control clear_orden_i"></td>
      </tr>
      <tr>
        <td colspan="5" style="text-align:right;">OI</td>
        <td colspan="5"><input style="text-align: center"  id="dip_oi" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center"  id="ap_oi" class="form-control clear_orden_i"></td>
        <td colspan="5"><input style="text-align: center"  id="ao_oi" class="form-control clear_orden_i"></td>
      </tr>
    </table>
  </div>
</div>
</div>
<div class='row'>
    <div class="col-sm-12"> 
        <div class="eight"> 
            <h1>LENTE</h1>
            <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">LENTE</i></div>
        </div>
        <input type="text" class="form-control clear_orden_i" id="lente_orden">
      </div>
    </div>
        </div>  
    </div>  
</div>

<div class="row"> 
    <div class="col-sm-5">
      <div class="eight" style="align-items: center">
        <h1>ANTIRREFLEJANTE</h1>
            <div class="d-flex justify-content-center">

              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="arbluecap" value="option1">
                  <label class="form-check-label" for="inlineCheckbox1">Blue Cap</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="arnouv" value="option2">
                  <label class="form-check-label" for="inlineCheckbox2">No UV</label>
              </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="arsh" value="option3">
              <label class="form-check-label" for="inlineCheckbox3">ARSH</label>
            </div>
          </div>

      </div>
    </div>

    <div class="col-sm-2">
      <div class="eight">
        <h1>BLANCO</h1>
            <div class="d-flex justify-content-center">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="blanco" value="option2">
                  <label class="form-check-label" for="inlineCheckbox2"></label>
              </div>
            </div>
      </div>
    </div>

    <div class="col-sm-5">
      <div class="eight">
        <h1>PHOTOSENSIBLE</h1>
            <div class="d-flex justify-content-center">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="photocromphoto" value="option1">
                  <label class="form-check-label" for="inlineCheckbox1">Photocrom</label>
              </div>

              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="transitionphoto" value="option2">
                  <label class="form-check-label" for="inlineCheckbox2">Transitions</label>
              </div>
            </div>
      </div>
    </div>
    
</div>  
</div>
  <input type="hidden" id="id_pac_orden">
    <input type="hidden" id="id_consulta_orden">
  </div>
  </div><!--fin eigth #1-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block">GUARDAR</button>
      </div>
    </div>
  </div>
</div>
<script>  
disable_check();
</script>