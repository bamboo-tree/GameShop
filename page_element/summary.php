<head>
  <link rel="stylesheet" href="../style/form.css" />
</head>

<?php
require_once '../class/User.php';

// check user input - sign up
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['submit'] == 'Create') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $user_name = htmlspecialchars($_POST['user_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // validation
    if (empty($first_name)) {
      $errors[] = "First name is required.";
    } else {
      $first_name = trim($first_name);
      if (!preg_match("/^[aąbcćdeęfghijklłmnńoópqrsśtuvwxyzźżAĄBCĆDEĘFGHIJKLŁMNŃOÓPQRSŚTUVWXYZŹŻ]+$/", $first_name)) {
        $errors[] = "First name can only contain letters";
      }
    }
    if (empty($last_name)) {
      $errors[] = "Last name is required.";
    } else {
      $last_name = trim($last_name);
      if (!preg_match("/^[aąbcćdeęfghijklłmnńoópqrsśtuvwxyzźżAĄBCĆDEĘFGHIJKLŁMNŃOÓPQRSŚTUVWXYZŹŻ]+$/", $last_name)) {
        $errors[] = "Last name can only contain letters";
      }
    }
    if (empty($user_name)) {
      $errors[] = "User name is required.";
    } else {
      $user_name = trim($user_name);
      if (!preg_match("/^[aąbcćdeęfghijklłmnńoópqrsśtuvwxyzźżAĄBCĆDEĘFGHIJKLŁMNŃOÓPQRSŚTUVWXYZŹŻ\d]{4,}$/", $user_name)) {
        $errors[] = "User name must be at least 4 characters long and include letters and digits";
      }
    }
    if (empty($email)) {
      $errors[] = "Email is required.";
    } else {
      $email = trim($email);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
      }
    }
    if (empty($password)) {
      $errors[] = "Password is required.";
    } else {
      if (!(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/", $password))) {
        $errors[] = "Password must be at least 8 characters long and include at least one letter and one number.";
      }
    }

    // Check if there are any errors
    if (empty($errors)) {
      // create User object
      $user = new User($first_name, $last_name, $user_name, $email, $password, 'USER');
      try {
        $data_base->my_query("INSERT INTO `users`(`user_name`, `password`, `first_name`, `second_name`, `email`, `status`) VALUES ('" . $user->get_user_name() . "','" . $user->get_password() . "','" . $user->get_first_name() . "','" . $user->get_last_name() . "','" . $user->get_email() . "','USER')");
        // add to logged in users
        $data = $data_base->my_query("SELECT `id`, `password`, `status` FROM `users` WHERE `user_name` LIKE '$user_name'");
        $row = $data->fetch_assoc();

        $hash = $row['password'];
        $id = $row['id'];
        $status = $row['status'];
        $session_id = session_id();

        if ($data->num_rows == 1 && password_verify($password, $hash)) {
          // remove user in case they didn't log out previously
          $data_base->my_query("DELETE FROM `logged_in_users` WHERE `user_id` LIKE '$id'");
          $data_base->my_query("INSERT INTO `logged_in_users`(`session_id`, `user_id`, `user_name`, `status`) VALUES ('$session_id','$id','$user_name','$status')");
          echo "<div style='background: #029405' class='info'>";
          echo "Successful Login!";
          echo "</div>";
        }
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
?>

<div class="wrap">
  <form class="my_form" method="POST">
    <div class="input_set">
      <label for="price">Total</label>
      <?php
      if ($sum == 0) {
        echo "<p id='price'>FREE</p>";
      } else {
        echo "<p id='price'>$sum USD</p>";
      }
      ?>
    </div>
    <div class="input_set">
      <label for="payment_method">Payment method</label>
      <select name="payment_method" id="cars">
        <option value="blik">Blik</option>
        <option value="visa">Visa</option>
        <option value="mastercard">Mastercard</option>
        <option value="giftcard">Gift Card</option>
      </select>

    </div>
    <div class="input_set">
      <label for="payment">Payment</label>
      <input type="text" name="payment" id="payment" />
    </div>


    <div class="button_set">
      <input type="submit" name="submit" value="Purchase" id="submit" />
      <input type="reset" name="reset" value="Clear" id="clear" />
    </div>
  </form>
</div>