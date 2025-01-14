<head>
  <link rel="stylesheet" href="../style/form.css" />
</head>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST['submit'] == "Add") {

  // get form data
  $title = htmlspecialchars($_POST['title']);
  $studio = htmlspecialchars($_POST['studio']);
  $year = htmlspecialchars($_POST['year']);
  $price = htmlspecialchars($_POST['price']);

  // validation
  if (empty($title)) {
    $errors[] = "Title is required.";
  } else {
    $title = trim($title);

    $data = $data_base->my_query("SELECT `id` FROM `products` WHERE `title` LIKE '$title'");
    $row = $data->fetch_assoc();
    if ($data->num_rows == 1) {
      $errors[] = "Game with this title already exists!";
    }
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
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
      $file_temp_path = $_FILES['image']['tmp_name'];
      $file_name = basename($_FILES['image']['name']);
      $file_type = $_FILES['image']['type'];

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
      $errors[] = "Image is required.";
    }
  }

  // Check if there are any errors
  if (empty($errors)) {
    try {
      // insert product into db
      $data_base->my_query("INSERT INTO `products`(`image_id`, `title`, `studio`, `price`, `year`) VALUES ('$image_id','$title','$studio','$price','$year')");
      echo "<div style='background: #029405' class='info'>";
      echo "Game added successfully!";
      echo "</div>";
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


<div class="wrap">
  <form class="my_form" method="POST" enctype="multipart/form-data">
    <div class="input_set">
      <label for="title">Game Title</label>
      <input type="text" name="title" id="title" />
    </div>
    <div class="input_set">
      <label for="studio">Studio</label>
      <input type="text" name="studio" id="studio" />
    </div>
    <div class="input_set">
      <label for="year">Year of Release</label>
      <input type="number" id="year" name="year" min="1984" max="2025" value="2015">
    </div>
    <div class="input_set">
      <label for="price">Price</label>
      <input type="number" name="price" id="price" step="0.01" value="0.00" min="0.00" />
    </div>
    <div class="input_set">
      <label for="image">Select Image:</label>
      <input type="file" name="image" id="image" accept="image/jpeg, image/png">
    </div>
    <div class="button_set">
      <input type="submit" name="submit" value="Add" id="submit" />
      <input type="reset" name="reset" value="Clear" id="clear" />
    </div>
  </form>
</div>