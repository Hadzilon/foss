<?php
include 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riva Automobiles Rental</title>
    <meta charset="utf-8">
    <meta name="author" content="Your Name">
    <meta name="description" content="Car rental services for Dacia and Renault vehicles"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0" />
    

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        a:hover {
            color: #007BFF;
            text-decoration: underline;
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

        .caption h2, .caption h3 {
            color: #000;
            margin: 0;
        }

        .listings {
            margin: 20px 0;
        }

        .properties_list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .properties_list li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 15px;
            border-radius: 8px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .thumb {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .price {
            display: block;
            font-size: 1.5em;
            color: #007BFF;
            margin: 10px 0;
        }

        .property_details h1, .property_details h2 {
            color: #333;
            margin: 10px 0;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px;
        }

        .footer-section {
            flex: 1;
            margin: 10px;
            min-width: 200px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section li {
            margin-bottom: 20px;
        }

        .footer-section p {
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

    <section class="listings">
        <div class="wrapper">
            <ul class="properties_list">
            <?php
                $sel = "SELECT * FROM cars WHERE status = 'Available'";
                $rs = $conn->query($sel);
                while($rws = $rs->fetch_assoc()){
            ?>
                <li>
                    <a href="book_car.php?id=<?php echo $rws['car_id'] ?>">
                        <img class="thumb" src="cars/<?php echo $rws['image'];?>" alt="Car Image">
                    </a>
                    <span class="price"><?php echo $rws['hire_cost'] . ' dhs'; ?></span>
                    <div class="property_details">
                        <h1>
                            <a href="book_car.php?id=<?php echo $rws['car_id'] ?>"><?php echo 'Car Make: ' . $rws['car_type'];?></a>
                        </h1>
                        <h2>Car Name/Model: <span><?php echo $rws['car_name'];?></span></h2>
                    </div>
                </li>
            <?php
                }
            ?>
            </ul>
        </div>
    </section>

    <footer>
        <div class="footer">
            <div class="footer-section">
                <ul>
                    <li><strong>OUR agency</strong></li>
                    <li><a href="#">About Us</a></li>
                    <li><p>Riva Auto is an organized agency that rents cars and other vehicles to clients at lower costs. We are here to serve every Moroccan citizen.</p></li>
                </ul>
            </div>
            <div class="footer-section">
                <ul>
                    <li><strong>OUR CAR TYPES</strong></li>
                    <li>Renault</a></li>
                    <li>Dacia</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <ul>
                    
                   
                </ul>
            </div>
        </div>

       
    </footer>
</body>
</html>
