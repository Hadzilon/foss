<?php
// approve.php
include '../includes/config.php'; // Ensure this includes your database connection setup

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hire_id'])) {
    $hire_id = $_POST['hire_id'];
    $sql = "UPDATE hire SET status = 'Approved' WHERE hire_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $hire_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
?>
