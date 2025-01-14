<!DOCTYPE html>
<html lang="en">
<?php
require '../class/Data_Base.php';
$data_base = new Data_Base('localhost', 'root', '', 'game_shop');
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Shop</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="../style/base.css" />
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
    rel="stylesheet" />
</head>

<body>
  <?php
  include '../page_element/title.php';
  include '../page_element/nav_bar.php';
  ?>
  <div class="content">
    <?php
    include '../page_element/login_form.php';
    ?>
  </div>

  <?php
  include '../page_element/footer.php';
  // leave if user is logged in
  include '../script/is_logged_in.php';

  ?>
</body>

</html>