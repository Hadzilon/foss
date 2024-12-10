<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your database password
    $dbname = "cars"; // Your database name

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize the form input
    $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : '';

    // Insert the message into the database
    $sql = "INSERT INTO message (message) VALUES ('$message')"; // Adjust table and column names as needed

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php
        header('Location: index.php');
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leave a Message</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .message-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #fff;
        }

        .wrapper {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }

        form {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #000099;
            font-weight: bold;
            text-decoration: underline;
            text-align: center;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            min-height: 150px;
        }

        input[type="submit"] {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <section class="message-section">
        <div class="wrapper">
            <form method="post" action="">
                <h3>Leave a Message</h3>
                <textarea name="message" placeholder="Enter your message here..." required></textarea>
                <input type="submit" name="submit" value="Submit Message">
            </form>
        </div>
    </section>
</body>
</html>
