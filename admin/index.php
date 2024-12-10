<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

if (!isset($_SESSION['uname']) || !isset($_SESSION['pass'])) {
    header("Location: ../login.php");
    exit(); // Ensure no further code is executed after redirection
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Admin Home</title>
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
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Header */
        #header {
            background-color: #000; /* Black background */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        #header h1 {
            margin: 0;
            font-size: 36px; /* Larger font size */
            color: #fff; /* White color for the logo */
        }

        /* Navigation */
        #top-navigation {
            text-align: right;
            background: none; /* Remove background */
            padding: 0;
        }
        #top-navigation a {
            color: #fff;
            padding: 0 10px;
        }
        #top-navigation a:hover {
            text-decoration: underline;
        }
        #navigation {
            background-color: #000; /* Black background */
        }
        #navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
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
        }
        #navigation ul li a:hover {
            background-color: #444;
            color: #fff;
        }

        /* Container */
        #container {
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            flex: 1; /* Allow container to grow and push footer to the bottom */
        }

        /* Box */
        .box {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        .box-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .box-head h2 {
            margin: 0;
            font-size: 18px;
        }
        .box-content {
            padding: 10px 0;
        }

        /* Table */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
            color: #000;
        }
        .table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .table tr:hover {
            background-color: #f1f1f1;
        }
        .table .ico {
            color: #333;
            text-decoration: none;
            padding: 5px;
        }
        .table .ico.del {
            color: red;
        }
        .table .ico.edit {
            color: green;
        }

        /* Remove the Pagination */
        .pagging {
            display: none; /* Hide pagination controls */
        }

        /* Sidebar */
        #sidebar {
            margin-top: 20px;
        }
        .box-content p {
            margin: 10px 0;
        }
        .box-content a {
            color: #fff;
            padding: 5px 10px;
            display: inline-block;
            border: 1px solid #000;
            border-radius: 4px;
            background-color: #000; /* Black background for buttons */
        }
        .box-content a:hover {
            background-color: #444;
            color: #fff;
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
        /* Print Button */
        .box h2 input[type="submit"] {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            border: 1px solid #000;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .box h2 input[type="submit"]:hover {
            background-color: #444; /* Darker background on hover */
        }
    </style>
    <script type="text/javascript">
        function sureToApprove(id) {
            if (confirm("Are you sure you want to approve this request?")) {
                fetch('approve.php?id=' + id)
                    .then(response => response.text())
                    .then(data => {
                        alert('Request approved successfully!');
                        location.reload();
                    })
                    .catch(error => alert('Error: ' + error));
            }
        }

        function sureToDelete(id) {
            if (confirm("Are you sure you want to delete this message?")) {
                fetch('delete_msg.php?id=' + id)
                    .then(response => response.text())
                    .then(data => {
                        alert('Message deleted successfully!');
                        location.reload();
                    })
                    .catch(error => alert('Error: ' + error));
            }
        }
    </script>
</head>
<body>
<!-- Header -->
<div id="header">
    <div class="shell">
        <h1>Riva Auto</h1>
    </div>
</div>

<div id="navigation">
    <ul>
        <li><a href="index.php"><span>Messages</span></a></li>
        <li><a href="add_vehicles.php"><span>Vehicle Management</span></a></li>
        <li><a href="client_requests.php"><span>rent requests</span></a></li>
        <li><a href="profile_settings.php"><span>update profile</span></a></li>
        <li><a href="logout.php"><span>Log Out</span></a></li>
    </ul>
</div>

<div id="container">
    <div class="shell">
        <div class="small-nav">
          
        </div>

        <br />

        <div id="main">
            <div class="cl">&nbsp;</div>
            
            <div id="content">
                <div class="box">
                    <!-- Box Head -->
                    <div class="box-head">
                        <h2 class="left">Client Messages</h2>
                    </div>
                    
                    <div class="table">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th>Message Content</th>
                                <th>Time Send</th>
                                <th>Status</th>
                                <th width="110" class="ac">Content Control</th>
                            </tr>
                            <?php
                                include '../includes/config.php';
                                $select = "SELECT * FROM message";
                                $result = $conn->query($select);
                                while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <td><h3><a href="#"><?php echo $row['message'] ?></a></h3></td>
                                <td><?php echo $row['time'] ?></td>
                                <td><a href="#"><?php echo $row['status'] ?></a></td>
                                <td>
                                    <a href="javascript:sureToApprove(<?php echo $row['msg_id'];?>)" class="ico del">Approve</a>
                                    <a href="javascript:sureToDelete(<?php echo $row['msg_id'];?>)" class="ico edit">Delete</a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div id="footer">
    <div class="shell">
    </div>
</div>

</body>
</html>
