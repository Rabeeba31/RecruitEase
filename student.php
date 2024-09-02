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
					
				</ul>
			</div>
		</nav>
        </head>
	
	<body>
	 <h2 align="center">CGPA VERIFICATION</h2>
		<div class=" container-fluid" id="dash">
		  <div class="row">
		    <div class="well col-sm-4" style="background-color: #AED4F1 ; height:auto; margin:10px;">
	
<?php
if(isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $branch = $_POST['branch'];
    $year = $_POST['year'];
    $cgpa = $_POST['cgpa'];
    $twp = $_POST['twp'];
    $tenp = $_POST['tenp'];
    $pwd = $_POST['pwd'];
    $supply = $_POST['supply'];
    $phone = $_POST['phone'];
    $degree = $_POST['degree'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO students (name, email, dob, branch, year, cgpa, twp, tenp, pwd, supply, phone, degree, cgpa_verified) 
            VALUES ('$name', '$email', '$dob', '$branch', '$year', '$cgpa', '$twp', '$tenp', '$pwd', '$supply', '$phone', '$degree', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. Awaiting CGPA verification.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
 </div>
		  </div>
		</div>


	</body>
