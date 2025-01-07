<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_shop";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve the image
$id = $_GET['id']; // Image ID passed via URL
$sql = "SELECT `image` FROM `products` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($imageData);
$stmt->fetch();
$stmt->close();
$conn->close();

// Output the image
header("Content-type: image/jpg"); // Change based on the image type
echo $imageData;
