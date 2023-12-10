<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_FILES['file']) {
    $file = $_FILES['file'];
    $uploadDirectory = 'PATH';
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $originalFileName = pathinfo($file['name'], PATHINFO_FILENAME);

    do {
        $randomString = generateRandomString();
        $newFileName = $originalFileName . '-' . $randomString . '.' . $fileExtension;
        $uploadFilePath = $uploadDirectory . $newFileName;
    } while (file_exists($uploadFilePath)); 

    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        $qrCodeURL = 'PATH';
        echo json_encode(array("success" => true, "filePath" => $qrCodeURL));
    } else {
        echo json_encode(array("success" => false, "message" => "Erreur lors du téléversement du fichier"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Aucun fichier trouvé"));
}
?>