<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if (!isset($_SESSION['uname']) || !isset($_SESSION['pass'])) {
    header("Location: ../login.php");
    exit(); // Ensure no further code is executed after redirection
}

include '../includes/config.php'; // Ensure to include the database configuration

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $current_username = $_SESSION['uname'];

    // Update the username and/or password
    if (!empty($username) && $username !== $current_username) {
        $update_username = $conn->prepare("UPDATE admin SET uname = ? WHERE uname = ?");
        $update_username->bind_param("ss", $username, $current_username);
        $update_username->execute();
        $_SESSION['uname'] = $username; // Update session variable
    }

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash the new password
        $update_password = $conn->prepare("UPDATE admin SET pass = ? WHERE uname = ?");
        $update_password->bind_param("ss", $hashed_password, $username);
        $update_password->execute();
    }

    echo "<script>alert('Profile updated successfully'); window.location.href='profile_settings.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>update profile</title>
    <style>
    /* Base Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #000;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Ensure body takes at least the full height of the viewport */
}

/* Header */
#header {
    background-color: #000; /* Black background */
    color: #fff;
    padding: 20px 0;
    text-align: center; /* Keep the title centered */
}

#header h1 {
    margin: 0;
    font-size: 36px;
    color: #fff;
}

/* Navigation */
#navigation {
    background-color: #000; /* Black background */
}

#navigation ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: flex-start; /* Align items to the left */
}

#navigation ul li {
    margin-right: 20px;
}

#navigation ul li a {
    color: #fff;
    padding: 10px 20px;
    display: block;
    border-radius: 4px;
    border: 1px solid #000;
    background-color: #000; /* Black background for buttons */
    text-decoration: none; /* Remove default underline */
}

#navigation ul li a:hover,
#navigation ul li a:active {
    background-color: #444; /* Darker background on hover */
    text-decoration: underline; /* Underline on hover */
    color: #fff; /* Ensure text remains white on hover */
}

/* Content */
#content {
    padding: 20px;
    background-color: #fff;
    border-top: 1px solid #ddd;
    flex: 1; /* Allow content to grow and push footer to the bottom */
}

#content h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Form */
form {
    max-width: 600px;
    margin: 0 auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table td {
    padding: 10px;
    border: 1px solid #ddd;
}

table input[type="text"],
table input[type="password"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

table input[type="submit"] {
    background-color: #000; /* Black background */
    color: #fff; /* White text */
    border: 1px solid #000;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
}

table input[type="submit"]:hover {
    background-color: #444; /* Darker background on hover */
}

/* Footer */
#footer {
    background-color: #000; /* Black background */
    color: #fff;
    padding: 10px 0; /* Adjusted padding */
    text-align: center;
}

#footer .shell {
    display: flex;
    justify-content: center;
    align-items: center;
}

#footer .footer-text {
    font-size: 14px; /* Smaller font size */
    font-weight: bold; /* Bold text */
    color: #fff; /* White color */
    margin: 0;
}

    </style>
</head>
<body>
    <div id="header">
        <div class="shell">
            <h1>Riva Auto</h1>
        </div>
    </div>

    <div id="navigation">
        <ul>
            <li><a href="index.php"><span>Messages</span></a></li>
            <li><a href="add_vehicles.php"><span>Vehicle Management</span></a></li>
            <li><a href="client_requests.php"><span>Rent Requests</span></a></li>
            <li><a href="profile_settings.php"><span>update profile</span></a></li>
            <li><a href="logout.php"><span>Log Out</span></a></li>
        </ul>
    </div>

    <div id="content">
        <h2>update profile</h2>
        <form method="post" action="profile_settings.php">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo htmlspecialchars($_SESSION['uname']); ?>" required></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right"><input type="submit" value="Update Profile"></td>
                </tr>
            </table>
        </form>
    </div>

    <div id="footer">
        <div class="shell">
            
        </div>
    </div>
</body>
</html>
