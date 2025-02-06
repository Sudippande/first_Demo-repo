<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
    <h1>Admin Login Form </h1>
    <nav class="nave">
            <a class="a" href="login.php">Login</a>
            <a class="a" href="registration.php">Registration</a>
        </nav>
    <form action="admin.php" method="post">
        <label for="Username"class="username-sect">Username</label>:
       <input type="text" name="username" placeholder="Admin Username" required><br><br>
       <label for="Password"class="username-sect">Password</label>:
       <input type="password" name="password" placeholder="Admin password" required>
        <button name="adminbtn" value="Login" >Log in</button>
    </form>
    </div>
</body>
</html>
<?php
include "DB_Connection.php";
if(isset($_POST['adminbtn']))
{
    $_uname='sudip';
    $_pswd='123';
    $username = $_POST['username'];
    $password=$_POST['password'];
    if($_uname==$username && $_pswd==$password)
    {
       
         header("Location:adminaproval.php"); 
    }
    else{
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
 ?>
