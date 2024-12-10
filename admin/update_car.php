<?php
include '../includes/config.php';

if (isset($_POST['car_id'])) {
    $car_id = intval($_POST['car_id']);
    $car_type = mysqli_real_escape_string($conn, $_POST['car_type']);
    $car_name = mysqli_real_escape_string($conn, $_POST['car_name']);
    $hire_cost = mysqli_real_escape_string($conn, $_POST['hire_cost']);

    $update_query = "UPDATE cars SET car_type = '$car_type', car_name = '$car_name', hire_cost = '$hire_cost' WHERE car_id = $car_id";
    $conn->query($update_query);
}

header("Location:add_vehicles.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Car</title>
    <style>
        /* CSS for the Update Car Form */
        .update-car-form {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .update-car-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .update-car-form .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .update-car-form .form-group label {
            width: 30%;
            font-weight: bold;
        }

        .update-car-form .form-group input,
        .update-car-form .form-group select {
            width: 65%;
        }

        .update-car-form .form-group input[type="submit"] {
            width: auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-car-form .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="update-car-form">
        <h2>Update Car Details</h2>
        <form method="POST" action="update_car.php">
            <div class="form-group">
                <label for="car_type">Car Type:</label>
                <input type="text" id="car_type" name="car_type" value="<?php echo $row['car_type']; ?>" required>
            </div>
            <div class="form-group">
                <label for="car_name">Car Name:</label>
                <input type="text" id="car_name" name="car_name" value="<?php echo $row['car_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="hire_cost">Hire Cost:</label>
                <input type="text" id="hire_cost" name="hire_cost" value="<?php echo $row['hire_cost']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Car">
            </div>
        </form>
    </div>
</body>
</html>
