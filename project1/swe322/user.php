<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<link rel="stylesheet" href="../src/CSS/style.css">
    <script src="../src/JS/main.js" defer></script>
	<title>Gym Classes</title>
</head>
<body>
<center>
	<h1>Gym Classes</h1>

    <?php
include("C:/xampp/htdocs/swe322/db_login.php");

if (!$conn) {
    echo "Debugging errno: " . mysqli_connect_errno();
    echo "<br>";
    echo "Debugging error: " . mysqli_connect_error();
    exit;
}

$query = "SELECT * from classes";

$result = mysqli_query($conn, $query);

if ($result) {
    echo '<div class="container">';
    echo    '<table class="table table-striped table-dark">';
    echo        '<thead>';
    echo            '<tr>';
    echo            '<th scope="col">#</th>';
    echo            '<th scope="col">Trainer Name</th>';
    echo            '<th scope="col">Start Date</th>';
    echo            '<th scope="col">Bookings</th>';
    echo            '<th scope="col">Max Trainees</th>';
    echo            '</tr>';
    echo        '</thead>';
    echo        '<tbody>';

    while ($result_row = mysqli_fetch_row($result)) {
        $class_id = $result_row[0];
        $bookings_query = "SELECT COUNT(*) FROM bookings WHERE class_id = $class_id";
        $bookings_result = mysqli_query($conn, $bookings_query);
        $bookings_count = mysqli_fetch_row($bookings_result)[0];

        echo "<tr>";
        echo "<td>$result_row[0] </td>";
        echo "<td>$result_row[1] </td>";
        echo "<td> $result_row[2] </td>";
        echo "<td>$bookings_count</td>";
        echo "<td>$result_row[4] </td>";
        echo "</tr>";
    }

    echo        '</tbody>';
    echo    '</table>';
    echo '</div>';
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
	<form action="user.php" method="post">
        <div class="dropdown">
		<select name="class" id="class">
			<?php
				// Query the database for available classes to register
				$sql = "SELECT * FROM classes WHERE number_of_trainees < max_num_of_trainees";
				$result = mysqli_query($conn, $sql);
				echo "<option value=''>" . '-- chose a trainer --' . "</option>";
				// Display available classes in a dropdown list
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<option value='" . $row["class_id"] . "'>" . $row["trainer_name"] . "</option>";
				}
			?>
		</select>
        </div>
        <br>
		<button class="btn btn-dark" type="submit" >Register</button>
	</form>
</center>
	<?php
        
    //

		// If the user has registered for a class, update the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the selected class ID from the form data
            $class_id = $_POST["class"];
    
          include("C:/xampp/htdocs/swe322/db_login.php");
    
            // Check for errors
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            try {
            // Update the counter for the selected class
            $sql = "UPDATE classes SET number_of_trainees = number_of_trainees + 1 WHERE class_id = " . $class_id;
            if ($conn->query($sql) === TRUE) {
                mysqli_query($conn, "INSERT INTO bookings (class_id) VALUES ($class_id)");
                echo "";

            } else {
                echo "Error updating class counter: " . $conn->error;
            }
            // Close the database connection
            $conn->close();
            
            header("Refresh:0");
        } catch (Exception $e){
            echo "";
        }
        }
	?>
</body>
</html>