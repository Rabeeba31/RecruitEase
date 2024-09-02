<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $type = $_POST['type'];

    $sql = "";

    // Select the password based on the login type
    if ($type === "Student") {
        $sql = "SELECT pwd FROM students WHERE email = '$uname'";
    } elseif ($type === "Company") {
        $sql = "SELECT pwd FROM company WHERE email = '$uname'";
    } elseif ($type === "Hod") {
        $sql = "SELECT pwd FROM hods WHERE email = '$uname'";
    } elseif ($type === "Admin" && $pwd === "lbscek" && $uname === "admin@abc.com") {
        $_SESSION['email'] = $uname;
        header('Location: admin_dash.php');
        exit;
    } else {
        echo "<script>alert('Wrong username or password');</script>";
        echo "<script>window.location.replace('index.html');</script>";
        exit;
    }

    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["pwd"] === $pwd) {
            $_SESSION['email'] = $uname;

            if ($type === "Student") {
                echo "<script>window.location.replace('student_dash.php');</script>";
            } elseif ($type === "Company") {
                echo "<script>window.location.replace('company_dash.php');</script>";
            } elseif ($type === "Hod") {
                echo "<script>window.location.replace('hodverify.php');</script>";
            }

            exit;
        } else {
            echo "<script>alert('Wrong password');</script>";
            echo "<script>window.location.replace('index.html');</script>";
            exit;
        }
    } else {
        echo "<script>alert('User does not exist');</script>";
        echo "<script>window.location.replace('index.html');</script>";
        exit;
    }
}

$conn->close();

?>
