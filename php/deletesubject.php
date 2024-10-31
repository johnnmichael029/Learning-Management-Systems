<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include "connection.php";

if (isset($_GET['subjectID'])) {
    $id = $_GET['subjectID'];
    $sql = "DELETE FROM applied_subjects WHERE subjectID = $id";
    $result = mysqli_query($conn, $sql);
}
header("Location: managesubject.php");
?>