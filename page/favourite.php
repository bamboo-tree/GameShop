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
  <link rel="stylesheet" href="../style/product.css" />
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

  <div class="header_frame">
    <h1 class="header">FAVOURITE</h1>
  </div>

  <div class="content">
    <?php
    $data = $data_base->my_query("SELECT `user_id` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
    $row = $data->fetch_assoc();

    if ($data->num_rows == 1) {
      $user_id = $row['user_id'];
    }

    // save all favourite games in array
    $data = $data_base->my_query("SELECT `id`, `product_id` FROM `favourites` WHERE `user_id` LIKE '$user_id'");
    $games = [];
    if ($data->num_rows > 0) {
      while ($row = $data->fetch_assoc()) {
        $games[] = $row['product_id'];
      }
    }

    if (empty($games)) {
      echo "<p class='light'><a href='../page/products.php'>You have no favourite games yet</a></p>";
    } else {
      // display all games
      foreach ($games as $game_id) {
        $data = $data_base->my_query("SELECT `id`, `image_id`, `title`, `studio`, `price`, `year` FROM `products` WHERE `id` LIKE '$game_id'");
        $row = $data->fetch_assoc();

        $id = $row['id'];
        $image_id = $row['image_id'];
        $title = $row['title'];
        $studio = $row['studio'];
        $price = $row['price'];
        $year = $row['year'];
        include "../page_element/favourite_tile.php";
      }
    }

    ?>
  </div>

  <?php
  include '../page_element/footer.php';
  // leave if user is not logged in
  include '../script/not_logged_in.php';
  ?>
</body>

</html>