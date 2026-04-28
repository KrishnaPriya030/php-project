<?php 
session_start();
include '../db.php'; 
include 'navbar.php'; 
?>

<div class="container">
<h2 align="center">My Receipts</h2>

<?php
$user = $_SESSION['user'];

$res = mysqli_query($conn,"
SELECT * FROM payments 
WHERE ref_id='$user'
ORDER BY id DESC
");

while($r = mysqli_fetch_assoc($res)){
?>

<div class="receipt-box" style="margin-bottom:20px;">

<p><strong>Amount:</strong> Rs.<?php echo $r['amount']; ?></p>

<p><strong>Type:</strong> <?php echo ucfirst($r['type']); ?></p>

<p><strong>Method:</strong> <?php echo $r['method']; ?></p>

<p><strong>Status:</strong> <?php echo $r['status']; ?></p>

<p><strong>Date:</strong> <?php echo $r['payment_time']; ?></p>

<hr>

</div>

<?php } ?>

</div>