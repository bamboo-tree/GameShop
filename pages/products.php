<!DOCTYPE html>
<html lang="en">
<?php
require '../php/Data_Base.php';
// require '../php/get_image.php';
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
  <link rel="stylesheet" href="../styles/products.css" />

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
    <a class="active" href="./products.php">Products</a>
    <a href="">Shoping Cart</a>
    <?php
    $session_id = session_id();
    $data = $data_base->my_query("SELECT `session_id`, `user_name` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
    $row = $data->fetch_assoc();

    if ($data->num_rows == 1) {
      $user_name = $row['user_name'];
      echo "<a style='font-weight: 900' href='./profile.php'>Hello, $user_name!</a>";
    } else {
      echo "<a href='./log_in_page.php'>Login</a>";
    }
    ?>
  </div>
  <div id="wrap">
    <div class="main_page">
      <!-- TODO: fetch data from database -->
      <img src="../php/get_image.php?id=2" alt="Image from database">



      <div class="tile">
        <img src="../images/games/tf2.jpg" alt="game">
        <div class="column">
          <div class="specification">
            <h2 class="name">Team Fortress 2</h2>
            <p class="price">Price: <b>Free</b></p>
            <p class="studio">Studio: <b>Valve</b></p>
            <p class="year">Year: <b>2007</b></p>
          </div>
          <form class="save" action="" method="POST">
            <button name="favourite" value="id">Add to favourite</button>
            <button name="shopping_cart" value="id">Add to shopping cart</button>
          </form>
        </div>
      </div>
      <div class="tile">
        <img src="../images/games/tf2.jpg" alt="game">
        <div class="column">
          <div class="specification">
            <h2 class="name">Team Fortress 2</h2>
            <p class="price">Price: <b>Free</b></p>
            <p class="studio">Studio: <b>Valve</b></p>
            <p class="year">Year: <b>2007</b></p>
          </div>
          <form class="save" action="" method="POST">
            <button name="favourite" value="id">Add to favourite</button>
            <button name="shopping_cart" value="id">Add to shopping cart</button>
          </form>
        </div>
      </div>
    </div>
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