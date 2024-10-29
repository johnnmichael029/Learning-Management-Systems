<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Add New Student</title>

    <!-- Include necessary JS libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/sweetalert.js"></script>
</head>

<body>
    <?php
    // Start session
    session_start();
    include 'admin.php';

    // Initialize variables
    $studentID = $firstname = $lastname = $email = $password = "";
    $errorMessage = $successMessage = "";

    // Database connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check for POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentID = $_POST["studentID"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Prepare SQL query for inserting new student
        $sql = "INSERT INTO users (studentID, lastname, firstname, email, password) 
                VALUES ('$studentID', '$lastname', '$firstname', '$email', '$password')";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "New student successfully added!";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['message'] = "Failed to add student.";
            $_SESSION['status'] = "error";
        }
        exit();
    }
    ?>

</body>

</html>