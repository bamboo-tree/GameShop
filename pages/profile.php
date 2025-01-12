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
    <a href="./products.php">Products</a>
    <a href="">Shoping Cart</a>
    <?php
    $session_id = session_id();
    $data = $data_base->my_query("SELECT `session_id`, `user_name`, `status` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
    $row = $data->fetch_assoc();
    $status = $row['status'];

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
      <?php
      if ($status == 'USER') {
      ?>
        <form class="vertical_form" action="" method="POST">
          <div class="button_set">
            <input type="submit" name="shopping_cart" value="Shopping Cart">
            <input type="submit" name="favourite" value="Favourite">
            <input type="submit" name="logout" value="Log Out">
          </div>
        </form>
      <?php
      } else if ($status == 'ADMIN') {
      ?>
        <form class="vertical_form" action="" method="POST">
          <div class="button_set">
            <input type="submit" name="add_game" value="Add Game">
            <input type="submit" name="edit_library" value="Edit Library">
            <input type="submit" name="logout" value="Log Out">
          </div>
        </form>
        <?php
      }
      echo "<div class='content'>";
      if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST['submit'] != "Add") {
        if ($_POST['logout'] == "Log Out") {
          $session_id = session_id();
          $data_base->my_query("DELETE FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
          header('Location: ./home_page.php');
        }
        if ($_POST['account'] == "Manage Account") {
        ?>
          <h3>Manage Account</h3>";
        <?php
        }
        if ($_POST['favourite'] == "Favourite") {
          echo "<h3>Favourite Itmes</h3>";
        }
        if ($_POST['shopping_cart'] == "Shopping Cart") {
          echo "<h3>Your Shopping Cart</h3>";
        }
        if ($_POST['add_game'] == "Add Game") {
        ?>
          <h3>Add Game</h3>
          <div class="my_form">
            <form action="" method="POST">
              <div class="input_set">
                <label for="title">Game Title</label>
                <input type="text" name="title" id="title" />
              </div>
              <div class="input_set">
                <label for="studio">Studio</label>
                <input type="text" name="studio" id="studio" />
              </div>
              <div class="input_set">
                <label for="year">Year of Release</label>
                <input type="number" id="year" name="year" min="1984" max="2025" value="2015">
              </div>
              <div class="input_set">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01" value="0.00" min="0.00" />
              </div>
              <div class="button_set">
                <input type="submit" name="submit" value="Add" id="submit" />
                <input type="reset" name="reset" value="Clear" id="clear" />
              </div>
            </form>
          </div>
      <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST['submit'] == "Add") {

            // get form data
            $title = htmlspecialchars($_POST['title']);
            $studio = htmlspecialchars($_POST['studio']);
            $year = htmlspecialchars($_POST['year']);
            $price = htmlspecialchars($_POST['price']);


            // validation
            if (empty($title)) {
              $errors[] = "Title is required.";
            } else {
              $title = trim($title);
            }
            if (empty($studio)) {
              $errors[] = "Studio is required.";
            } else {
              $studio = trim($studio);
            }
            if (empty($year)) {
              $errors[] = "Year is required.";
            }
            if (empty($price)) {
              $errors[] = "Price is required.";
            }


            // Check if there are any errors
            if (empty($errors)) {
              try {
                echo "TEST";
              } catch (Exception $e) {
                echo "<div class='info'>";
                echo "Error: " . $e->getMessage();
                echo "</div>";
              }
            } else {
              // Display errors
              echo "<div class='info'>";
              foreach ($errors as $error) {
                echo "<b>$error</b></br>";
              }
              echo "</div>";
            }
          }
        }
        if ($_POST['edit_library'] == "Edit Library") {
          echo "<h3>Edit Library</h3>";
        }
      }
      echo "</div>";
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