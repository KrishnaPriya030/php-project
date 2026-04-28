<?php include '../db.php'; ?>

<?php
$payment_id = $_GET['payment_id'];

$ref = $_SESSION['ref'];
$amount = $_SESSION['amount'];

// SAVE PAYMENT
mysqli_query($conn,"INSERT INTO payments(ref_id,amount,type,method,status)
VALUES('$ref','$amount','order','UPI','Paid')");

echo "<h2>Payment Successful</h2>";
echo "Payment ID: ".$payment_id;

echo "<br><br><a href='receipt.php'>View Receipt</a>";
?>