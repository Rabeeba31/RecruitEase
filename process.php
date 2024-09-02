<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and sanitize inputs
    $companyName = mysqli_real_escape_string($conn, $_POST['companyName']);
    $arrivalTime = mysqli_real_escape_string($conn, $_POST['arrivalTime']);

    // SQL query to insert data into database
    $sql = "INSERT INTO company_arrival (company_name, arrival_time)
            VALUES ('$companyName', '$arrivalTime')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
