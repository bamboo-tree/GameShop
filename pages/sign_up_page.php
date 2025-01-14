<!DOCTYPE html>
<?php
require '../php/User.php';
require '../php/Data_Base.php';
$data_base = new Data_Base('localhost', 'root', '', 'game_shop');
session_start();
?>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Game Shop</title>
	<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
	<!-- CSS -->
	<link rel="stylesheet" href="../styles/main.css" />
	<link rel="stylesheet" href="../styles/login_page.css" />
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
		<a href="./home_page.php">Home</a>
		<a href="./products.php">Products</a>
		<a href="">Shoping Cart</a>
		<?php
		$session_id = session_id();
		$data = $data_base->my_query("SELECT `session_id`, `user_name` FROM `logged_in_users` WHERE `session_id` LIKE '$session_id'");
		$row = $data->fetch_assoc();

		if ($data->num_rows == 1) {
			$user_name = $row['user_name'];
			echo "<a style='font-weight: 900' href='./profile.php'>Hello, $user_name!</a>";
		} else {
			echo "<a class='active' href='./log_in_page.php'>Login</a>";
		}
		?>
	</div>
	<div id="wrap">
		<div class="main_page">
			<?php
			// check user input
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if ($_POST['log_in'] == "Log In") {
					header('Location: ./log_in_page.php');
				} else {

					$first_name = htmlspecialchars($_POST['first_name']);
					$last_name = htmlspecialchars($_POST['last_name']);
					$user_name = htmlspecialchars($_POST['user_name']);
					$email = htmlspecialchars($_POST['email']);
					$password = htmlspecialchars($_POST['password']);
					// validation

					if (empty($first_name)) {
						$errors[] = "First name is required.";
					} else {
						$first_name = trim($first_name);
						if (!preg_match("/^[aąbcćdeęfghijklłmnńoópqrsśtuvwxyzźżAĄBCĆDEĘFGHIJKLŁMNŃOÓPQRSŚTUVWXYZŹŻ]+$/", $first_name)) {
							$errors[] = "First name can only contain letters";
						}
					}
					if (empty($last_name)) {
						$errors[] = "Last name is required.";
					} else {
						$last_name = trim($last_name);
						if (!preg_match("/^[aąbcćdeęfghijklłmnńoópqrsśtuvwxyzźżAĄBCĆDEĘFGHIJKLŁMNŃOÓPQRSŚTUVWXYZŹŻ]+$/", $last_name)) {
							$errors[] = "Last name can only contain letters";
						}
					}
					// TODO: username and email has to be unique
					if (empty($user_name)) {
						$errors[] = "User name is required.";
					} else {
						$user_name = trim($user_name);
						if (!preg_match("/^[aąbcćdeęfghijklłmnńoópqrsśtuvwxyzźżAĄBCĆDEĘFGHIJKLŁMNŃOÓPQRSŚTUVWXYZŹŻ\d]{4,}$/", $user_name)) {
							$errors[] = "User name must be at least 4 characters long and include letters and digits";
						}
					}
					if (empty($email)) {
						$errors[] = "Email is required.";
					} else {
						$email = trim($email);
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$errors[] = "Invalid email format.";
						}
					}
					if (empty($password)) {
						$errors[] = "Password is required.";
					} else {
						if (!(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/", $password))) {
							$errors[] = "Password must be at least 8 characters long and include at least one letter and one number.";
						}
					}

					// Check if there are any errors
					if (empty($errors)) {
						// create User object
						$user = new User($first_name, $last_name, $user_name, $email, $password, 'USER');
						// $date = new DateTime();
						try {
							$data_base->my_query("INSERT INTO `users`(`user_name`, `password`, `first_name`, `second_name`, `email`, `status`) VALUES ('" . $user->get_user_name() . "','" . $user->get_password() . "','" . $user->get_first_name() . "','" . $user->get_last_name() . "','" . $user->get_email() . "','USER')");
							echo "<div class='info'>";
							$user->show_user_info();
							echo "</div>";
							// add to logged in users
							$data = $data_base->my_query("SELECT `id`, `password`, `status` FROM `users` WHERE `user_name` LIKE '$user_name'");
							$row = $data->fetch_assoc();
							$hash = $row['password'];
							$id = $row['id'];
							$status = $row['status'];
							$session_id = session_id();
							if ($data->num_rows == 1 && password_verify($password, $hash)) {
								// remove user in case they didn't log out previously
								$data_base->my_query("DELETE FROM `logged_in_users` WHERE `user_id` LIKE '$id'");
								$data_base->my_query("INSERT INTO `logged_in_users`(`session_id`, `user_id`, `user_name`, `status`) VALUES ('$session_id','$id','$user_name','$status')");
								header('Location: ./home_page.php');
							}
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
			}
			?>
			<form class="my_form" action="" method="POST">
				<div class="input_set">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" id="first_name" />
				</div>
				<div class="input_set">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" id="last_name" />
				</div>
				<div class="input_set">
					<label for="user_name">User Name</label>
					<input type="text" name="user_name" id="user_name" />
				</div>
				<div class="input_set">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" />
				</div>
				<div class="input_set">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" />
				</div>
				<div class="button_set">
					<input type="submit" name="submit" value="Send" id="submit" />
					<input type="reset" name="reset" value="Clear" id="clear" />
					<input type="submit" name="log_in" value="Log In" id="log_in" />
				</div>
			</form>
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