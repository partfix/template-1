<?php
include 'conn.php';

if(isset($_POST['check'])){
    $id = $_POST['id'];

    $check = mysqli_query($conn, "SELECT * FROM registration WHERE idNum='$id'");

    if(mysqli_num_rows($check) == 0){
        echo "ID NOT REGISTERED";
    } else {
        $row = mysqli_fetch_assoc($check);

        if($row['attended'] == "Yes"){
            echo "ALREADY ATTENDED";
        } else {
            mysqli_query($conn, "UPDATE registration SET attended='Yes' WHERE idNum='$id'");
            echo "Attendance Recorded!";
        }
    }
}
?>

<h2>Attendance</h2>

<form method="POST">
    Enter ID: <input type="text" name="id">
    <button name="check">Submit</button>
</form>

<br>
<a href="index.php">Back to Menu</a>

<?php
$result = mysqli_query($conn, "SELECT * FROM registration ");

echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Campus</th>
    <th>Amount</th>
    <th>Action</th>
</tr> ";

while($row = mysqli_fetch_assoc($result)){
    echo "
    <tr>
        <td>".$row['IdNum']."</td>
        <td>".$row['studFName']." ".$row['studLName']."</td>
        <td>".$row['campus']."</td>
        <td>".$row['amountPaid']."</td>
        <td>";

    if($row['attended'] == "No"){
        echo "<a href='markAttend.php?id=".$row['IdNum']."'>Attend</a>";
    } else {
        echo "Attended";
    }

    echo "</td></tr>";
}
echo "</table>";
?>