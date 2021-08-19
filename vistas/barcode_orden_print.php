<?php ob_start();
use Dompdf\Dompdf;
//use Dompdf\Options;

require_once '../dompdf/autoload.inc.php';

$paciente = $_POST["paciente"];
$optica = "La Realeza";
$codigo = $_POST["codigo"];//$_POST["codigoOrden"];
date_default_timezone_set('America/El_Salvador'); 
$hoy = date("d-m-Y H:i:s");

require "vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
$code = $Bar->getBarcode($codigo, $Bar::TYPE_CODE_128,'2','50');
?>
<html lang="en" dir="ltr">
  <head>
   <style>
      @page { margin-top: 5px; } 
   </style>
   <script>
     function imprimir() {
        window.print();
    }
   </script>
  </head>

  <body onload="imprimir();">

    <div style="text-align: center; font-size: 10px;">
      <div id="qrbox">
        <div style="margin: 0px;">
        <span style="font-size: 18px"><b>LENTI</b></span><br>
        <span style="font-size: 15px"><b>PACIENTE: </b><?php echo $paciente;?></span><br>
        <span style="font-size: 15px"><B>OPTICA: </B><?php echo $optica;?></span>
        </div>
        <?php echo $code;?> 
        <div style="font-size:18px"><?php echo $codigo;?><br>
        <span style="font-size: 18px">lentitulaboratorio.com</span>
        </div>
      </div>
    </div>

</body>
</html>
<?php

$salida_html = ob_get_contents();
  //$user=$_SESSION["id_usuario"];
ob_end_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($salida_html);
$dompdf->setPaper('tabloid', 'portrait');
// (Optional) Setup the paper size and orientation
$dompdf->setPaper(array(0,0,220,210));

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();
$dompdf->stream('document', array('Attachment'=>'0'));
?>

