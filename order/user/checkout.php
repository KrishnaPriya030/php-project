<?php 
session_start();
include '../db.php'; 

// 🔥 CLEAR reservation session (fix bug)
unset($_SESSION['table_id']);
unset($_SESSION['date']);
unset($_SESSION['time']);
unset($_SESSION['people']);

$user  = $_SESSION['user'];
$total = $_SESSION['amount'];

// create order
mysqli_query($conn,"
INSERT INTO orders(user_id,total,status)
VALUES('$user','$total','Pending')
");

$_SESSION['ref'] = mysqli_insert_id($conn);

header("Location: payment.php");
exit();
?>