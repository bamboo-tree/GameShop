<head>
  <link rel="stylesheet" href="../style/nav_bar.css" />
</head>

<div class="navbar">
  <button style="display: none;" class="logout">Log Out</button>
  <a href="../page/test.php">Home</a>
  <a href="../page/products.php">Products</a>
  <?php
  // check if user is logged in
  $session_id = session_id();
  $data = $data_base->my_query("SELECT `session_id`, `user_name`, `status` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
  $row = $data->fetch_assoc();

  if ($data->num_rows == 1) {
    $user_name = $row['user_name'];
    $status = $row['status'];

    // drop down navigation for USER or ADMIN
    if ($status == 'ADMIN') {
  ?>
      <div class="dropdown">
        <button class="dropbtn">Hello, <?php echo "$user_name" ?></button>
        <div class="dropdown-content">
          <a href="#">Add Game</a>
          <a href="#">Delete Game</a>
          <form action="../script/log_out.php" method="POST">
            <button type="submit" name="logout">Log Out</button>
          </form>
        </div>
      </div>
    <?php
    } else if ($status == 'USER') {
    ?>
      <div class="dropdown">
        <button class="dropbtn">Hello, <?php echo "$user_name" ?></button>
        <div class="dropdown-content">
          <a href="#">Shopping cart</a>
          <a href="#">Favourite</a>
          <form action="../script/log_out.php" method="POST">
            <button type="submit" name="logout">Log Out</button>
          </form>
        </div>
      </div>
    <?php
    }
  } else {
    ?>
    <div class="dropdown">
      <button class="dropbtn">Join Us</button>
      <div class="dropdown-content">
        <a href="../page/login.php">Log In</a>
        <a href="../page/sign_up.php">Sign Up</a>
      </div>
    </div>
  <?php
  }
  ?>
</div>