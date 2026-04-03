<?php
include 'conn.php';

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $campus = $_POST['campus'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $amount = $_POST['amount'];

    // CHECK if ID already exists = true, also sql is not case senstive.
    $check = mysqli_query($conn, "SELECT * FROM registration WHERE idNum='$id'"); 

    if(mysqli_num_rows($check) > 0){ // mean if it's existing
        echo "Error: ID already registered!";
    } else {
        $sql = "INSERT INTO registration VALUES ('$id','$campus','$fname','$lname','$amount','No')";

        if(mysqli_query($conn, $sql)){
            // REDIRECT AFTER INSERT
            header("Location: studRegistration.php?success=1");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>
<h2>Student Registration</h2>

<?php
    //url direction if successs.
    if(isset($_GET['success'])){  
        echo "Registered Successfully!";
    }
?>


<form method="POST">
    ID: <input type="text" name="id"><br><br>
    Campus: <select name="campus">
    <option value="University of Cebu-Main">University of Cebu-Main</option>
    <option value="University of Cebu-Banilad">University of Cebu-Banilad</option>
    <option value="University of Cebu-LM">University of Cebu-LM</option>
    <option value="University of Cebu-PT">University of Cebu-PT</option>
    </select>
    <br><br>
    First Name: <input type="text" name="fname"><br><br>
    Last Name: <input type="text" name="lname"><br><br>
    Amount: <input type="text" name="amount"><br><br>

    <button type="submit" name="submit">Register</button>
</form>

<br>
<a href="index.php">Back to Menu</a>

<h3>Registered Students</h3>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Campus</th>
    <th>Amount</th>
    <th>Actions</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM registration");

while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['IdNum']; ?></td>
    <td><?php echo $row['studFName']. "".$row['studLName']; ?></td>
    <td><?php echo $row['campus']; ?></td>
    <td><?php echo $row['amountPaid']; ?></td>
    <td>
        <a href="edit.php?id=<?php echo $row['IdNum']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $row['IdNum']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>