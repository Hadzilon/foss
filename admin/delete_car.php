<?php
include '../includes/config.php';

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['vehicle_ids'])) {
    $ids = $_POST['vehicle_ids'];
    
    // Prepare a string of placeholders for the prepared statement
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $query = "DELETE FROM cars WHERE car_id IN ($placeholders)";

    // Prepare the statement
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        // Bind parameters (assuming car_id is an integer)
        $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
        
        // Execute the statement
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            echo "<script type='text/javascript'>
                    alert('Selected cars successfully deleted.');
                    window.location = 'add_vehicles.php';
                  </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('No cars were deleted. Please ensure the IDs are correct.');
                    window.location = 'add_vehicles.php';
                  </script>";
        }
        $stmt->close();
    } else {
        // If statement preparation failed, output the error
        echo "Error preparing statement: " . $conn->error; // Debugging line
    }
} else {
    // If no cars were selected, redirect back with an alert
    echo "<script type='text/javascript'>
            alert('No cars selected.');
            window.location = 'add_vehicles.php';
          </script>";
}

// Close the database connection
$conn->close();
?>

