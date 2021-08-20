<!-- Modal -->
<div class="modal fade" id="modal_descargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 85%">
    <div class="modal-content">
      <div class="modal-header">

      <div class="form-row"><!--INPUTS-->

      <div class="col-sm-4">
        <label> Cod. Orden</label>
          <div class="input-group">
          <input type="text" class="form-control clear_orden_i" id="cod_orden_current" placeholder="codigo orden scan">
          <div class="input-group-append" onClick="getOrdenDesc()">
            <span class="input-group-text bg-info"><i class="fas fa-search"> </i></span>
          </div>             
        </div>
      </div>

      <div class="col-sm-4">
        <label> OD Lente</label>
          <div class="input-group">
          <input type="text" class="form-control clear_orden_i" id="cod_orden" placeholder="Lente OD">
          <div class="input-group-append" onClick="getOrdenDesc()">
            <span class="input-group-text bg-info"><i class="fas fa-search"> </i></span>
          </div>             
        </div>
      </div>

      <div class="col-sm-4">
        <label>OI Lente</label>
          <div class="input-group">
          <input type="text" class="form-control clear_orden_i" id="cod_orden" placeholder="Lente OI">
          <div class="input-group-append" onClick="getOrdenDesc()">
            <span class="input-group-text bg-info"><i class="fas fa-search"> </i></span>
          </div>             
        </div>
      </div>

    </div><!--FIN INPUTS-->
    </div><!--HEADER-->

    <div class="modal-body">

        <div class="card card-solid">
        <div class="card-body pb-0">
        <div class="row d-flex align-items-between" style="display: flex;flex-wrap: wrap;align-content: space-between;">

            <div class="col-12 col-sm-12 col-md-8"><!--Inicio Item-->
              <div class="card" style="border: solid 1px #5bc0de">
                <div class="card-footer" style="border-bottom: solid 1px #0275d8;" id="block_header">
                  <div class="text-left">
                    <a class="btn btn-sm bg-dark">
                      <i class="fas fa-file-alt"></i> # Orden: 1234
                    </a>
                    <a class="btn btn-sm btn-secondary">
                      <i class="fas fa-user"></i> <span id="pac_orden_desc">Paciente: CECILIA CAROLINA MEJIVAR NOLASCO</span>
                    </a>
                  </div>
                </div>
                <div class="card-body pt-0">
                    <b>OPTICA: <span id="optica_ord_det"></span></b>&nbsp;&nbsp;<b>SUCURSAL: <span id="suc_optica_ord_det"></span></b>
                </div>
              </div>
            </div><!--Inicio Item-->

            <div class="col-12 col-sm-12 col-md-4"><!--Inicio Item-->
              <div class="card bg-light">
                <div class="card-footer">
                  <div class="text-left">
                      <a href="#" class="btn btn-sm btn-dark">
                      <i class="fas fa-glasses"></i> Lentes
                    </a>
                  </div>
                </div>
                <div class="card-body pt-0">
                  CONTENT
                </div>
              </div>
            </div><!--Inicio Item-->

        </div>
        </div>
        </div> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-block" style="background: #112438;color: white;border-radius: 0px">REGISTRAR DESCARGO</button>
      </div>
    </div>
  </div>
</div>