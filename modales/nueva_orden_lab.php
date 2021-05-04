      <div class="modal fade" id="nueva_orden_lab">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h4 class="modal-title" style="font-size: 15px">ORDEN DE PRODUCCION</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"><!--START MODAL BODY-->
              
            <div class="eight datos-generales">
              <strong><h1>DATOS GENERALES</h1></strong>
              <div class="form-row" style="margin-top: 1px"><!--./Inicio Form row-->

                <div class="form-group col-sm-8">
                  <label for="inlineFormInputGroup">Paciente</label>
                  <input type="text" class="form-control clear_orden_i" id="paciente_orden" autocomplete='off'>
                </div>

                <div class="form-group col-sm-4">
                  <label for="inputPassword4">Óptica</label>
                  <select class="form-control clear_orden_i" id="laboratorio_orden" required>
                  <option value="">Optica AV Plus</option>
                  </select>
                </div>

              </div><!--./Fin Form row-->
            </div><!--./*********Fin datos-generales************-->

            <!--################ RX final + medidas #############-->
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
<!--################ FIN rx final + medidas #############-->
          <div class="row tratamientos">
              
              <div class="col-sm-5 antirrflejantes">

                <div class="eight" style="align-items: center">
                  <h1>ANTIRREFLEJANTE</h1>
                  <div class="d-flex justify-content-center">

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="arbluecap" value="option1" onClick='status_checks_tratamientos();'>
                      <label class="form-check-label" for="inlineCheckbox1" id="lbl_arbluecap">Blue Cap</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="arnouv" value="option2" onClick='status_checks_tratamientos();'>
                      <label class="form-check-label" for="inlineCheckbox2" id="lbl_arnouv">No UV</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="arsh" value="option3" onClick='status_checks_tratamientos();'>
                      <label class="form-check-label" for="inlineCheckbox3" id="lbl_arsh">ARSH</label>
                    </div>
                  </div>

                </div>

            </div><!--antirrflejantes-->

            <div class="col-sm-2">
            <div class="eight">
              <h1>BLANCO</h1>
                  <div class="d-flex justify-content-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="blanco" value="option2" onClick='status_checks_tratamientos();'>
                        <label class="form-check-label" for="inlineCheckbox2" id="lbl_blanco"></label>
                    </div>
                  </div>
            </div>
          </div>

          <div class="col-sm-5">
              <div class="eight">
                <h1>PHOTOSENSIBLE</h1>
                    <div class="d-flex justify-content-center">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="photocromphoto" value="option1" onClick='status_checks_tratamientos();'>
                        <label class="form-check-label" for="inlineCheckbox1">Photocrom</label>
                      </div>

                      <div class="form-check form-check-inline ">
                          <input class="form-check-input" type="checkbox" id="transitionphoto" value="option2" onClick='status_checks_tratamientos();'>
                          <label class="form-check-label" for="inlineCheckbox2" id="lbl_transitionphoto">Transitions</label>
                      </div>
                    </div>
              </div>
            </div>

          </div> <!--Fin tratamientos-->

          <div class="eight">
            <h1>ARO</h1>

            <div class="form-row align-items-center row" style="margin: 4px">

              <div class="form-group col-sm-3">
                <label for="">Modelo</label>
                <input type="text" class="form-control clear_orden_i" id="modelo_aro_orden" readonly="">
              </div>

              <div class="form-group col-sm-3">
                <label for="">Marca</label>
                <input type="text" class="form-control clear_orden_i" id="marca_aro_orden" readonly="">
              </div>

              <div class="form-group col-sm-3">
                <label for="">Color</label>
                <input type="text" class="form-control clear_orden_i" id="color_aro_orden" readonly="">
              </div>

              <div class="form-group col-sm-3">
                  <label for="">Diseño</label>
                  <input type="text" class="form-control clear_orden_i" id="diseno_aro_orden" readonly="">
                </div>
              </div>

          <table style="margin:0px;width:100%">
              <thead class="thead-light" style="color: black;font-family: Helvetica, Arial, sans-serif;font-size: 11px;text-align: center;background: #f8f8f8">
                <tr>
                  <th  colspan="25" style="text-align:center;width:25%">HORIZONTAL</th>
                  <th  colspan="25" style="text-align:center;width:25%">DIAGONAL</th>
                  <th  colspan="25" style="text-align:center;width:25%">VERTICAL</th>
                  <th  colspan="25" style="text-align:center;width:25%">PUENTE</th>        
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_a" onClick="get_correlativo_orden();"></td>
                  <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_b" onClick="get_correlativo_orden();"></td>
                  <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_c" onClick="get_correlativo_orden();"></td>     
                  <td colspan="25" style="width: 25%"> <input type="text" class="form-control clear_orden_i" placeholder="---" id="med_d" onClick="get_correlativo_orden();"></td>                
                </tr>
            </table>

            <div class="form-group col-sm-12">
              <label for="">Observaciones</label>
              <input type="text" class="form-control clear_orden_i" id="observaciones_orden">
            </div>

         </div> 
          <input type="text" id="codigoOrden">
          </div><!--/END MODAL BODY-->

            <div class="modal-footer justify-content-between">
              <a href="barcode_orden_print.php" ><button type="button" class="btn btn-default" style="background: black; color: white"><i class="fas fa-barcode"></i> Imprimir</button></a>
              <button type="button" class="btn btn-primary" onClick='guardar_orden();'>Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->