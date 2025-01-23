<?php
include '../../database/database.php';
include 'eventRegistrationFromScript.php';


// Check if the request method is POST
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
        die("The email address '$email' is invalid."); // Stop execution if email is invalid
    }

    // Handle file upload
    $uploadResult = handleFileUpload($file, $nic);
    if (!$uploadResult['success']) {
        die($uploadResult['message']); // Stop execution if file upload fails
    }

    // Insert data into database
    $sql = "INSERT INTO registrations (full_name, email, phone_number, event_name, nic_number, nic_attachment) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssssss", $fullName, $email, $phone, $eventName, $nic, $uploadResult['path']);
        
        if ($stmt->execute()) {
            echo "<div style='font-family: Arial, sans-serif; font-size: 16px; color: green;'>
                    You have successfully submitted your data! 
                    <a href='../home/home.php' style='color: blue; text-decoration: underline;'>Click here to return to the home page.</a>
                  </div>";
        } else {
            die("Error inserting data: " . $stmt->error); // Error message if the SQL execution fails
        }

        $stmt->close(); // Close the prepared statement
    } else {
        die("Error preparing statement: " . $conn->error); // Error message if the statement preparation fails
    }
}
?>
