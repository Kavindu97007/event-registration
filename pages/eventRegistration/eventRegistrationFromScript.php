<?php

// Contains reusable logic (e.g., email validation, file upload)

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL); // FILTER_VALIDATE_EMAIL checks whether the given string conforms to the format of a valid email address. It ensures the email address includes a valid username, an @ symbol, and a valid domain name with a domain extension.
}

// Handle file upload
function handleFileUpload($file, $nic) {

    // Define the directory where files will be uploaded
    $uploadDirectory = "../../uploads/"; // correct path relative to the script location

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf']; //allowed fomats

    // Get the temporary file path, original file name, and file size from the uploaded file
    $fileTemporaryPath = $file['tmp_name'];
    $fileName = $file['name'];
    $fileSize = $file['size'];

    // Extract and convert the file extension to lowercase for validation
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file extension is in the allowed list
    if (!in_array($fileExtension, $allowedExtensions)) {
        return ["success" => false, "message" => "Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed."];
    }

    // Check if the file size exceeds the 10MB limit
    if ($fileSize > 10 * 1024 * 1024) { // 10MB limit
        return ["success" => false, "message" => "File size exceeds 10MB. Please upload a smaller file."];
    }

    $newFileName = $nic . "_attachment." . $fileExtension; // naming the file with nicprefix
    
    // Determine the full destination path for the file
    $destinationPath = $uploadDirectory . $newFileName;

    // Move the uploaded file to the specified destination
    if (move_uploaded_file($fileTemporaryPath, $destinationPath)) {

        // Return success and the file path if the file was moved successfully
        return ["success" => true, "path" => $destinationPath];

    } else {
        echo "Destination path: " . $destinationPath;
        // Return failure message if the file could not be moved
        return ["success" => false, "message" => "Error moving the uploaded file."];
    }
}
?>
