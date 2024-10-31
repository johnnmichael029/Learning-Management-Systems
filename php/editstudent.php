<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentID'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET lastname = ?, firstname = ?, email = ?, password = ? WHERE studentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $lastname, $firstname, $email, $password, $studentID);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
if (!$stmt->execute()) {
    echo "Error updating record: " . $stmt->error; // This will give you more detail
}
error_log("Student ID: $studentID");
error_log("Last Name: $lastname");
error_log("First Name: $firstname");
error_log("Email: $email");
error_log("Password: $password");
