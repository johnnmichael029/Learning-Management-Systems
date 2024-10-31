<?php
include 'connection.php';

// Read all rows from database table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$response = "";
$totalCount = $result->num_rows;
if ($result && $result->num_rows > 0) {
    // Fetch data for each row
    while ($row = $result->fetch_assoc()) {
        $response .= "<tr>
                                                    <td>{$row['studentID']}</td>
                                                    <td>{$row['lastname']}</td>
                                                    <td>{$row['firstname']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>{$row['password']}</td>
                                                 </tr>";
    }
} else {
    $response .= "<tr><td colspan='5'>No students found.</td></tr>";
}
echo json_encode(['html' => $response, 'count' => $totalCount]);
$conn->close();
