<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 
	<!--Script Link  put befor end of </body> -->
	<link rel="stylesheet" href="../src/CSS/style.css">
	<script src="../src/JS/main.js" defer></script>
</head>
<body>
    <center>
        <br>
		<br>
		<br>
	    <h3>Register</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="width: 100vh;">
            <label>Username:</label><br>
            <input  class="form-control"  type="text" name="username" id="username" placeholder="Enter your Username" required>
            <br>
            <label>Email:</label><br>
            <input class="form-control" type="email" name="email" id="email" placeholder="Enter your Email" required><br>
            <label>Password:</label><br>
            <input class="form-control" type="password" name="password" id="password" placeholder="Enter your Password" required >
            <br>
            <button type="submit" class="btn btn-dark">Login</button>
        </form>
	</center>
	<?php
		// Check if form is submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Get form data
			$user = $_POST["username"];
			$email = $_POST["email"];
			$pass = $_POST["password"];
			
			// Hash password
			$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
			
			// Connect to database
			include("C:/xampp/htdocs/swe322/db_login.php");
			
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			// Insert user data into database
			$sql = "INSERT INTO user_account (username, email, password) VALUES ('$user', '$email', '$hashed_password')";
			
			if ($conn->query($sql) === TRUE) {
				echo "<p>User registered successfully!</p>";
				// Redirect to login page
				header("Location: login.php");
				exit();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			
			$conn->close();
		}
	?>

</body>
</html>