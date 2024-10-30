<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include "connection.php";

if (isset($_GET['studentID'])) {
    $id = $_GET['studentID'];
    $sql = "DELETE FROM users WHERE studentID = $id";
    $result = mysqli_query($conn, $sql);
}
header("Location: managestudent.php");
?>