<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <h1>Employee Login Form</h1>
        <nav class="nave">
            <a class="a" href="admin.php">Admin</a>
            <a class="a" href="registration.php">Registration</a>
        </nav>
        <form action="login.php" method="post">
            <label for="Username" class="username-sect">Username</label>:
            <input type="text" name="Username" placeholder="Username" required><br>
            <label for="Password" class="username-sect">Password</label>:
            <input type="password" name="Password" placeholder="Password" required>
            <button name="logbtn" value="Log in">Log in</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();
include "DB_Connection.php";

if (isset($_POST['logbtn'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    // Check if the user is registered
    $query = "SELECT * FROM registration WHERE username='$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == $password) {
            if ($row['status'] == 'Approved') {
                $_SESSION['username'] = $username;
                header("Location: leave_request.php");
                exit();
            } elseif ($row['status'] == 'Pending') {
                echo "<script>alert('Your account is Pending For approval.');</script>";
            } else {
                echo "<script>alert('Your account has been disapproved. Please contact admin.');</script>";
            }
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('You are not registered. Please register first.');</script>";
    }
}
?>
