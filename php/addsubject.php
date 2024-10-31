<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>

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
    include 'connection.php'; // Ensure this file connects to your database
    include 'student.php'; // Ensure this file contains the HTML structure for the student page

    // Initialize variables
    $subjectCode = $subjectName = $professor = $time = $timeOut = "";

    // Check for POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subjectCode = $_POST["subjectCode"];
        $subjectName = $_POST["subjectName"];
        $professor = $_POST["professor"];
        $time = $_POST["time"];
        $timeOut = $_POST["timeOut"];

        // Log the subject code for debugging
        error_log("Subject Code: " . $subjectCode);

        // Check if the subject code already exists
        $sql = "SELECT * FROM applied_subjects WHERE subjectCode = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $subjectCode);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Subject code already exists.";
            $_SESSION['status'] = "error";
        } else {
            // Prepare SQL query for inserting new subject
            $sql = "INSERT INTO applied_subjects (subjectCode, subjectName, professor, time, timeOut) 
                VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("sssss", $subjectCode, $subjectName, $professor, $time, $timeOut);

            // Execute query
            if ($stmt->execute()) {
                $_SESSION['message'] = "New Subject successfully added!";
                $_SESSION['status'] = "success";
            } else {
                $_SESSION['message'] = "Failed to add subject: " . $stmt->error;
                $_SESSION['status'] = "error";
            }
        }
    }

    // Display alert message
    if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
        echo "<script>
            swal({
                title: '{$_SESSION['message']}',
                icon: '{$_SESSION['status']}',
                button: 'OK'
            }).then(() => {
                window.location.href = 'student.php';
            });
          </script>";
        unset($_SESSION['message'], $_SESSION['status']);
    }

    $conn->close();

    ?>
</body>

</html>