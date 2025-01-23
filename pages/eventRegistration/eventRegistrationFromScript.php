<?php

// Contains reusable logic (e.g., email validation, file upload)

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL); // FILTER_VALIDATE_EMAIL checks whether the given string conforms to the format of a valid email address. It ensures the email address includes a valid username, an @ symbol, and a valid domain name with a domain extension.
}

// Handle file upload
function handleFileUpload($file, $nic) {
    $uploadDir = "../../uploads/"; // correct path relative to the script location
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf']; //allowed fomats
    $fileTmpPath = $file['tmp_name'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        return ["success" => false, "message" => "Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed."];
    }

    if ($fileSize > 10 * 1024 * 1024) { // 10MB limit
        return ["success" => false, "message" => "File size exceeds 10MB. Please upload a smaller file."];
    }

    $newFileName = $nic . "_attachment." . $fileExtension; // naming the file with nicprefix
    $destPath = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        return ["success" => true, "path" => $destPath];
    } else {
        echo "Destination path: " . $destPath;
        return ["success" => false, "message" => "Error moving the uploaded file."];
    }
}
?>
