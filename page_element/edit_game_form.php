<head>
  <link rel="stylesheet" href="../style/edit_form.css" />
  <link rel="stylesheet" href="../style/product.css" />
</head>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST['submit'] == "Update") {

  // if value isn't set use an old one
  $temp = htmlspecialchars($_POST["title_$id"]);
  if (!empty($temp)) {
    $title = $temp;
  }
  $temp = htmlspecialchars($_POST["studio_$id"]);
  if (!empty($temp)) {
    $studio = $temp;
  }
  $temp = htmlspecialchars($_POST["year_$id"]);
  if (!empty($temp)) {
    $year = $temp;
  }
  $temp = htmlspecialchars($_POST["price_$id"]);
  if (!empty($temp)) {
    $price = $temp;
  }


  // validation
  if (empty($title)) {
    $errors[] = "Title is required.";
  } else {
    $title = trim($title);
  }
  if (empty($studio)) {
    $errors[] = "Studio is required.";
  } else {
    $studio = trim($studio);
  }
  if (empty($year)) {
    $errors[] = "Year is required.";
  }
  if (empty($price)) {
    $errors[] = "Price is required.";
  }

  $target_dir = "../images/games/";
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
  }

  if (empty($errors)) {
    if (is_uploaded_file($_FILES["image_$id"]['tmp_name'])) {
      $file_temp_path = $_FILES["image_$id"]['tmp_name'];
      $file_name = basename($_FILES["image_$id"]['name']);
      $file_type = $_FILES["image_$id"]['type'];

      $allowed_types = ['image/png', 'image/jpeg'];
      if (in_array($file_type, $allowed_types)) {
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $image_id = uniqid();
        $unique_name = $image_id . "." . $ext;
        $dest_path = $target_dir . $unique_name;

        if (move_uploaded_file($file_temp_path, $dest_path)) {
          // file sent
        } else {
          $errors[] = "Error while moving a file.";
        }
      } else {
        $errors[] = "File format is not suported.";
      }
    } else {
      // image isn't required - get image_id from old version
    }
  }

  // Check if there are any errors
  if (empty($errors)) {
    try {
      // get old data from database - previos file

      // delete old version
      $data_base->my_query("DELETE FROM `products` WHERE `id` LIKE '$id'");

      // insert new product with old ID!!!
      $data_base->my_query("INSERT INTO `products`(`id`, `image_id`, `title`, `studio`, `price`, `year`) VALUES ('$id','$image_id','$title','$studio','$price','$year')");
    } catch (Exception $e) {
      echo "<div class='info'>";
      echo "Error: " . $e->getMessage();
      echo "</div>";
    }
  } else {
    // Display errors
    echo "<div class='info'>";
    foreach ($errors as $error) {
      echo "<b>$error</b></br>";
    }
    echo "</div>";
  }
}
?>


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
      echo "<button name='favourite' value='$id'>Add to favourite</button>";
      echo "<button name='shopping_cart' value='$id'>Add to shopping cart</button>";
      ?>
    </form>
  </div>
</div>

<div class="wrap">
  <form class="my_form" method="POST" enctype="multipart/form-data">
    <div class="input_set">
      <label for="title">Game Title</label>
      <input type="text" name="<?php echo "title_$id"; ?>" id="<?php echo "title_$id"; ?>" value="<?php echo "$title"; ?>" />
    </div>
    <div class="input_set">
      <label for="studio">Studio</label>
      <input type="text" name="<?php echo "studio_$id"; ?>" id="<?php echo "studio_$id"; ?>" value="<?php echo "$studio"; ?>" />
    </div>
    <div class="input_set">
      <label for="year">Year of Release</label>
      <input type="number" id="<?php echo "year_$id"; ?>" name="<?php echo "year_$id"; ?>" min="1984" max="2025" value="<?php echo "$year"; ?>">
    </div>
    <div class="input_set">
      <label for="price">Price</label>
      <input type="number" name="<?php echo "price_$id"; ?>" id="<?php echo "price_$id"; ?>" step="0.01" min="0.00" value="<?php echo "$price"; ?>" />
    </div>
    <div class="input_set">
      <label for="image">Select Image:</label>
      <input type="file" name="<?php echo "image_$id"; ?>" id="<?php echo "image_$id"; ?>" accept="image/jpeg, image/png">
    </div>
    <div class="button_set">
      <input type="submit" name="submit" value="Update" id="submit" />
      <input type="reset" name="reset" value="Clear" id="clear" />
    </div>
  </form>
</div>