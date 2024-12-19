<!DOCTYPE html>
<?php
require '../php/User.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Game Shop</title>
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
    <!-- CSS -->
    <link rel="stylesheet" href="../styles/main.css" />
    <link rel="stylesheet" href="../styles/login_page.css" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="title">
        <?php
        $text = "GAME SHOP";
        for ($i = 0; $i < strlen($text); $i++) {
            $class_name = "letter" . (($i + 1) % 2) + 1;
            $letter = $text[$i];
            echo "<p class='$class_name'>$letter</p>";
        }
        ?>
    </div>
    <div class="topnav">
        <!-- TODO: if user is logged in change 'login' to 'logout' -->
        <a href="./home_page.php">Home</a>
        <a href="">Products</a>
        <a href="">Shoping Cart</a>
        <a href="">Profile</a>
        <a class="active" href="">Login</a>
    </div>
    <div id="wrap">
        <div class="main_page">
            <form class="my_form" action="" method="POST">
                <div class="input_set">
                    <label for="user_name">User Name</label>
                    <input type="text" name="user_name" id="user_name" />
                </div>
                <div class="input_set">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" />
                </div>
                <div class="button_set">
                    <input type="submit" name="submit" value="Send" id="submit" />
                    <input type="reset" name="reset" value="Clear" id="clear" />
                    <input type="submit" name="sign_up" value="Sign Up" id="sign_up" />
                </div>
            </form>
        </div>
        <?php
        // check user input
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['sign_up'] == "Sign Up") {
                header('Location: ./sign_up_page.php');
            }
        }
        ?>
    </div>
    <div class="footer">
        <div class="bottom_bar">
            <a href="#email">Email</a>
            <a href="#facebook">Facebook</a>
            <a href="#tweeter">Tweeter</a>
            <a href="#">Top</a>
        </div>
        <p>Copyright © 2024 Maciej Kamiński</p>
    </div>
</body>

</html>