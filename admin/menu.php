<?php
session_start();
ob_start(); // Start output buffering
error_reporting(E_ALL & ~E_NOTICE);

if (!isset($_SESSION['uname']) || !isset($_SESSION['pass'])) {
    header("Location: ../login.php");
    exit(); // Ensure no further code is executed after redirection
}

ob_end_flush(); // Flush the output buffer and send output to the browser
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Menu</title>
   
</head>
<body>
    <div id="top">
        <h1><a href="#">riva auto</a></h1>
        <div id="top-navigation">
            Welcome <a href="#"><strong><?php echo htmlspecialchars($_SESSION['uname'], ENT_QUOTES, 'UTF-8'); ?></strong></a>
            <span>|</span>
            <a href="#"></a>
            <span>|</span>
            <a href="profile_settings.php"></a>
            <span>|</span>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <div id="navigation">
        <ul>
            <li><a href="index.php"><span>Dashboard</span></a></li>
            <li><a href="add_vehicles.php"><span>Vehicle Management</span></a></li>
            <li><a href="client_requests.php"><span>rent requests</span></a></li>
            <li><a href="index.php"><span>Messages</span></a></li>
            <li><a href="#"><span>Services Control</span></a></li>
        </ul>
    </div>
</body>
</html>
