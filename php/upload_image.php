<?php
if (isset($_POST['submit'])) {
  $uploadDir = "../images/games";
  $file = $_FILES['image'];

  // Validate that a file was uploaded
  if ($file['error'] === UPLOAD_ERR_OK) {
    $fileName = basename($file['name']);
    $fileTmpPath = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];

    // Validate file type (allow only images)
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (in_array($fileType, $allowedTypes)) {
      // Move the uploaded file to the uploads directory
      $destination = $uploadDir . $fileName;
      if (move_uploaded_file($fileTmpPath, $destination)) {
        // Redirect to the form with the uploaded image
        header("Location: ../pages/profile.php?image=" . urlencode($fileName));
        exit();
      } else {
        echo "Error: Failed to move the uploaded file.";
      }
    } else {
      echo "Error: Only JPG and PNG files are allowed.";
    }
  } else {
    echo "Error: No file was uploaded.";
  }
} else {
  echo "Error: Invalid request.";
}
