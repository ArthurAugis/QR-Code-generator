<?php
$downloadDirectory = 'PATH';

if (isset($_GET['url'])) {
    $fileName = $_GET['url'];
    $filePath = $downloadDirectory . basename($fileName);

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        http_response_code(404); 
        echo 'Fichier non trouvé.';
    }
} else {
    http_response_code(400);
    echo 'Paramètre de fichier manquant.';
}
?>
