<?php
include 'connection.php';

// Read all rows from database table
$sql = "SELECT * FROM applied_subjects";
$result = mysqli_query($conn, $sql);

$totalUsers = 0;
if ($result) {
    $row = $result->fetch_assoc();
    $totalUsers = $result->num_rows;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
