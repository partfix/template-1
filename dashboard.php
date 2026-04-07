<?php
session_start();
include "conn.php";

// ✅ Protect page (must login first)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ✅ Search
$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    
    $query = "SELECT * FROM registration 
            WHERE IdNum LIKE '%$search%' 
            OR studFName LIKE '%$search%' 
            OR studLName LIKE '%$search%'";
} else {
    $query = "SELECT * FROM registration";
}

$result = mysqli_query($conn, $query);
?>

<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<a href="logout.php">Logout</a>
<br/>
<br/>


<!-- ✅ Search Form -->
<form method="GET">
    <input type="text" name="search" placeholder="Search ID or Name" value="<?php echo $search; ?>">
    <button type="submit">Search</button>
</form>

<br>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Campus</th>
    <th>Amount</th>
    <th>Actions</th>
</tr>

<?php 
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['IdNum']; ?></td>
    <td><?php echo $row['studFName'] . " " . $row['studLName']; ?></td>
    <td><?php echo $row['campus']; ?></td>
    <td><?php echo $row['amountPaid']; ?></td>
    <td>
        <a href="edit.php?id=<?php echo $row['IdNum']; ?>">Edit</a> 
        <a href="delete.php?id=<?php echo $row['IdNum']; ?>">Delete</a>
    </td>
</tr>
<?php } 
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
?>

</table>