<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if "placed" checkbox is checked
    if (isset($_POST["placed"]) && $_POST["placed"] == "on") {
        // Initialize variables to store form data
        $student_name = $email = $company_name = $image_file = $id_card = $address = "";

        // Validate and sanitize form inputs
        if (isset($_POST["student_name"])) {
            $student_name = htmlspecialchars($_POST["student_name"]);
        }
        if (isset($_POST["email"])) {
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        }
        if (isset($_POST["company_name"])) {
            $company_name = htmlspecialchars($_POST["company_name"]);
        }
        if (isset($_POST["address"])) {
            $address = htmlspecialchars($_POST["address"]);
        }

        // Handle file uploads
        $image_file = $_FILES["image_file"]["name"];
        $id_card = $_FILES["id_card"]["name"];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'project');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data using prepared statement
        $stmt = $conn->prepare("INSERT INTO student_info (student_name, email, company_name, address, image_file, id_card) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("ssssss", $student_name, $email, $company_name, $address, $image_file, $id_card);

        // Execute SQL query
        if ($stmt->execute()) {
            echo "Student information uploaded successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close prepared statement and database connection
        $stmt->close();
        $conn->close();

    } else {
        echo "You are not placed. Student information not uploaded.";
    }
} else {
    // If the form is not submitted, redirect back to the form page
    header("Location: your_form_page.php");
    exit();
}
?>
