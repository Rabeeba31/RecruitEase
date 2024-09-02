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
					<li class="active"><a href="company_dash.php">Back</a></li>
					
				</ul>
			</div>
		</nav>

    <meta charset="UTF-8">
    <title>Edit Company Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style1.css">
</head>
<body>
    <div class="container">
        <h2>Edit Company Details</h2>
        <?php
        session_start();
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and update company information
            $name = $conn->real_escape_string($_POST['name']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $ceo = $conn->real_escape_string($_POST['ceo']);
            $cto = $conn->real_escape_string($_POST['cto']);
            $hr = $conn->real_escape_string($_POST['hr']);
            $email = $_SESSION['email'];

            $sql = "UPDATE company SET name='$name', phone='$phone', ceo='$ceo', cto='$cto', hr='$hr' WHERE email='$email'";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Record updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
            }
        }

        // Fetch current company details
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM company WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="name">Company Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Contact No.:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="ceo">CEO:</label>
                    <input type="text" class="form-control" id="ceo" name="ceo" value="<?php echo $row['ceo']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="cto">CTO:</label>
                    <input type="text" class="form-control" id="cto" name="cto" value="<?php echo $row['cto']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="hr">HR:</label>
                    <input type="text" class="form-control" id="hr" name="hr" value="<?php echo $row['hr']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <?php
        } else {
            echo "<div class='alert alert-warning'>No record found</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
