<head>
  <link rel="stylesheet" href="../style/title.css" />
</head>


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