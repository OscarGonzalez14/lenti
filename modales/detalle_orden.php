  <!-- The Modal -->
  <div class="modal fade" id="detalle_orden" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%">
      <div class="modal-content">
        <!-- Modal body -->
      <div class="modal-header" style="background: #162e41;color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <table width="100%" style="margin-top:0px;">
            <tr>
              <th colspan="10"><img src="../dist/img/lenti_logo.png" width="85" height="65"/></th>
              <th colspan="70" style="text-align: center;margin-top: 0px;color:#0088b6;font-size:14px;font-family: Helvetica, Arial, sans-serif;"><b>ORDEN DE PRODUCCIÓN</b></th>
              <th colspan="20"><strong>ORDEN</strong><br><strong style="color:red;">No.&nbsp;<span>001</strong></th>
            </tr>
          </table>
          <br>

          <div class="eight">
          <h1>HISTORIAL</h1>
            <table width="100%" class="table-hover table-bordered display nowrap">
              <tr style="text-align: center;font-size: 12px;background: #162e41;color: white">
                <td colspan="5" class="ord_1" style="width:5%">Fecha</td>
                <td colspan="25" class="ord_1" style="width:25%">Usuario</td>
                <td colspan="5" class="ord_1" style="width:5%"># Orden</td>
                <td colspan="35" class="ord_1" style="width:35%">Acción</td>
                <td colspan="30" class="ord_1" style="width:30%">Observaciones</td>
              </tr>
             
              <tbody id="historial_orden_detalles" class="ord_2"></tbody>
            </table>
          </div>     

        </div><!--FIN BODY-->
      </div>
    </div>
  </div>
  
