<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include necessary JS libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/sweetalert.js"></script>
</head>

<body>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "studentDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT userID, role, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with that email exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store userID and role in session
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on user role
                if ($user['role'] === 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: student.php");
                }
                exit();
            } else {
                $_SESSION['message'] = "Invalid email or password.";
                $_SESSION['status'] = "error";
            }
        } else {
            $_SESSION['message'] = "No user found with that email.";
            $_SESSION['status'] = "error";
        }

        $stmt->close();
    }

    $conn->close();

    // Display error message if exists
    if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
        echo "<script>
                swal({
                    title: '{$_SESSION['message']}',
                    icon: '{$_SESSION['status']}',
                    button: 'OK'
                }).then(() => {
                    // Redirect to the login page or stay on the current page
                    window.location.href = '../html/LoginForm.html'; // Update to your login page URL
                });
              </script>";
        unset($_SESSION['message'], $_SESSION['status']);
    }
    ?>
</body>

</html>