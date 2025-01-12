<head>
  <style>
    /* menu bar */
    #id {
      background-color: #e8f1f2;
      color: #171123;
      background-color: #33658a;
    }

    .navbar {
      background-color: #e8f1f2;
      display: flex;
      flex-direction: row;
      justify-content: center;
    }

    .navbar a {
      box-sizing: border-box;
      font-size: 20px;
      color: #171123;
      text-align: center;
      padding: 1%;
      width: 160px;
      text-decoration: none;
    }

    .dropdown {
      overflow: hidden;
    }

    .dropdown .dropbtn {
      font-size: 20px;
      color: #171123;
      background-color: #e8f1f2;
      text-align: center;
      height: 100%;
      width: 160px;
      padding: 1%;
      display: block;
      border: none;
      margin: 0;
    }

    .navbar a:hover,
    .dropdown:hover .dropbtn {
      background-color: #33658a;
      color: #e8f1f2;
    }

    .dropdown-content {
      box-sizing: border-box;
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      width: 160px;
      z-index: 1;
      box-shadow: 0px 20px 20px 0px rgba(0, 0, 0, 0.2);
    }

    .dropdown-content a {
      color: #171123;
      padding: 10%;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .dropdown-content a:hover {
      background-color: #33658a;
      color: #e8f1f2;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
  </style>
</head>

<div class="navbar">
  <a href="#home">Home</a>
  <a href="#news">News</a>
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
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
          <a href="#">Link 1</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
        </div>
      </div>
    <?php
    } else if ($status == 'USER') {
    ?>
      <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
          <a href="#">Link 1</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
        </div>
      </div>
    <?php
    }
  } else {
    ?>
    <a href="../pages/login.php">Log In</a>
  <?php
  }
  ?>
</div>