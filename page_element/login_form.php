<head>
  <link rel="stylesheet" href="../style/login_form.css" />
</head>

<?php
// check user input - login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['submit'] == 'Log In') {
    $user_name = htmlspecialchars($_POST['user_name']);
    $password = htmlspecialchars($_POST['password']);
    // add to logged in usersexit;
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
    } else {
      echo "<div class='info'>";
      echo "Username or Password is incorrect";
      echo "</div>";
    }
  }
}
?>

<div class="wrap">
  <form class="my_form" method="POST">
    <div class="input_set">
      <label for="user_name">User Name</label>
      <input type="text" name="user_name" id="user_name" />
    </div>
    <div class="input_set">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" />
    </div>
    <div class="button_set">
      <input type="submit" name="submit" value="Log In" id="submit" />
      <input type="reset" name="reset" value="Clear" id="clear" />
    </div>
  </form>
</div>