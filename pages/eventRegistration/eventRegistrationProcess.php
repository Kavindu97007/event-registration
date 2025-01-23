<?php
include '../../database/database.php';
include 'eventRegistrationFromScript.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $eventName = $_POST['eventName'];
    $nic = $_POST['nic'];
    $file = $_FILES['nicAttachment'];

    // Validate email
    if (!validateEmail($email)) {
        die("The email address '$email' is invalid.");
    }

    // Handle file upload
    $uploadResult = handleFileUpload($file, $nic);
    if (!$uploadResult['success']) {
        die($uploadResult['message']);
    }

    // Insert data into database
    $sql = "INSERT INTO registrations (full_name, email, phone_number, event_name, nic_number, nic_attachment) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $fullName, $email, $phone, $eventName, $nic, $uploadResult['path']);
        
        if ($stmt->execute()) {
            echo "You have successfully submitted your data! <a href='../home/home.php'>Click here to return to the home page.</a>";
        } else {
            die("Error inserting data: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Error preparing statement: " . $conn->error);
    }
}
?>
