<?php
if (isset($_POST['tableData'])) {
    $tableData = $_POST['tableData'];

    // Crear el archivo PDF
    require 'vendor/autoload.php'; // Ruta al archivo autoload.php generado por Composer

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();
    $dompdf->loadHtml($tableData);
    $dompdf->setPaper('A4');
    $dompdf->render();

    $dompdf->stream('usuarios.pdf');
}
?>
