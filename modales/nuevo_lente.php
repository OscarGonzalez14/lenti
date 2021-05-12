<style>
  /*
Full screen Modal 
*/
.fullscreen-modal .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}
@media (min-width: 768px) {
  .fullscreen-modal .modal-dialog {
    width: 750px;
  }
}

</style>
<script>
  function focus_input(){
    document.getElementById(codigob_lente).focus();
  }
  </script>
<div class="modal fade" id="nuevo_lente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 65%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVO LENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--<button type="button" class="btn btn-sm btn-dark btn-flat float-right"><i class="fas fa-barcode"></i> Generar</button><br>-->

      

      <div class="form-row">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="codigob_lente">
              <span class="input-group-append">
              <button type="button" class="btn btn-info btn-flat" onClick="create_barcode_interno();"><i class="fas fa-barcode"></i> Generar</button>
              </span>
          </div>
        <div></div>
        <div></div>
        <div></div>
      </div>  



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">GUARDAR</button>
      </div>
    </div>
  </div>
</div>
