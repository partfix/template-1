<?php
include 'conn.php';

$id = $_GET['id'];

mysqli_query($conn, "UPDATE registration SET attended='Yes' WHERE idNum='$id'");

header("Location: attendance.php");
?>