<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
    <style>
    </style>
  
    
</head>
<body >
    <div class="login">
    <h1>Employee Login Form </h1>
    <nav class="nave">
            <a class="a" href="admin.php">Admin</a>
            <a class="a" href="registration.php">Registration</a>
        </nav>
    <form  action="login.php" method="post">
    <label for="Username"class="username-sect">Username</label>:
       <input type="text" name="Username" placeholder="Username" required><br>
       <label for="Password"class="username-sect">Password</label>:
       <input type="password" name="Password" placeholder="Password" required>
       <button name="logbtn" value="Log in">Log in</button>
       
    
        
    </form>
    </div>

        
    </form>
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
                echo "<script>alert('Your account is pending wait for admin approval.');</script>";
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

apache_child_terminate<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    </style>
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
        <button name="adminbtn" value="Login">Log in</button>
        
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



admin approved
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Leave Request Retrieval</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="retrieval">
    <div class="login">
    <h1>Registration Form</h1>
          <nav class="nave">
             <a class="a" href="login.php">Login</a>
             <a class="a" href="registration.php">Registration</a>
         </nav>
    </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            include("DB_Connection.php");
            if (isset($_POST['update_status'])) {
                $id = $_POST['id'];
                $status = $_POST['status'];
            
                $query = "UPDATE db_leave SET status='$status' WHERE id='$id'";
                mysqli_query($con, $query) or die("Retrieval Error");
            
                // If the leave is approved, update the registration status as well
                if ($status == 'Approved') {
                    $username = $_POST['username'];
                    $updateUserStatus = "UPDATE registration SET status='Approved' WHERE username='$username'";
                    mysqli_query($con, $updateUserStatus) or die("Error updating user status");
                }
            
                echo "<script>alert('Status updated successfully');</script>";
            }
            $query = "SELECT * FROM db_leave";
            $result = mysqli_query($con, $query) or die("Retrival Error");
            // echo"<table border='1'>";
            // while($arr=mysqli_fetch_assoc($result))
            // {
            //     echo "<tr>";
            //     foreach($arr as $value)
            //     {
            //         echo "<td>$value</td>";
            //     }
            //     echo"</tr>";
            // }
            // echo"</table>";

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['leave_type']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['end_date']}</td>
                        <td>{$row['reason']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <form action='updatestatus.php' method='post'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <select name='status'>
                                    <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                                    <option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>
                                    <option value='Disapproved'" . ($row['status'] == 'Disapproved' ? ' selected' : '') . ">Disapproved</option>
                                </select>
                                <input type='submit' value='Update'>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No leave requests found.</td></tr>";
            }

            mysqli_close($con);
            ?>
        </table>
    </div>
   

</body>
</html>

