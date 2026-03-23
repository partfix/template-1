<?php
include 'conn.php';

$result = mysqli_query($conn, "
SELECT 
    campus,
    COUNT(*) as totalStudents,
    SUM(attended='Yes') as attendedCount,
    SUM(amountPaid) as totalMoney
FROM registration
GROUP BY campus
");

$totalStudents = 0;
$totalAttended = 0;
$totalMoney = 0;
?>

<h2>Summary Report</h2>

<table border="1">
<tr>
    <th>Campus</th>
    <th>Total Students</th>
    <th>Attended</th>
    <th>Total Collection</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
    $totalStudents += $row['totalStudents'];
    $totalAttended += $row['attendedCount'];
    $totalMoney += $row['totalMoney'];
?>
    <tr>
        <td><?php echo $row['campus']; ?></td>
        <td><?php echo $row['totalStudents']; ?></td>
        <td><?php echo $row['attendedCount']; ?></td>
        <td><?php echo $row['totalMoney']; ?></td>
    </tr>
    <?php 
} ?>
</table>

<br>

<h3>OVERALL TOTAL</h3>
Total Students: <?php echo $totalStudents; ?> <br>
Total Attended: <?php echo $totalAttended; ?> <br>
Total Collection: <?php echo $totalMoney; ?> <br>

<br>
<a href="index.php">Back to Menu</a>