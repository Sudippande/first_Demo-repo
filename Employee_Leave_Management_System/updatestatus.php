<?php
include("DB_Connection.php");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Prepare the SQL query to update the status
    $query = "UPDATE db_leave SET status = ? WHERE id = ?";
    // $stm =mysqli_query($con,$query) or die("Update error");
    // echo"Status updated successfully";
    
    // Prepare statement
    if ($stmt = $con->prepare($query))
    {
    //     // Bind parameters
        $stmt->bind_param("si", $status, $id);

        // Execute statement
        if ($stmt->execute()) {
            echo "<p>Status updated successfully.</p>";
        } else {
            echo "<p>Error updating status: " . $stmt->error . "</p>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<p>Error preparing statement: " . $con->error . "</p>";
    }

    // Close connection
    mysqli_close($con);
}

// Redirect back to the admin retrieval page
header("Location: adminaproval.php");
exit();
?>
