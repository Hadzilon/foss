<?php
// Database connection
include '../includes/config.php'; // Ensure this includes your database connection setup

// Initialize result variable
$result = null;

// Query to fetch booking data including the status
$sql = "SELECT hire_id, client_id, car_id, status, customer_name, customer_phone, customer_email, customer_address, booking_date, number_of_days, total_amount FROM hire";
$result = mysqli_query($conn, $sql);

// Check for query errors
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Requests</title>
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

        /* Header */
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

        /* Navigation */
        #navigation {
            background-color: #000;
        }
        #navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-start;
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

        /* Container */
        #container {
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            flex: 1;
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
            color: #000;
        }
        .table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .table tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        .ico {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid transparent;
            cursor: pointer;
            display: inline-block;
            margin: 2px; /* Add some margin between buttons */
        }
        .ico.approve {
            background-color: #28a745; 
        }
        .ico.approve:hover {
            background-color: #218838; 
        }
        .ico.delete {
            background-color: #dc3545; 
        }
        .ico.delete:hover {
            background-color: #c82333; 
        }
        /* Footer */
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
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Approve action
            $('.approve').on('click', function(e) {
                e.preventDefault();
                var hireId = $(this).data('id');
                var row = $(this).closest('tr');

                $.ajax({
                    url: 'approve.php',
                    type: 'POST',
                    data: { hire_id: hireId },
                    success: function(response) {
                        if (response.success) {
                            row.find('td:nth-child(8)').html('<span style="color: green;">Approved</span>'); // Update status cell
                            row.find('.approve').hide(); // Hide approve button after approval
                        } else {
                            alert('Approval failed: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });

            // Delete action
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var hireId = $(this).data('id');
                var row = $(this).closest('tr');

                if (confirm("Are you sure you want to delete this request?")) {
                    $.ajax({
                        url: 'delete.php',
                        type: 'POST',
                        data: { hire_id: hireId }, // Ensure hireId is set correctly
                        success: function(response) {
                            console.log('Raw response:', response); // Log the raw response for debugging
                            try {
                                let result = typeof response === 'string' ? JSON.parse(response) : response;
                                if (result.success) {
                                    row.fadeOut(); // Assuming 'row' is defined and refers to the correct row
                                } else {
                                    alert('Error: ' + result.message);
                                }
                            } catch (e) {
                                alert('Response parsing error: ' + e.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('AJAX Error:', xhr.responseText); // Log the full error response for debugging
                            alert('Error: ' + xhr.status + ' ' + xhr.statusText + ' - ' + error);
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div id="header">
        <h1>Riva Auto</h1>
    </div>

    <div id="navigation">
        <ul>
            <li><a href="index.php"><span>Messages</span></a></li>
            <li><a href="add_vehicles.php"><span>Vehicle Management</span></a></li>
            <li><a href="client_requests.php"><span>Rent Requests</span></a></li>
            <li><a href="profile_settings.php"><span>Update Profile</span></a></li>
            <li><a href="logout.php"><span>Log Out</span></a></li>
        </ul>
    </div>

    <div id="container">
        <div class="shell">
            <div class="small-nav"></div>
            <br />
            <div id="main">
                <div class="cl">&nbsp;</div>
                <div id="content">
                    <div class="box">
                        <div class="box-head">
                            <h2 class="left">Rent Requests</h2>
                        </div>

                        <div class="box-content">
                            <div class="table">
                                <table>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Address</th>
                                        <th>Booking Date</th>
                                        <th>Number of Days</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    <?php
                                        if (isset($result) && mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $hire_id = htmlspecialchars($row['hire_id']);
                                                $customer_name = htmlspecialchars($row['customer_name']);
                                                $customer_phone = htmlspecialchars($row['customer_phone']);
                                                $customer_email = htmlspecialchars($row['customer_email']);
                                                $customer_address = htmlspecialchars($row['customer_address']);
                                                $booking_date = htmlspecialchars($row['booking_date']);
                                                $number_of_days = htmlspecialchars($row['number_of_days']);
                                                $total_amount = htmlspecialchars($row['total_amount']);
                                                $status = htmlspecialchars($row['status']);
                                    ?>
                                                <tr id="row_<?php echo $hire_id; ?>">
                                                    <td><?php echo $customer_name; ?></td>
                                                    <td><?php echo $customer_phone; ?></td>
                                                    <td><?php echo $customer_email; ?></td>
                                                    <td><?php echo $customer_address; ?></td>
                                                    <td><?php echo $booking_date; ?></td>
                                                    <td><?php echo $number_of_days; ?></td>
                                                    <td><?php echo $total_amount; ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td>
                                                        <a href="#" class="ico approve" data-id="<?php echo $hire_id; ?>">Approve</a>
                                                        <a href="#" class="ico delete" data-id="<?php echo $hire_id; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="9">No requests found.</td></tr>';
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        
    </div>
</body>
</html>
