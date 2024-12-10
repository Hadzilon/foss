<?php
include '../includes/config.php';

if (isset($_POST['selected_cars'])) {
    foreach ($_POST['selected_cars'] as $car_id) {
        $car_id = intval($car_id);
        $delete_query = "DELETE FROM cars WHERE car_id = $car_id";
        $conn->query($delete_query);
    }
}

header("Location: index.php");
exit();
?>

