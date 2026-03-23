<?php
include 'conn.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM registration WHERE idNum='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $campus = $_POST['campus'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $amount = $_POST['amount'];

    mysqli_query($conn, "UPDATE registration SET 
        campus='$campus',
        studFName='$fname',
        studLName='$lname',
        amountPaid='$amount'
        WHERE idNum='$id'
    ");

    header("Location: studRegistration.php");
}
?>

<h2>Edit Student</h2>

<form method="POST">
Campus:<select name="campus">
    <option value="University of Cebu-Main">University of Cebu-Main</option>
    <option value="University of Cebu-Banilad">University of Cebu-Banilad</option>
    <option value="University of Cebu-LM">University of Cebu-LM</option>
    <option value="University of Cebu-PT">University of Cebu-PT</option>
</select><br><br>
    First Name: <input type="text" name="fname" value="<?php echo $row['studFName']; ?>"><br><br>
    Last Name: <input type="text" name="lname" value="<?php echo $row['studLName']; ?>"><br><br>
    Amount: <input type="text" name="amount" value="<?php echo $row['amountPaid']; ?>"><br><br>

    <button name="update">Update</button>
</form>