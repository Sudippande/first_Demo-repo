<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
    <h1>Registration Form</h1>
          <nav class="nave">
            <a class="a" href="admin.php">Admin</a>
             <a class="a" href="login.php">Login</a>
         </nav>
    
    <form action="registration.php" method="post">
        <label for="Username"class="username-sect">Username</label>:
        <input type="text" name="username" placeholder="Username" required><br>
        <label for="Designation"class="username-sect">Designation</label>:
        <input type="text" name="designation" placeholder="Designation"><br>
        <label for="Address"class="username-sect">Address</label>
        <input type="text" name="address" placeholder="Address"><br>
        <label for="Email"class="username-sect">Email</label>:
        <input type="email" name="email" placeholder="Email"><br>
        <label for="Password"class="username-sect">Password</label>:
        <input type="password" name="password" placeholder="password">
        <button name="regbtn" value="register">Register</button>
    </form>
    </div>
</body>
</html>
<?php 
 include "DB_Connection.php";
if(isset($_POST['regbtn']))
{
    $username= $_POST['username'];
    $designation=$_POST['designation'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $password=$_POST['password'];
   
   
$insert="insert into registration(username,designation,address,email,password) VALUES ('$username','$designation','$address','$email','$password')"; 
mysqli_query($con,$insert) or die("<script>alert('Registration  Not Successful');</script>");
echo "<script>alert('Registration Successful');</script>";

}
?>

