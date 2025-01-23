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
    try {
        $stmt = $conn->prepare("INSERT INTO registrations (full_name, email, phone_number, event_name, nic_number, nic_attachment) 
                                VALUES (:full_name, :email, :phone_number, :event_name, :nic_number, :nic_attachment)");
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone);
        $stmt->bindParam(':event_name', $eventName);
        $stmt->bindParam(':nic_number', $nic);
        $stmt->bindParam(':nic_attachment', $uploadResult['path']);
        $stmt->execute();

        echo "You have successfully submitted your data! <a href='../home/home.php'>Click here to return to the home page.</a>";
    } catch (PDOException $e) {
        die("Error inserting data: " . $e->getMessage());
    }
}
?>
