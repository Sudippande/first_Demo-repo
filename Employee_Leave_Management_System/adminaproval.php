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
        .admin{
            text-align: center;
            font-size: 1.5rem;
        }
        .nave{
    border: 1px solid black;
    text-decoration: none;
    font-size: 1.8rem;
    margin: 2px;
    margin-left: 40%;
    margin-right: 40%;
    padding: 3px;
    font-family: 'Courier New', Courier, monospace;
    font-weight: bolder;
    color: red;
    background-color: black;
    border-radius: 9px;
}
.nave:hover{
    background-color: white;
    color:red
  }
    </style>
</head>
<body>
    <div class="admin">
        <h1>Employee Requests</h1>
        <nav class="nave">
            <a href="login.php">Login</a>

        </nav>
    </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            include("DB_Connection.php");

            // Handle status updates
            if (isset($_POST['update_status'])) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                $username = $_POST['username'];

                $query = "UPDATE registration SET status='$status' WHERE id='$id'";
                if (mysqli_query($con, $query)) {
                    echo "<script>alert('Status updated to $status successfully.');</script>";

                    // Status update related leave requests
                    if ($status == 'Approved') {
                        $username = $_POST['username'];
                        $updateLeaveQuery = "UPDATE registration SET status='Approved' WHERE username='$username'";
                        mysqli_query($con, $updateLeaveQuery);
                    }
                } else {
                    echo "<script>alert('Error updating user status.');</script>";
                }
            }

            // Fetch pending login requests
            $query = "SELECT * FROM registration";
            $result = mysqli_query($con, $query) or die("Error fetching user requests.");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <form action='adminaproval.php' method='post' style='display:inline;'>

                              <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='hidden' name='username' value='{$row['username']}'>
                                <select name='status'>
                                    <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                                    <option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>
                                    <option value='Disapproved'" . ($row['status'] == 'Disapproved' ? ' selected' : '') . ">Disapproved</option>
                                </select>
                                <input type='submit' name='update_status' value='Update'>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No pending requests found.</td></tr>";
            }

            mysqli_close($con);
            ?>
        </table>
    </div>
<hr>

    <div class="retrieval">
        <h1>Leave Requests</h1>
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

            if (isset($_POST['update_leave_status'])) {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $query = "UPDATE db_leave SET status='$status' WHERE id='$id'";
                if (mysqli_query($con, $query)) {
                    echo "<script>alert('Leave request status updated to $status.');</script>";

                    // If the leave is approved, update the registration status as well
                    if ($status == 'Approved') {
                        $username = $_POST['username'];
                        $updateUserStatus = "UPDATE registration SET status='Approved' WHERE username='$username'";
                        mysqli_query($con, $updateUserStatus);
                    }
                } else {
                    echo "<script>alert('Error updating leave request status.');</script>";
                }
            }

            $query = "SELECT * FROM db_leave";
            $result = mysqli_query($con, $query) or die("Error retrieving leave requests.");

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
                            <form action='adminaproval.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='hidden' name='username' value='{$row['username']}'>
                                <select name='status'>
                                    <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                                    <option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>
                                    <option value='Disapproved'" . ($row['status'] == 'Disapproved' ? ' selected' : '') . ">Disapproved</option>
                                </select>
                                <input type='submit' name='update_leave_status' value='Update'>
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
