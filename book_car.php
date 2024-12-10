<?php
include 'includes/config.php';
session_start();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save'])) {
    $fname = $_POST['fname'];
    $cne = $_POST['cne'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $days = $_POST['days'];

    // Fetch the car hire cost
    $car_id = $_GET['id'];
    $sel = "SELECT hire_cost FROM cars WHERE car_id = '$car_id'";
    $rs = $conn->query($sel);
    $car = $rs->fetch_assoc();
    $hire_cost = $car['hire_cost'];

    // Calculate total amount
    $total_amount = $hire_cost * $days;

    // Insert into hire table
    $qry = "INSERT INTO hire (car_id, status, customer_name, customer_phone, customer_email, customer_address, booking_date, number_of_days, total_amount)
            VALUES ('$car_id', 'Pending', '$fname', '$phone', '$email', '$location', NOW(), '$days', '$total_amount')";

    $result = $conn->query($qry);
    if ($result == TRUE) {
        echo "<script type=\"text/javascript\">
                alert(\"Successfully Registered. Proceed to pay\");
                window.location = (\"index.php\")
              </script>";
    } else {
        echo "<script type=\"text/javascript\">
                alert(\"Registration Failed. Try Again\");
                window.location = (\"book_car.php\")
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Car</title>
    <meta charset="utf-8">
    <meta name="author" content="pixelhint.com">
    <meta name="description" content="Book your dream car for hire"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <style>
    /* Reset default body margins and paddings */
    body {
        margin: 0; /* Remove default body margin */
        padding: 0; /* Remove default body padding */
    }

    /* Styling for the header matching main page */
    header {
        background-color: black;
        padding: 30px; /* Height of the header */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header a {
        color: white; /* Updated to white for contrast against black */
        text-decoration: none;
        font-weight: bold;
        padding: 0 10px;
    }

    header img {
        height: 60px; /* Adjusted logo height */
    }

    /* Styling for the form and car details */
    .form-container {
        max-width: 600px;
        padding: 20px;
        border: 2px solid #000;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h3 {
        color: #000;
        text-align: center;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="number"],
    .form-container select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container input[type="submit"] {
        background-color: #000;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
        background-color: #333;
    }

    .car-section {
        display: flex;
        justify-content: space-between;
    }

    .car-details {
        width: 45%;
        border: 2px solid #000;
        padding: 20px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .car-details img {
        width: 100%;
        height: auto;
        margin-bottom: 20px;
    }

    .car-details h1, .car-details h2 {
        color: #000;
    }

    .hire-section {
        width: 45%;
    }

    /* Footer matching main page */
    footer {
        background-color: #000;
        color: #fff;
        padding: 20px;
        text-align: center;
        border-top: 2px solid #fff;
    }

    footer a {
        color: #fff;
        text-decoration: none;
        padding: 0 10px;
    }

    footer a:hover {
        text-decoration: underline;
    }

    .footer-text {
        font-size: 12px;
    }
</style>

</head>
<body>

    <header>
        <a href="index.php">
            <img src="img/rivaauto.jpg" alt="riva automobiles"> <!-- Updated logo path -->
        </a>
        <nav>
            <a href="index.php">Home</a>
            <a href="admin_login.php">Admin Login</a>
            <a href="client_login.php">Client Login</a>
        </nav>
    </header>

    <section class="caption">
        <h2 class="caption" style="text-align: center">Cars For Hire</h2>
        <h3 class="properties" style="text-align: center">Dacia - Renault</h3>
    </section>

    <section class="listings">
        <div class="wrapper">
            <ul class="properties_list">
            <?php
                $sel = "SELECT * FROM cars WHERE car_id = '$_GET[id]'";
                $rs = $conn->query($sel);
                $rws = $rs->fetch_assoc();
            ?>
            <div class="car-section">
                <div class="car-details">
                    <img src="cars/<?php echo $rws['image'];?>" alt="<?php echo $rws['car_name']; ?>">
                    <h1>Car Make: <?php echo $rws['car_type'];?></h1>
                    <h2>Car Name/Model: <?php echo $rws['car_name'];?></h2>
                    <h2>Hire Cost: <?php echo 'dhs.'.$rws['hire_cost'];?></h2>
                </div>

                <div class="hire-section">
                    <h3>Proceed to Hire <?php echo $rws['car_name'];?>.</h3>
                    <?php if(!isset($_SESSION['email']) || !isset($_SESSION['pass'])) { ?>
                        <div class="form-container">
                            <h3>Book Your Car</h3>
                            <form method="post">
                                <table>
                                    <tr>
                                        <td>Full Name:</td>
                                        <td><input type="text" name="fname" required></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number:</td>
                                        <td><input type="text" name="phone" required></td>
                                    </tr>
                                    <tr>
                                        <td>Email Address:</td>
                                        <td><input type="email" name="email" required></td>
                                    </tr>
                                    <tr>
                                        <td>ID Number:</td>
                                        <td><input type="text" name="cne" required></td>
                                    </tr>
                                    <tr>
                                        <td>Gender:</td>
                                        <td>
                                            <select name="gender">
                                                <option>Select Gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Location:</td>
                                        <td><input type="text" name="location" required></td>
                                    </tr>
                                    <tr>
                                        <td>Number of Days:</td>
                                        <td><input type="number" name="days" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:right"><input type="submit" name="save" value="Submit Details"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    <?php } else { ?>
                        <a href="pay.php" style="display: block; text-align: center; background-color: #000; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 3px;">Click to Book</a>
                    <?php } ?>
                </div>
            </div>
            </ul>
        </div>
    </section>

    <footer>
        
    </footer>
</body>
</html>
