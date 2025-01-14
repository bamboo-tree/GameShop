<?php
// if user is logged in - exit!
$session_id = session_id();
$data = $data_base->my_query("SELECT `user_id` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
if ($data->num_rows == 1) {
  header('Location: ../page/test.php');
  exit;
}
