<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Form</title>
    <link rel="stylesheet" href="eventRegistrationForm.css"> <!-- Link to external CSS -->
    
</head>
<body>


    <div class="event-form-container">
        <h2>Event Registration Form</h2>
        
        <form action="eventRegistrationProcess.php" method="post" enctype="multipart/form-data">

            <!-- Add "required" to check empty fields -->

            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required> 

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>

            <label for="eventName">Event Name:</label>
            <input type="text" id="eventName" name="eventName" required>

            <label for="nic">NIC Number:</label>
            <input type="text" id="nic" name="nic" required>

            <label for="nicAttachment">NIC Attachment (max 10MB):</label>
            <input type="file" id="nicAttachment" name="nicAttachment" accept=".jpg,.jpeg,.png,.pdf" required>

            <button type="submit">Register for Event</button>
        </form>
    </div>
</body>
</html>
