
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 
	<link rel="stylesheet" href="../src/CSS/style.css">
	<script src="../src/JS/main.js" defer></script>
</head>
<body>
<center>
        <br>
		<br>
		<br>
	    <h3>Login</h3>
		<?php if (isset($error_message)): ?>
			<p><?php echo $error_message; ?></p>
		<?php endif; ?>
        <form method="post" action="login.php" style="width: 100vh;">
            <label>Username:</label><br>
            <input  class="form-control"  type="text" name="username" placeholder="Enter your Username" required>
            <br>
            <label>Password:</label><br>
            <input class="form-control" type="password" name="password" placeholder="Enter your Password" required >
            <br>
            <button type="submit" class="btn btn-dark">Login</button>
        </form>
	</center>
</body>
</body>
</html>


<?php
	
	include("C:/xampp/htdocs/swe322/db_login.php");


	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		
		$username = $_POST["username"];
		$password = $_POST["password"];

		
		$sql = "SELECT * FROM user_account WHERE username = '$username'";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			
			// Get user data from database
			$row = $result->fetch_assoc();
			$user_id = $row["user_id"];
			$hashed_password = $row["password"];



			
			if (password_verify($password, $hashed_password)) {
				
				// Password is correct, start session and redirect to dashboard
				header("Location: /swe322/user.php");
				exit();
			} else {
				// Password is incorrect, show error message
				$error_message = "Invalid password";



			}

		} else {
			
			// User does not exist, show error message
			$error_message = "Invalid username";

		}

	}

?>