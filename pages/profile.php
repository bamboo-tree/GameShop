<!DOCTYPE html>
<html lang="en">
<?php
require '../php/Data_Base.php';
$data_base = new Data_Base('localhost', 'root', '', 'game_shop');
session_start();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Game Shop</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/profile.css" />
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
    <?php
    $session_id = session_id();
    $data = $data_base->my_query("SELECT `session_id`, `user_name` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
    $row = $data->fetch_assoc();

    if ($data->num_rows == 1) {
      $user_name = $row['user_name'];
      echo "<a class='active' style='font-weight: 900' href='./profile.php'>Hello, $user_name!</a>";
    } else {
      echo "<a href='./log_in_page.php'>Login</a>";
    }
    ?>
  </div>
  <div id="wrap">

    <div class="main_page">
      <form class="vertical_form" action="" method="POST">
        <div class="button_set">
          <input type="submit" name="account" value="Manage Account">
          <input type="submit" name="shopping_cart" value="Shopping Cart">
          <input type="submit" name="favourite" value="Favourite">
          <input type="submit" name="logout" value="Log Out">
        </div>
      </form>
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['logout'] == "Log Out") {
          $session_id = session_id();
          $data_base->my_query("DELETE FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
          header('Location: ./home_page.php');
        }
        echo "<div class='content'>";
        if ($_POST['account'] == "Manage Account") {
          echo "<h3>Manage Account</h3>";
      ?>



      <?php
        }
        if ($_POST['favourite'] == "Favourite") {
          echo "<h3>Favourite Itmes</h3>";
        }
        if ($_POST['shopping_cart'] == "Shopping Cart") {
          echo "<h3>Your Shopping Cart</h3>";
        }




        echo "</div>";
      } else {
        echo "<div class='content'>";
        // same as in shopping_cart - i know it's bad but it i'm too lazy to change it, so let it be for now

        echo "<h3>Your Shopping Cart</h3>";

        echo "</div>";
      }
      ?>


    </div>
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