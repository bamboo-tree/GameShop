<!DOCTYPE html>
<?php
  require './php/User.php';
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Game Shop</title>
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
    <!-- CSS -->
    <link rel="stylesheet" href="./styles/main.css" />
    <link rel="stylesheet" href="./styles/login_page.css" />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="title">
    <?php
        $text = "GAME SHOP";
        for($i = 0; $i < strlen($text); $i++){
            $class_name = "letter".(($i+1)%2)+1;
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
        <form id="sign_up_form" action="" method="POST">
          <div class="input_set">
            <label for="first_textname">First Name</label>
            <input type="text" name="first_name" id="first_name" />
          </div>
          <div class="input_set">
            <label for="first_textname">Last Name</label>
            <input type="text" name="last_name" id="last_name" />
          </div>
          <div class="input_set">
            <label for="user_name">User Name</label>
            <input type="text" name="user_name" id="user_name" />
          </div>
          <div class="input_set">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" />
          </div>
          <div class="input_set">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
          </div>
          <div class="button_set">
            <input type="submit" name="submit" value="Send" id="submit" />
            <input type="reset" name="reset" value="Clear" id="clear" />
          </div>
        </form>
      </div>
        <?php
          // check user input
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(sizeof($_POST) != 6){
              echo "<div class='info'><p>Complete all form fields!</p></div>";
            }
            else{
              $first_name = htmlspecialchars($_POST['first_name']);
              $last_name = htmlspecialchars($_POST['last_name']);
              $user_name = htmlspecialchars($_POST['user_name']);
              $email = htmlspecialchars($_POST['email']);
              $password = htmlspecialchars($_POST['password']);
              // validation
              

              $my_user = new User(
                htmlspecialchars($_POST['first_name']),
                htmlspecialchars($_POST['last_name']),
                htmlspecialchars($_POST['user_name']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['password'])
              );
              $my_user->show_user_info();
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
