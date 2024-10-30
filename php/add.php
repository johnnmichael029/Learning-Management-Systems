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
    $errorMessage = "";

    include 'connection.php';

    // Check for POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentID = $_POST["studentID"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Check if the studentID and email already exist
        $sql = "SELECT * FROM users WHERE studentID = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $studentID, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Student ID or email already exists.";
            $_SESSION['status'] = "error";
        } else {
            // Prepare SQL query for inserting new student
            $sql = "INSERT INTO users (studentID, lastname, firstname, email, password) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $studentID, $lastname, $firstname, $email, $password);

            // Execute query
            if ($stmt->execute()) {
                $_SESSION['message'] = "New student successfully added!";
                $_SESSION['status'] = "success";
            } else {
                $_SESSION['message'] = "Failed to add student: " . $stmt->error;
                $_SESSION['status'] = "error";
            }
        }
    }
    ?>
    <?php
    if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
        echo "<script>
                swal({
                    title: '{$_SESSION['message']}',
                    icon: '{$_SESSION['status']}',
                    button: 'OK'

                }).then(() => {
                    window.location.href = 'admin.php';
                });
              </script>";
        unset($_SESSION['message'], $_SESSION['status']);
    }
    $conn->close();
    $stmt->close();
    exit();

    ?>
</body>

</html>