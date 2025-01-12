<head>
  <style>
    /* top title */
    .title {
      margin: 0;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      background-color: #171123;
      padding: 0 0;
    }

    .title .letter1,
    .title .letter2 {
      color: #e8f1f2;
      font-size: 24px;
      font-weight: 700;
      padding: 0px 4px;
    }

    .title .letter1:hover {
      color: red;
    }

    .title .letter2:hover {
      color: skyblue;
    }
  </style>
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