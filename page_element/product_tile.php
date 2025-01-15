<div class="tile">
  <?php
  $folder = '../images/games/';
  $files = glob("$folder/$image_id.*");

  if (!empty($files)) {
    $file_path = $files[0];
    echo "<img src='$file_path' alt='game'>";
  } else {
    echo "<img src='../images/placeholder.jpg' alt='game'>";
  }
  ?>
  <div class="column">
    <div class="specification">
      <h2 class="name"><?php echo "$title"; ?></h2>
      <p class="price">Price:
        <b>
          <?php
          if ($price == 0) {
            echo 'FREE';
          } else {
            echo "$price USD";
          }
          ?>
        </b>
      </p>
      <p class="studio">Studio: <b><?php echo "$studio"; ?></b></p>
      <p class="year">Year: <b><?php echo "$year"; ?></b></p>
    </div>
    <form class="save" action="../script/save_game.php" method="POST">
      <?php

      // if user is not logged in - exit!
      $session_id = session_id();
      $data = $data_base->my_query("SELECT `status` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
      $row = $data->fetch_assoc();
      $status = $row['status'];

      if ($data->num_rows == 0) {
        echo "<a href='../page/login.php'>Join us!</a>";
        echo "<p class='light'>You need an account to save games</p>";
      } else if ($status == 'USER') {
        echo "<button name='favourite' value='$id'>Add to favourite</button>";
        echo "<button name='shopping_cart' value='$id'>Add to shopping cart</button>";
      } else {
        echo "<p class='light'>Admin can not save games, obviously</p>";
      }
      ?>
    </form>
  </div>
</div>