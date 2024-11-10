<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f9;
			color: #333;
			display: flex;
			flex-direction: column;
			align-items: center;
			margin: 0;
			padding: 20px;
		}
		h1 {
			color: #444;
			font-size: 2em;
			margin-bottom: 10px;
		}
		form {
			background-color: #fff;
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 20px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			width: 300px;
			text-align: center;
		}
		p {
			margin: 10px 0;
		}
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
			font-size: 1.2em;
			color: #555;
		}
		input[type="text"],
		input[type="password"] {
			font-size: 1em;
			width: 100%;
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}
		input[type="submit"] {
			font-size: 1.2em;
			padding: 10px;
			width: 100%;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			margin-top: 15px;
		}
		input[type="submit"]:hover {
			background-color: #45a049;
		}
		a {
			color: #4CAF50;
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}
		.message {
			color: red;
			font-size: 1.2em;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 class="message"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>
	<h1>Login Now!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="usernames">
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="passwords">
			<input type="submit" name="loginUserBtn">
		</p>
	</form>
	<p>Don't have an account? You may register <a href="register.php">here</a></p>
</body>
</html>