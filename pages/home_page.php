<!DOCTYPE html>
<html lang="en">
<?php
require '../php/Data_Base.php';
$data_base = new Data_Base('localhost', 'root', '', 'game_shop');
session_start();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Game Shop</title>
  <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
  <!-- CSS -->
  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/home_page.css" />
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&display=swap"
    rel="stylesheet" />
</head>

<body>
  <div class="title">
    <?php
    $text = "GAME SHOP";
    for ($i = 0; $i < strlen($text); $i++) {
      $class_name = "letter" . (($i + 1) % 2) + 1;
      $letter = $text[$i];
      echo "<p class='$class_name'>$letter</p>";
    }
    ?>
  </div>
  <div class="topnav">
    <!-- TODO: if user is logged in change 'login' to 'logout' -->
    <a class="active" href="./home_page.php">Home</a>
    <a href="">Products</a>
    <a href="">Shoping Cart</a>
    <?php
    $session_id = session_id();
    $data = $data_base->my_query("SELECT `session_id`, `user_name` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
    $row = $data->fetch_assoc();

    if ($data->num_rows == 1) {
      $user_name = $row['user_name'];
      echo "<a style='font-weight: 900' href='./profile.php'>Hello, $user_name!</a>";
    } else {
      echo "<a href='./log_in_page.php'>Login</a>";
    }
    ?>
  </div>
  <div id="wrap">
    <div class="main_page">
      <div id="about">
        <p style="align-self: flex-end">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil
          possimus voluptatem in unde architecto eum expedita aspernatur, amet
          alias ab repudiandae ratione id. Eveniet saepe repudiandae
          reprehenderit temporibus quasi aliquam, maxime sequi ipsum labore,
          accusantium aliquid iure, expedita officiis. Quasi perferendis,
          natus architecto eos voluptas cum! Fugiat eaque quo quis sit maiores
          in dolor labore nam animi repellat omnis quas sunt magnam voluptate
          aliquam necessitatibus cupiditate doloremque dicta debitis, ullam
          eius mollitia. Iusto fugit alias perspiciatis optio ex atque quis.
          Repellendus, ut doloremque. Praesentium alias sit dolorum corrupti
          porro excepturi sunt suscipit asperiores officiis! Accusantium totam
          qui necessitatibus iure maiores id assumenda corrupti in sed,
          quisquam est at, porro aliquid.
        </p>
        <p style="align-self: flex-start">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil
          possimus voluptatem in unde architecto eum expedita aspernatur, amet
          alias ab repudiandae ratione id. Eveniet saepe repudiandae
          reprehenderit temporibus quasi aliquam, maxime sequi ipsum labore,
          accusantium aliquid iure, expedita officiis. Quasi perferendis,
          natus architecto eos voluptas cum! Fugiat eaque quo quis sit maiores
          in dolor labore nam animi repellat omnis quas sunt magnam voluptate
          aliquam necessitatibus cupiditate doloremque dicta debitis, ullam
          eius mollitia. Iusto fugit alias perspiciatis optio ex atque quis.
          Repellendus, ut doloremque. Praesentium alias sit dolorum corrupti
          porro excepturi sunt suscipit asperiores officiis!
        </p>
        <p style="align-self: flex-end">
          Adipisci maxime animi doloribus nulla, facilis possimus harum,
          perspiciatis facere deleniti labore omnis atque dolores fugit
          pariatur vel aperiam soluta? Quaerat magni fuga pariatur praesentium
          sunt quo quasi excepturi commodi animi placeat, eum quam soluta
          ullam inventore hic labore quibusdam cum nobis incidunt. Aspernatur
          accusantium iste adipisci quia voluptatem quibusdam nam. Totam
          nesciunt aut dolore quae iste reiciendis modi quo alias
          voluptatibus? Quibusdam delectus accusamus libero fugiat rerum quas
          maiores? Deleniti, quisquam laudantium incidunt ullam adipisci ipsa
          deserunt laborum, itaque expedita porro excepturi nihil magnam est
          mollitia vero? Corrupti delectus error neque vel praesentium vitae,
          eos excepturi tenetur quod itaque! Nostrum similique ipsam quod amet
          assumenda possimus praesentium ad aliquid dolorem eos ex labore iste
          optio placeat modi, minima laborum temporibus. Voluptas,
          reprehenderit nobis ab asperiores aut ex. Sequi fugiat harum,
          officiis id aliquid saepe exercitationem? Nostrum vel, commodi
          architecto tenetur cum sed voluptate, odit qui autem a voluptatibus?
          Cum explicabo blanditiis possimus illum.
        </p>
        <p style="align-self: flex-start">
          Accusantium totam qui necessitatibus iure maiores id assumenda
          corrupti in sed, quisquam est at, porro aliquid. Sint consequatur
          exercitationem distinctio mollitia necessitatibus fugit aliquam
          cupiditate beatae laboriosam. Ex est voluptate quo aliquid unde
          natus, earum odit culpa, inventore ut accusamus. Adipisci maxime
          animi doloribus nulla, facilis possimus harum, perspiciatis facere
          deleniti labore omnis atque dolores fugit pariatur vel aperiam
          soluta? Quaerat magni fuga pariatur praesentium sunt quo quasi
          excepturi commodi animi placeat, eum quam soluta ullam inventore hic
          labore quibusdam cum nobis incidunt.
        </p>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="bottom_bar">
      <a href="#email">Email</a>
      <a href="#facebook">Facebook</a>
      <a href="#tweeter">Tweeter</a>
      <a href="#">Top</a>
    </div>
    <p>Copyright © 2024 Maciej Kamiński</p>
  </div>
</body>

</html>