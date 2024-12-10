<header>
    <div class="wrapper">
        <h1 class="logo">
            <img src="img/rivaauto.jpg" alt="riva automobiles" style="height: 50px;">
        </h1>
        <a href="#" class="hamburger"></a>
        <nav>
            <?php
            if (!isset($_SESSION['email']) || !isset($_SESSION['pass'])) {
            ?>
                <ul>
                <li><a href="index.php" class="btn">Home</a></li>
                   
                    <li><a href="login.php" class="btn">Admin Login</a></li>
                     <li><a href="account.php" class="btn">client login </a></li>
                </ul>
            <?php
            } else {
            ?>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="status.php">View Status</a></li>
                    <li><a href="message_admin.php">Message Admin</a></li>
                </ul>
                <a href="admin/logout.php">Logout</a>
            <?php
            }
            ?>
        </nav>
    </div>
</header>
