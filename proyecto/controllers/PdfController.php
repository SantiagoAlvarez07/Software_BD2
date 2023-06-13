<?php
require 'js/vendor/autoload.php'; // Ruta al archivo autoload.php generado por Composer

use Fpdf\Fpdf;

class PdfController {
    public function generateUsersPdf($array_user) 
    {
        // Crear una instancia de FPDF
        $pdf = new Fpdf();

        // Agregar una página al PDF
        $pdf->AddPage();

        // Establecer la fuente y el tamaño de la fuente
        $pdf->SetFont('Arial', 'B', 12);

        // Encabezados de columna
        $pdf->Cell(40, 10, 'ID Usuario', 1);
        $pdf->Cell(40, 10, 'Documento', 1);
        $pdf->Cell(40, 10, 'Nombre', 1);
        $pdf->Cell(40, 10, 'Estado', 1);
        $pdf->Cell(40, 10, 'Cargo', 1);
        $pdf->Ln();

        // Recorrer los datos de la tabla y agregar filas al PDF
        foreach ($array_user as $user) {
            $id_user = $user->id_user;
            $document_user = $user->document_user;
            $name_user = $user->name_user . " " . $user->last_name_user;
            $stade_user = $user->state_user;

            if ($stade_user == 'Y') {
                $stade_user = 'Activo';
            } else {
                $stade_user = 'Inactivo';
            }

            $id_role_user = $user->id_role_user;
            if ($id_role_user == '1') {
                $id_role_user = 'Administrador';
            } else {
                $id_role_user = 'Secretaria';
            }

            $pdf->Cell(40, 10, $id_user, 1);
            $pdf->Cell(40, 10, $document_user, 1);
            $pdf->Cell(40, 10, $name_user, 1);
            $pdf->Cell(40, 10, $stade_user, 1);
            $pdf->Cell(40, 10, $id_role_user, 1);
            $pdf->Ln();
        }

        // Generar el archivo PDF
        $pdf->Output('usuarios.pdf', 'D');
    }
}

// Obtener los datos de la tabla enviados desde la vista
$tableData = $_POST['tableData'];

// Crear una instancia de PdfController y llamar al método generateUsersPdf()
$pdfController = new PdfController();
$pdfController->generateUsersPdf($tableData);
?>
