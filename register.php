<?php
include "conn.php";

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists
    $check = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already taken!";
    } else {

        // Insert new user
        $query = "INSERT INTO users (username, password) 
                  VALUES ('$username', '$password')";

        if (mysqli_query($conn, $query)) {
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>



<h2>Register</h2>

<form method="POST" >
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="register">Register</button>
</form>