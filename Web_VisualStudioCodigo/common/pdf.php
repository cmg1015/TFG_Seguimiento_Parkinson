<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
    <?php
        $python_result=exec("python /xampp/htdocs/Web_VisualStudio_paraDescargar/Web_VisualStudio/common/pdf.py");

        $archivo = "Informe_medico.pdf";

        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=" . urlencode($archivo));
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
        header("Content-Length: " . filesize($archivo));
        
        ob_clean();
        flush();
        readfile($archivo);        
    ?>
</body>
</html>