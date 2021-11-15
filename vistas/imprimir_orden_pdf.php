<?php ob_start();
use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../dompdf/autoload.inc.php';
require_once ('../config/conexion.php');
require_once ('../modelos/Reporteria.php');

$reporteria = new Reporteria();


///DETALLES DE ORDEN*
$datos_orden = $reporteria->get_datos_orden($_POST['codigo']);
$datos_rxfinal = $reporteria->get_orden_rxfinal($_POST["codigo"]);
$datos_alturas = $reporteria->get_alturas_orden($_POST["codigo"]);
$datos_aros = $reporteria->get_det_aros_orden($_POST["codigo"]);
//print_r($datos_alturas);exit();
foreach ($datos_orden as $v){
	$paciente = $v["paciente"];
	$tipo_lente = $v["tipo_lente"];
	$trat_orden = $v["trat_orden"];
	$codigo = $v["codigo"];
  $optica = $v["optica"];
  $sucursal = $v["sucursal"];
  $tipo_lente = $v["tipo_lente"];
  $trat_orden = $v["trat_orden"];
  $observaciones = $v["observaciones"];
}
foreach ($datos_rxfinal as $rx) {
  $odesferas = $rx["odesferas"];
  $odcindros = $rx["odcindros"];
  $odeje = $rx["odeje"];
  $odadicion = $rx["odadicion"];
  $odprisma = $rx["odprisma"];
  $oiesferas = $rx["oiesferas"];
  $oicindros = $rx["oicindros"];
  $oieje = $rx["oieje"];
  $oiadicion = $rx["oiadicion"];
  $oiprisma = $rx["oiprisma"];
}
foreach ($datos_alturas as $a) {
  $od_dist_pupilar = $a["od_dist_pupilar"];
  $od_altura_pupilar = $a["od_altura_pupilar"];
  $od_altura_oblea = $a["od_altura_oblea"];
  $oi_dist_pupilar = $a["oi_dist_pupilar"];
  $oi_altura_pupilar = $a["oi_altura_pupilar"];
  $oi_altura_oblea = $a["oi_altura_oblea"];
}
foreach ($datos_aros as $aros) {
  $marca = $aros["marca"];
  $modelo = $aros["modelo"];
  $color = $aros["color"];
  $diseno = $aros["diseno"];
}
?>


<html>
<head>
<link rel="stylesheet" href="../estilos/styles.css">
<meta charset="utf-8">	

</head>
<body>
  <table class="table2 stilot1 " style="margin:5px; width:100%;border-collapse: collapse;">
  <tr>
    <th colspan="50" class="encabezado" style="text-align:center; font-size:16px width=100% ;font-family: Helvetica, Arial, sans-serif;"><strong>ORDEN NÚMERO: <?php echo $codigo; ?></strong> 
    </th>
  </tr>
  <tr>
    <td colspan="26"><strong>PACIENTE</strong></td>
    <td colspan="12"><strong>ÓPTICA</strong></td>
    <td colspan="12"><strong>SUCURSAL</strong></td>
  </tr>
  <tr>
    <td colspan="26"><?php echo $paciente; ?></td>
    <td colspan="12"><?php echo $optica; ?></td>
    <td colspan="12"><?php echo $sucursal; ?></td>
  </tr>
  <tr>
    <th colspan="50"><span class="subt">ESPECIFICACIONES DE LENTE</span></th>
  </tr>
  <tr>
    <td colspan="13"><strong>LENTE</strong></td>
    <td colspan="13"><strong>MARCA</strong></td>
    <td colspan="24"><strong>TRATAMIENTOS</strong></td>
  </tr>
  <tr>
    <td colspan="13"><?php echo $tipo_lente; ?></td>
    <td colspan="13"><?php echo $trat_orden; ?></td>
    <td colspan="24"></td>
  </tr>
  <tr>
  <th colspan="50"><span class="subt">GRADUACIÓN (RX FINAL) Y MEDIDAS</span></th>
  </tr>
  <tr>
    <td colspan="25" style="align-items:center; width: 100%;">
     <table class="table3">
       <tr>
         <th colspan="10">OJO</th>
         <th colspan="18">ESFERAS</th>
         <th colspan="18">CILINDROS</th>
         <th colspan="18">EJE</th>
         <th colspan="18">ADICIÓN</th>
         <th colspan="18">PRISMA</th>
       </tr>
       <tr>
         <td colspan="10">OD</td>
         <td colspan="18"><?php echo $odesferas ?></td>
         <td colspan="18"><?php echo $odcindros ?></td>
         <td colspan="18"><?php echo $odeje ?></td
         <td colspan="18"><?php echo $odadicion ?></td>
         <td colspan="18"><?php echo $odprisma ?></td>
       </tr>
       <tr>
         <td colspan="10">OI</td>
         <td colspan="18"><?php echo $oiesferas ?></td>
         <td colspan="18"><?php echo $oicindros ?></td>
         <td colspan="18"><?php echo $oieje ?></td>
         <td colspan="18"><?php echo $oiadicion ?></td>
         <td colspan="18"><?php echo $oiprisma ?></td>
       </tr>
     </table>
    </td>
    <td colspan="25" style="align-items:center; width: 100%;">
      <table class="table3">
       <tr>
         <th colspan="10">OJO</th>
         <th colspan="20">DIST. PUPILAR</th>
         <th colspan="20">ALT. PUPILAR</th>
         <th colspan="20">ALT. OBLEA</th>
       </tr>
       <tr>
         <td colspan="10"><strong>OD</strong></td>
         <td colspan="20"><?php echo $od_dist_pupilar?></td>
         <td colspan="20"><?php echo $od_altura_pupilar?></td>
         <td colspan="20"><?php echo $od_altura_oblea?></td>
       </tr>
       <tr>
         <td colspan="10"><strong>OI</strong></td>
         <td colspan="20"><?php echo $oi_dist_pupilar?></td>
         <td colspan="20"><?php echo $oi_altura_pupilar?></td>
         <td colspan="20"><?php echo $oi_altura_oblea?></td>
       </tr>
     </table>
    </td>
   </tr>
   <tr>
    <th colspan="50"><span class="subt">ESPECIFICACIONES DE ARO</span></th> 
   </tr>
   <tr>
    <td colspan="13"><strong>MARCA</strong></td>
    <td colspan="13"><strong>MODELO</strong></td>
    <td colspan="12"><strong>COLOR</strong></td>
    <td colspan="12"><strong>DISEÑO</strong></td>
   </tr>
   <tr>
    <td colspan="13"><?php echo $marca ?></td>
    <td colspan="13"><?php echo $modelo ?></td>
    <td colspan="12"><?php echo $color ?></td>
    <td colspan="12"><?php echo $diseno ?></td>
   </tr>
   <tr>
    <th colspan="50" class="subt" style="text-align: left;"><span> OBSERVACIONES: <span style="color:#0431B4"><?php echo $observaciones;?></span></th> 
   </tr>
  </table>
</body>
</html>

<?php
$salida_html = ob_get_contents();
ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('document', array('Attachment'=>'0'));
?>