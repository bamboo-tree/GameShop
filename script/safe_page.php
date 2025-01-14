<?php
// if user is not ADMIN - exit!
$session_id = session_id();
$data = $data_base->my_query("SELECT `status` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
$row = $data->fetch_assoc();
$status = $row['status'];

if ($status == 'ADMIN') {
  // go in
} else {
  header('Location: ../page/silly_boy.php');
  exit;
}
