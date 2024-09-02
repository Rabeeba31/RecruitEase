<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="CSS/style1.css">
		<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

		<nav class="navbar navbar-fixed-top" id="top-nav">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand"  href="#">Campus Recruitment System</a>
				</div>
				<ul id="list1" class="nav navbar-nav">
					<li class="active"><a href="index.html">Home</a></li>
					<li class="active"><a href="index.html">Logout</a></li>
					
					
				</ul>
			</div>
		</nav>
				
    <title>HOD Verification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class=" container-fluid" id="dash">
		  <div class="row">
		    <div class="well col-sm-12" style="background-color: #AED4F1 ; height:auto; margin:10px;">
		
    <div class="container">
        <h2>HOD Verification</h2>
             
			  
			  <br>
			  <br>
			  <div>

        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify'])) {
            $student_id = $conn->real_escape_string($_POST['student_id']);

            // Update query with prepared statement
            $sql_update = "UPDATE students SET cgpa_verified = 1 WHERE id = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("i", $student_id); // "i" for integer
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>CGPA Verified Successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating record: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }

        // Select students who are not yet verified
        $sql = "SELECT * FROM students WHERE cgpa_verified = 0 && email = '$hod_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>CGPA</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['cgpa'] . "</td>";
                echo "<td>
                        <form method='POST' action='hod_verify.php'>
                            <input type='hidden' name='student_id' value='" . $row['id'] . "'>
                            <button type='submit' name='verify' class='btn btn-success'>Verify</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='alert alert-info'>No CGPA verification pending.</div>";
        }

        $conn->close();
        ?>
    </div>
    			
			</div>
		  </div>
		</div> 
 </div>
</body>
</html>
