<?php
session_start();
include '../includes/config.php';

// Handle deletion of selected vehicles
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vehicle_ids'])) {
    $vehicle_ids = $_POST['vehicle_ids'];
    $ids_to_delete = implode(',', array_map('intval', $vehicle_ids)); // Ensure IDs are safe to use
    $delete_query = "DELETE FROM cars WHERE car_id IN ($ids_to_delete)";
    $result = $conn->query($delete_query);
    
    if ($result === TRUE) {
        echo "<script type=\"text/javascript\">
                alert(\"Selected vehicles deleted successfully.\");
                window.location = \"add_vehicles.php\";
              </script>";
    } else {
        echo "<script type=\"text/javascript\">
                alert(\"Error deleting vehicles: " . $conn->error . "\");
              </script>";
    }
}
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Admin Home</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        #header {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        #header h1 {
            margin: 0;
            font-size: 36px;
            color: #fff;
        }

        #top-navigation {
            text-align: right;
            background-color: #000;
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
            background-color: #000;
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
            background-color: #000;
        }
        #navigation ul li a:hover {
            background-color: #444;
            color: #fff;
        }

        #container {
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            flex: 1;
        }

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

        .pagging {
            display: none;
        }

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
            background-color: #000;
        }
        .box-content a:hover {
            background-color: #444;
            color: #fff;
        }

        #footer {
            background-color: #000;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        #footer .shell {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #footer .footer-text {
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            margin: 0;
        }
        
        .form p {
            margin-bottom: 15px;
        }
        .form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form input[type="text"],
        .form input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .buttons {
            text-align: right;
        }
        .buttons input[type="submit"] {
            background-color: #000;
            color: #fff;
            border: 1px solid #000;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .buttons input[type="submit"]:hover {
            background-color: #444;
        }
    </style>
    <script type="text/javascript">
        function sureToApprove(id){
            if(confirm("Are you sure you want to delete this car?")){
                window.location.href ='delete_car.php?id='+id;
            }
        }
        function toggle(source) {
            checkboxes = document.getElementsByName('vehicle_ids[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
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
        <li><a href="client_requests.php"><span>Rent requests</span></a></li>
        <li><a href="profile_settings.php"><span>Update Profile</span></a></li>
        <li><a href="logout.php"><span>Log Out</span></a></li>
    </ul>
</div>

<!-- Container -->
<div id="container">
    <div class="shell">
        <div class="small-nav">
            <!-- Optional Navigation -->
        </div>
        <br />
        <div id="main">
            <div class="cl">&nbsp;</div>
            <div id="content">
                <div class="box">
                    <div class="box-head">
                        <h2 class="left">Our Vehicles</h2>
                        <div class="right">
                            <!-- Optional Right Section -->
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table">
                        <form method="post">
                            <table>
                                <tr>
                                    <th width="13"><input type="checkbox" id="select-all" onclick="toggle(this);" /></th>
                                    <th>Vehicle Make</th>
                                    <th>Vehicle Type</th>
                                    <th>Cost</th>
                                </tr>
                                <?php
                                $select = "SELECT * FROM cars WHERE status = 'Available'";
                                $result = $conn->query($select);
                                while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="vehicle_ids[]" value="<?php echo $row['car_id']; ?>" /></td>
                                    <td><?php echo $row['car_name']; ?></td>
                                    <td><?php echo $row['car_type']; ?></td>
                                    <td><?php echo $row['hire_cost']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                            <div class="buttons">
                                <input type="submit" name="delete_selected" value="Delete Selected" />
                                <a href="add_cars.php" class="add-car-button" style="padding: 10px 20px; background-color: #000; color: #fff; border-radius: 4px; text-decoration: none;">Add Car</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div id="footer">
   
</div>
</body>
</html>
