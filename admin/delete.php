<?php
include '../includes/config.php'; // Ensure this includes your database connection setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if hire_id is set in the POST request
    if (isset($_POST['hire_id'])) {
        $hire_id = $_POST['hire_id'];

        // Prepare and execute the delete statement
        $sql = "DELETE FROM hire WHERE hire_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $hire_id);
        
        // Execute and check if deletion was successful
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Deletion failed.']);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'No hire ID specified.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Close the database connection
$conn->close();
?>
