<?php
session_start();
include '../includes/config.php'; // kt2akd lina bli lfile 3ando correct database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $car_name = $_POST["car_name"];
    $car_type = $_POST["car_type"];
    $hire_cost = $_POST["hire_cost"];
    $capacity = $_POST["capacity"];
    $image = $_FILES["image"]["name"];

    // Define target path for image upload
    $target_path = "../cars/" . basename($image);

    // Attempt to upload the image
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
        // Prepare SQL query
        $sql = "INSERT INTO cars (image, car_name, car_type, hire_cost, capacity, status) 
                VALUES ('$image', '$car_name', '$car_type', '$hire_cost', '$capacity', 'Available')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
                    alert('Vehicle Successfully Added');
                    window.location = 'add_vehicles.php';
                  </script>";
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Failed to upload image');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Vehicles</title>
    <style>
       /* Base Styles */
body {
    background-color: #fff;
    color: #000;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column; /* Stack elements vertically */
    min-height: 100vh; /* Ensure the body takes at least the full height of the viewport */
}

#container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex: 1; /* Allow the container to grow and fill available space */
}

#header, #footer {
    background-color: #000;
    color: #fff;
    padding: 20px;
    text-align: center;
}

h2 {
    color: #000;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"], input[type="file"], input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #000;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #000;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #333;
}

/* Footer */
#footer {
    margin-top: auto; /* Push footer to the bottom */
}

    </style>
</head>
<body>
    <div id="header">
        <h1>Add New Vehicles</h1>
    </div>

    <div id="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="car_name">Vehicle Name:</label>
            <input type="text" id="car_name" name="car_name" required />

            <label for="car_type">Vehicle Make:</label>
            <input type="text" id="car_type" name="car_type" required />

            <label for="hire_cost">Vehicle rent Price:</label>
            <input type="text" id="hire_cost" name="hire_cost" required />

            <label for="image">Vehicle Image:</label>
            <input type="file" id="image" name="image" required />

            <label for="capacity">Vehicle Capacity:</label>
            <input type="text" id="capacity" name="capacity" required />

            <input type="submit" value="Submit" name="send" />
        </form>
    </div>

    <div id="footer">
       
    </div>
</body>
</html>
