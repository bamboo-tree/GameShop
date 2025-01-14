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
    <form class="save" action="" method="POST">
      <button name="favourite" value="id">Add to favourite</button>
      <button name="shopping_cart" value="id">Add to shopping cart</button>
    </form>
  </div>
</div>