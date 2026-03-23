<?php
include 'conn.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM registration WHERE IdNum='$id'");


header("Location: studRegistration.php");
?>