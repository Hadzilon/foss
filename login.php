<?php
if (isset($_POST['login'])) {
    include 'includes/config.php';

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE uname = ? AND pass = ?");
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;
    $rows = $result->fetch_assoc();
    
    if ($num > 0) {
        session_start();
        $_SESSION['uname'] = $rows['uname'];
        $_SESSION['pass'] = $rows['pass'];
        
        // Redirect to admin/index.php after successful login
        header("Location: admin/index.php");
        exit(); // Ensures that no further code is executed after redirection
    } else {
        echo "<script type='text/javascript'>
                alert('Login Failed. Try Again.');
                window.location = 'login.php';
              </script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riva Automobiles Rental</title>
    <meta charset="utf-8">
    <meta name="author" content="Your Name">
    <meta name="description" content="Car rental services for Dacia and Renault vehicles"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    
 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        header {
            background-color: #000;
            color: #fff;
            padding: 15px 0;
        }

        .wrapper {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo img {
            height: 60px;
            vertical-align: middle;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .caption {
            background-color: #fff;
            color: #000;
            padding: 20px;
            text-align: center;
        }

        .search {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            background-color: #fff;
            padding: 20px;
        }

        #form {
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        #form h3 {
            color: #000099;
            font-weight: bold;
            text-decoration: underline;
            text-align: center;
            margin-bottom: 20px;
        }

        #form table {
            width: 100%;
            border-collapse: collapse;
        }

        #form td {
            padding: 10px;
            vertical-align: top;
        }

        #form input[type="text"],
        #form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #form input[type="submit"] {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        #form input[type="submit"]:hover {
            background-color: #333;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer ul li {
            margin: 5px 0;
        }

        .footer ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer ul li a:hover {
            text-decoration: underline;
        }

        .about p {
            margin: 10px 0;
        }

        
    </style>
</head>
<body>
    <header>
        <div class="wrapper">
            <a href="index.php"><img src="img/rivaauto.jpg" class="logo" alt="Riva Automobiles Rental" title="Riva Automobiles Rental"></a>
            <nav>
                <ul>
                <li><a href="http://localhost/hadil/index.php" class="btn">Home</a></li>
                    <li><a href="http://localhost/hadil/login.php" class="btn">Admin Login</a></li>
                    <li><a href="http://localhost/hadil/account.php" class="btn">client Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="caption">
        <h3>Dacia - Renault</h3>
    </section>

    <section class="search">
        <div id="form">
            <form method="post">
                <h3>Admin Login </h3>
                <table>
                    <tr>
                        <td>Email Address:</td>
                        <td><input type="text" name="uname" placeholder="Enter Username" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="pass" placeholder="Enter Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center"><input type="submit" name="login" value="Log in"></td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['login'])) {
                include 'includes/config.php';

                $uname = $_POST['uname'];
                $pass = $_POST['pass'];

                // Prepared statement to prevent SQL injection
                $stmt = $conn->prepare("SELECT * FROM admin WHERE uname = ? AND pass = ?");
                $stmt->bind_param("ss", $uname, $pass);
                $stmt->execute();
                $result = $stmt->get_result();
                $num = $result->num_rows;
                $rows = $result->fetch_assoc();
                if ($num > 0) {
                    session_start();
                    $_SESSION['uname'] = $rows['uname'];
                    $_SESSION['pass'] = $rows['pass'];
                    echo "<script type='text/javascript'>
                            alert('Login Successful!');
                            window.location = 'admin/index.php';
                          </script>";
                } else {
                    echo "<script type='text/javascript'>
                            alert('Login Failed. Try Again.');
                            window.location = 'login.php';
                          </script>";
                }
                $stmt->close();
            }
            ?>
        </div>
    </section>

    <footer>
        <div class="footer">
          
          
        </div>

       
    </footer>
</body>
</html>
