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

  <?php
  $data = $data_base->my_query("SELECT `id`, `image_id`, `title`, `studio`, `price`, `year` FROM `products` WHERE 1");
  // $rows = [];
  while ($row = $result->fetch_assoc()) {
    // $data[] = $row;
    $image_id = $row['image_id'];
    $title = $row['title'];
    $studio = $row['studio'];
    $price = $row['price'];
    $year = $row['year'];
    include "../page_element/product_tile.php";
  }



  ?>


  <?php
  include '../page_element/footer.php';
  ?>
</body>

</html>