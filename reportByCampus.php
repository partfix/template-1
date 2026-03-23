<?php
include 'conn.php';

// default query
$query = "SELECT * FROM registration";

// if filter is used
if(isset($_POST['filter']) && $_POST['campus'] != ''){
    $campus = $_POST['campus'];
    $query = "SELECT * FROM registration WHERE campus='$campus'";
}

$result = mysqli_query($conn, $query);
?>

<h2>Report By Campus</h2>

<form method="POST">
    Select Campus:
    <select name="campus">
        <option value="">All</option>
        <option value="University of Cebu-Main">University of Cebu-Main</option>
        <option value="University of Cebu-Banilad">University of Cebu-Banilad</option>
        <option value="University of Cebu-LM">University of Cebu-LM</option>
        <option value="University of Cebu-PT">University of Cebu-PT</option>
    </select>

    <button name="filter">Generate</button>
</form>

<br>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Campus</th>
    <th>Amount</th>
    <th>Attended</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php echo $row['IdNum']; ?></td>
    <td><?php echo $row['studFName']." ".$row['studLName']; ?></td>
    <td><?php echo $row['campus']; ?></td>
    <td><?php echo $row['amountPaid']; ?></td>
    <td><?php echo $row['attended']; ?></td>
</tr>
<?php } ?>
</table>

<br>
<a href="index.php">Back to Menu</a>