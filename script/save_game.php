<?php
require '../class/Data_Base.php';
$data_base = new Data_Base('localhost', 'root', '', 'game_shop');
session_start();

// save game to favourites or add to shopping cart
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $session_id = session_id();

  $data = $data_base->my_query("SELECT `user_id` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
  $row = $data->fetch_assoc();

  if ($data->num_rows == 1) {
    $user_id = $row['user_id'];
  }

  // add to favourites
  if ($_POST['favourite'] != 0) {
    $id = $_POST['favourite'];

    // if game is already added do nothing
    $data = $data_base->my_query("SELECT `user_id` FROM `favourites` WHERE `product_id` LIKE '$id' AND `user_id` LIKE '$user_id'");
    if ($data->num_rows == 0) {
      $data_base->my_query("INSERT INTO `favourites`(`user_id`, `product_id`) VALUES ('$user_id','$id')");
    }

    header('Location: ../page/products.php');
  }
  // add to shopping cart
  else if ($_POST['shopping_cart'] != 0) {
    $id = $_POST['shopping_cart'];

    // if game is already added do nothing
    $data = $data_base->my_query("SELECT `user_id` FROM `shopping_cart` WHERE `product_id` LIKE '$id' AND `user_id` LIKE '$user_id'");
    if ($data->num_rows == 0) {
      $data_base->my_query("INSERT INTO `shopping_cart`(`user_id`, `product_id`, `count`) VALUES ('$user_id','$id','1')");
    }

    header('Location: ../page/products.php');
  }
  // remove from favourite
  else if ($_POST['remove_favourite'] != 0) {
    $id = $_POST['remove_favourite'];
    $data_base->my_query("DELETE FROM `favourites` WHERE `user_id` LIKE '$user_id' AND `product_id` LIKE '$id'");

    header('Location: ../page/favourite.php');
  }
  // remove from shopping cart
  else if ($_POST['remove_shopping_cart'] != 0) {
    $id = $_POST['remove_shopping_cart'];
    $data_base->my_query("DELETE FROM `shopping_cart` WHERE `user_id` LIKE '$user_id' AND `product_id` LIKE '$id'");

    header('Location: ../page/shopping_cart.php');
  }
}

exit();
