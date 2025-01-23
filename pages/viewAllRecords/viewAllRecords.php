<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Records</title>
    <link rel="stylesheet" href="viewAllRecords.css"> <!-- Include external CSS -->
</head>
<body>
    <h2>All Registered Attendees</h2>
    <?php
    // Include database connection
    include '../../database/database.php';

    // Fetch data from the registrations table
    $query = "SELECT * FROM registrations";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        // Create a table for displaying the records
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Full Name</th> <!-- Column header for Full Name -->
                    <th>Email</th>  <!-- Column header for Email -->
                    <th>Phone Number</th>
                    <th>Event Name</th>
                    <th>NIC Number</th>
                    <th>NIC Attachment</th>
                </tr>
              </thead>";
        echo "<tbody>";
        
        // Loop through each record in the result set
        while ($row = $result->fetch_assoc()) {
            // Display the record in a new table row
            echo "<tr>
                    <td>{$row['full_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['event_name']}</td>
                    <td>{$row['nic_number']}</td>
                    <td><a href='/Event_Registration/uploads/{$row['nic_attachment']}' target='_blank'>View Attachment</a></td>
                  </tr>";
        }

        echo "</tbody>";
        echo "</table>"; // Close the table

        // Display total attendee count
        $totalAttendees = $result->num_rows;
        echo "<p class='total-attendees'>Total Attendees: $totalAttendees</p>";
    } else {
        echo "<p>No records found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>

    <!-- Button to navigate back to the home page -->
    <a href="/Event_Registration/pages/home/home.php" class="home-btn">Back to Home</a>
</body>
</html>
