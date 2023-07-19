<?php
// Replace the placeholders with your actual database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'troskie_fares';

// Create a new mysqli connection
$conn = new mysqli("localhost", "root", "", "troskie_fares");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Receive User Input
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $currentLocation = $_POST['currentLocation'];
    $destination = $_POST['destination'];

    // Step 2: Validate and Sanitize User Input (optional but recommended)
    // ... (Perform validation and sanitization if necessary)

    // Step 3: Execute SQL Query
    $sql = "SELECT Fare FROM trotro_fares
            WHERE (LOWER(From_Location) = LOWER(?) AND LOWER(To_Destination) = LOWER(?))
            OR (LOWER(From_Location) = LOWER(?) AND LOWER(To_Destination) = LOWER(?))";

    // Prepare the SQL query
    $stmt = $conn->prepare($sql);

    // Bind the user input values to the placeholders
    $stmt->bind_param("ssss", $currentLocation, $destination, $destination, $currentLocation);

    // Execute the query
    $stmt->execute();

    // Bind the result to a variable
    $stmt->bind_result($fare);

    // Fetch the fare value
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Step 5: Send Fare to Client
    $response = array('fare' => $fare);

    // Send the response back to the client as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

exit();
?>