<?php
session_start(); // Start the session
include("DB_Connection.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username']; // Get the username from the session

// Get the current date
$current_date = date("Y-m-d");

// Initialize an error message variable
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side validation
    if (empty($_POST['leave_type']) || empty($_POST['start_date']) || empty($_POST['end_date']) || empty($_POST['reason'])) {
        $error_message = "Please fill in all fields.";
    } else {
        // If all fields are filled, proceed with form submission
        $leave_type = $_POST['leave_type'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];

        // Prepare the SQL query to insert the leave request
        $query = "INSERT INTO db_leave(username, leave_type, start_date, end_date, reason, status) 
                  VALUES ('$username', '$leave_type', '$start_date', '$end_date', '$reason', 'Pending')";
        mysqli_query($con, $query) or die("Connection Error!");

        echo "<script>alert('Leave request submitted successfully');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <link rel="stylesheet" href="style.css">
  
    <script>
        function validateForm() {
            let leave_type = document.forms["leaveForm"]["leave_type"].value;
            let start_date = document.forms["leaveForm"]["start_date"].value;
            let end_date = document.forms["leaveForm"]["end_date"].value;
            let reason = document.forms["leaveForm"]["reason"].value;

            if (leave_type == "" || start_date == "" || end_date == "" || reason == "") {
                alert("Please fill in all fields.");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="login">
        <h1>Leave Request</h1>
        <nav class="nave">
            <a class="a" href="admin.php">Admin</a>
            <a class="a" href="login.php">Login</a>
            <a class="a" href="registration.php">Registration</a>
        </nav>
        <?php if (!empty($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
        <form name="leaveForm" action="leave_request.php" method="post" onsubmit="return validateForm();">
            <input type="text" id="Username" name="username" value=" Welcome <?php echo $username; ?>" class="username-section"><br><br>
            
            <label for="leave_type" class="username-sect">Leave Type:</label>
            <select id="leave_type" name="leave_type" required>
                <option value="">Select Leave Type</option>
                <option value="Sick Leave">Sick Leave</option>
                <option value="Urgent Leave">Urgent Leave</option>
                <option value="Casual Leave">Casual Leave</option>
                <option value="Maternity Leave">Maternity Leave</option>
                <option value="Paternity Leave">Paternity Leave</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label for="start_date" class="username-sect">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $current_date; ?>" readonly><br><br>

            <label for="end_date"class="username-sect">End Date:</label>
            <input type="date" id="end_date" name="end_date" placeholder="Choose leave end date"><br><br>

            <label for="reason"class="username-sect">Reason for Leave:</label><br><br>
            <textarea id="reason" name="reason" rows="4" cols="50" placeholder="Your reason for leave!"></textarea><br><br>

            <input type="submit" value="Submit Leave Request" name="subtn" class="username-section">
        </form>
    </div>
</body>
</html>



