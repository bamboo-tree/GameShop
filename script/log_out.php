<?php

require '../class/Data_Base.php';
$data_base = new Data_Base('localhost', 'root', '', 'game_shop');
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
  $session_id = session_id();
  $data_base->my_query("DELETE FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");

  session_unset();
  session_destroy();

  header("Location: ../page/test.php");
  exit();
} else {
  echo "Stop fucking around!!!";
}
