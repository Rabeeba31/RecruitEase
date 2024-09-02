<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
session_start();
$job_id = $_GET['job_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement with a parameter placeholder
$sql = "SELECT * FROM vacancy WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind the parameter to the placeholder
$stmt->bind_param("i", $job_id);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

echo "<div class=\"table-responsive table-bordered\">            
        <table class=\"table table-hover\">
        <tr>
            <th>Job Title</th>
            <th>Salary</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row['job_title']."</td>
            <td>".$row['salary']."</td>
          </tr>";
}

echo "</table></div>";

// Close the statement and connection
$stmt->close();
$conn->close();
?>
