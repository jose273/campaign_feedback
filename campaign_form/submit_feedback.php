<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $rating = (int) $_POST['rating'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'campaign_feedback');

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

 
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback, rating) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("sssi", $name, $email, $feedback, $rating);

    // Execute and check
    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
