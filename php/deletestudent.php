<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include "connection.php";

if (isset($_GET['userID'])) {
    $id = $_GET['userID'];
    $sql = "DELETE FROM users WHERE userID = $id";
    $result = mysqli_query($conn, $sql);
}
header("Location: managestudent.php");
?>

