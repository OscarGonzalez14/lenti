<<tr>
     <th colspan="10" style="font-size:12px;border:#0061a9 1px solid;color:black;font-family: Helvetica, Arial, sans-serif;width:100%"><span class="subt">DATOS GENERALES</span></th>
  </tr>
  <tr>
    <td colspan="4"><strong>PACIENTE</strong></td>
    <td colspan="3"><strong>ÓPTICA</strong></td>
    <td colspan="3"><strong>SUCURSAL</strong></td>
  </tr>
  <tr>
    <td colspan="4"><?php echo "$paciente"; ?></td>
    <td colspan="3"><?php echo "$optica"; ?></td>
    <td colspan="3"><?php echo "$sucursal"; ?></td>
 </tr>
 <tr>
     <th colspan="20" style="font-size:12px;border:#0061a9 1px solid;color:black;font-family: Helvetica, Arial, sans-serif;width:100%"><span class="subt">ESPECIFICACIONES DE LENTE</span></th>
     <th colspan="1"></th>
     <th colspan="1"></th>
 </tr>
 <tr>
    <td colspan="5"><strong>LENTE</strong></td>
    <td colspan="5"><strong>MARCA</strong></td>
    <td colspan="10"><strong>TRATAMIENTOS</strong></td>
 </tr>
 <tr>
   <td colspan="5"><?php echo "$tipo_lente"; ?></td>
   <td colspan="5"><?php echo "$trat_orden"; ?></td>
   <td colspan="10"></td>
 </tr>
<tr>
  <th colspan="50" style="font-size:12px;border:#0061a9 1px solid;color:black;font-family: Helvetica, Arial, sans-serif;width:100%"><span class="subt">GRADUACIÓN (RX FINAL) Y MEDIDAS</span></th>
</tr>
<tr>
<td colspan="55" style="align-items:center">
<table class="table2" style="border-collapse: collapse;">
  <tr>
    <th colspan="5">OJO</th>
    <th colspan="10">ESFERAS</th>
    <th colspan="10">CILINDROS</th>
    <th colspan="10">EJE</th>
    <th colspan="10">ADICION</th>
    <th colspan="10">PRISMA</th>
  </tr>
  <tr>
    <td colspan="5">OD</td>
    <td colspan="10"><?php echo "$odesferas" ?></td>
    <td colspan="10"><?php echo "$odcindros" ?></td>
    <td colspan="10"><?php echo "$odeje" ?></td>
    <td colspan="10"><?php echo "$odadicion" ?></td>
    <td colspan="10"><?php echo "$odprisma" ?></td>
  </tr>
  <tr>
    <td colspan="5">OI</td>
    <td colspan="10"><?php echo "$oiesferas" ?></td>
    <td colspan="10"><?php echo "$oicindros" ?></td>
    <td colspan="10"><?php echo "$oieje" ?></td>
    <td colspan="10"><?php echo "$oiadicion" ?></td>
    <td colspan="10"><?php echo "$oiprisma" ?></td>
  </tr>
</table>
</td>
<td colspan="2">
<table id="table2">
  <tr>
    <th>OJO</th>
    <th>DIST. PUPILAR</th>
    <th>ALT. PUPILAR</th>
    <th>ALT. DE OBLEA</th>
  </tr>
  <tr>
    <td>OD</td>
    <td><?php echo $od_dist_pupilar ?></td>
    <td><?php echo $od_altura_pupilar ?></td>
    <td><?php echo $od_altura_oblea ?></td>
  </tr>
  <tr>
    <td>OI</td>
    <td><?php echo $oi_dist_pupilar ?></td>
    <td><?php echo $oi_altura_pupilar ?></td>
    <td><?php echo $oi_altura_oblea ?></td>
  </tr>
</table>
</td>
</tr>
<tr>
  <th colspan="4" style="font-size:12px;border:#0061a9 1px solid;color:black;font-family: Helvetica, Arial, sans-serif;width:100%"><span class="subt">ESPECIFICACIONES DE ARO</span></th>
  <th></th>
  <th></th>
  <th></th>
</tr>
<tr>
  <td><strong>MARCA</strong></td>
  <td><strong>MODELO</strong></td>
  <td><strong>COLOR</strong></td>
  <td><strong>DISEÑO</strong></td>
</tr>
<tr>
  <td><?php echo $marca ?></td>
  <td><?php echo $modelo ?></td>
  <td><?php echo $color ?></td>
  <td><?php echo $diseno ?></td>
</tr>
<tr>
  <th colspan="4" style="font-size:12px;border:#0061a9 1px solid;color:black;font-family: Helvetica, Arial, sans-serif;width:100%; text-align:left;"><span class="subt">OBSERVACIONES:</span> <?php echo $observaciones; ?></th>
</tr>