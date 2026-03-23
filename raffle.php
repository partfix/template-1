<?php
include 'conn.php';

$students = [];

if(isset($_POST['campus'])){
    $campus = $_POST['campus'];

    if($campus != ''){
        $result = mysqli_query($conn, "SELECT * FROM registration WHERE attended='Yes' AND campus='$campus'");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM registration WHERE attended='Yes'");
    }

    // store results into array
    while($row = mysqli_fetch_assoc($result)){
        $students[] = $row;
    }

    // pick random winner
    if(count($students) > 0){
        $winner = $students[array_rand($students)];
    }
}
?>

<h2>Raffle Winner</h2>

<form method="POST">
    Select Campus:
  Campus:<br>

<input type="checkbox" name="campus" value=""> All<br>
<input type="checkbox" name="campus" value="University of Cebu-Main"> University of Cebu-Main<br>
<input type="checkbox" name="campus" value="University of Cebu-Banilad"> University of Cebu-Banilad<br>
<input type="checkbox" name="campus" value="University of Cebu-LM"> University of Cebu-LM<br>
<input type="checkbox" name="campus" value="University of Cebu-PT"> University of Cebu-PT<br><br>

    <button type="submit">Pick Winner</button>
</form>

<br>

<?php
// DISPLAY WINNER
if(isset($winner)){
    echo "<h3>CONGRATULATIONS!!!</h3>";
    echo "ID: " . $winner['IdNum'] . "<br>";
    echo "Name: " . $winner['studFName'] . " " . $winner['studLName'] . "<br>";
    echo "Campus: " . "<b>". $winner['campus']. "<b>" . "<br>";
} else if(isset($_POST['campus'])){
    echo "No attendees found.";
}
?>

<br>
<a href="index.php">Back to Menu</a>