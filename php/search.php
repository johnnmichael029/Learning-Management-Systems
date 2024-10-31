<?php
include 'connection.php';

if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $sql = "SELECT * FROM users WHERE studentID LIKE '%$input%' OR lastname LIKE '%$input%' OR firstname LIKE '%$input%' OR email LIKE '%$input%'";
    $result = mysqli_query($conn, $sql);

    $response = "";
    $totalCount = $result->num_rows;

    if ($totalCount > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response .= "<tr>
                            <td>{$row['studentID']}</td>
                            <td>{$row['lastname']}</td>
                            <td>{$row['firstname']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['password']}</td>
                          </tr>";
        }
    } else {
        $response = "<tr><td colspan='5'>No students found.</td></tr>";
    }

    // Send JSON response
    echo json_encode(['html' => $response, 'count' => $totalCount]);
    $conn->close();
}
