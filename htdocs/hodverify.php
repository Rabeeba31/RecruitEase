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
                <a class="navbar-brand" href="#">Campus Recruitment System</a>
            </div>
            <ul id="list1" class="nav navbar-nav">
                <li class="active"><a href="index.html">Home</a></li>
                <li class="active"><a href="index.html">Logout</a></li>
            </ul>
        </div>
    </nav>

    <title>CGPA Verification</title>
</head>
<body>
    <div class="container">
        <h2>CGPA Verification</h2>
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

        // Check if session variable 'email' is set (Hod logged in)
        if (!isset($_SESSION['email'])) {
            echo "<div class='alert alert-danger'>Access Denied! Please login.</div>";
            exit;
        }

        // Fetch Hod's department from the database using session email
        $hod_email = $_SESSION['email'];
        $sql_hod = "SELECT department FROM hods WHERE email = '$hod_email'";
        $result_hod = $conn->query($sql_hod);

        if ($result_hod->num_rows > 0) {
            $row_hod = $result_hod->fetch_assoc();
            $hod_department = $row_hod['department'];

            // Select students of the Hod's department who are not yet verified
            $sql = "SELECT * FROM students WHERE branch = '$hod_department' AND cgpa_verified = 0";
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
                echo "<div class='alert alert-info'>No CGPA verification pending for students in your department.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error: Hod department not found.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
