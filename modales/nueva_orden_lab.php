<div class="modal fade" id="nueva_orden_lab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 80% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">NUEVA ORDEN DE PRODUCCION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="eight" style="">
    <strong><h1>DATOS GENERALES</h1></strong>
  <div class="form-row align-items-center row" style="margin: 4px">

    <div class="form-group col-sm-5">
      <label for="inlineFormInputGroup">Paciente</label>
      <div class="input-group">
        <input type="text" class="form-control clear_orden_i" id="paciente_orden" autocomplete='off'>
      </div>
    </div>

    <div class="form-group col-sm-3">
      <label for="inputPassword4">Laboratorio</label>
      <select class="form-control clear_orden_i" id="laboratorio_orden" required>
        <option value="">Seleccionar Laboratorio...</option>
        <option value="Lomed">Lomed</option>
        <option value="Lenti">Lenti</option>
        <option value="Opti Procesos">Opti Procesos</option>
        <option value="PrismaLab">PrismaLab</option>
    </select>
    </div>

    <div class="form-group col-sm-4">
      <label for="inputPassword4">Proridad</label>
      <select class="form-control clear_orden_i" id="prioridad_orden" required>
        <option value="">Seleccionar Prioridad...</option>
        <option value="5">5 dia (Normal)</option>
        <option value="3">3 dias (Intermedio)</option>
        <option value="2">2 dias (Intermedio)</option>
        <option value="1">1 dias(Urgente)</option>
    </select>
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
