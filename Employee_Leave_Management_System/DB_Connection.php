<?php
$con=mysqli_connect("localhost","root","","employee_leave_system") or die("Database creation error");
// $create_tb="create database employee_leave_system";
// mysqli_query($con,$create_tb) or die("Table creation error");
// echo"Database created";


// $create_tbl="create table registration( id int AUTO_INCREMENT PRIMARY KEY,username varchar(30),designation varchar(30),address varchar(30),email varchar(30),password varchar(10))"; 
// mysqli_query($con,$create_tbl) or die("Table created");
// echo "table created";

// $alter_tbl="alter table registration ADD COLUMN status ENUM('Pending', 'Approved', 'Disapproved') DEFAULT 'Pending'";
// mysqli_query($con,$alter_tbl) or die("Error");
// echo"Table is altered";



// $create_tbl="create table admin( username varchar(30),password varchar(10))"; 
// mysqli_query($con,$create_tbl) or die("Table created");
// echo "table created";


// $create_tbl="create table Db_leave( username VARCHAR(20) NOT NULL,id INT AUTO_INCREMENT PRIMARY KEY,
//     leave_type VARCHAR(50),
//     start_date DATE,
//     end_date DATE,
//     reason TEXT,
//     status VARCHAR(20) DEFAULT 'Pending')"; 
// mysqli_query($con,$create_tbl) or die("Table creation error");
// echo "table created";

?>