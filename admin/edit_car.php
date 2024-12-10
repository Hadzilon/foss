<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit Car</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<?php
include '../includes/config.php';

if (isset($_GET['id'])) {
    $car_id = intval($_GET['id']);
    $query = "SELECT * FROM cars WHERE car_id = $car_id";
    $result = $conn->query($query);
    $car = $result->fetch_assoc();
}
?>

<form method="post" action="update_car.php">
    <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>" />
    <label>Car Type:</label>
    <input type="text" name="car_type" value="<?php echo $car['car_type']; ?>" />
    <label>Car Name:</label>
    <input type="text" name="car_name" value="<?php echo $car['car_name']; ?>" />
    <label>Hire Price:</label>
    <input type="text" name="hire_cost" value="<?php echo $car['hire_cost']; ?>" />
    <input type="submit" value="Update Car" />
</form>

<a href="index.php">Back to Vehicle Management</a>

</body>
</html>
