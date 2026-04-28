<?php 
session_start();
include '../db.php'; 
include 'navbar.php'; 
?>
<link rel="stylesheet" href="../style.css">

<div class="container receipt">

<h2>Payment Receipt</h2>

<?php
$id = $_SESSION['last_payment'];

$res = mysqli_query($conn,"
SELECT p.*, u.name 
FROM payments p
JOIN users u ON p.ref_id = u.id
WHERE p.id='$id'
");

$row = mysqli_fetch_assoc($res);

// 🔥 Fetch reservation only if needed
$resv = null;

if($row['type'] == 'reservation'){

    $uid = $_SESSION['user'];

    $q2 = mysqli_query($conn,"
        SELECT r.*, t.table_no
        FROM reservations r
        JOIN cafe_tables t ON r.table_id = t.id
        WHERE r.user_id='$uid'
        ORDER BY r.id DESC
        LIMIT 1
    ");

    $resv = mysqli_fetch_assoc($q2);
}
?>

<div class="receipt-box">

<p><strong>Customer:</strong> <?php echo htmlspecialchars($row['name']); ?></p>

<p><strong>Amount:</strong> Rs.<?php echo $row['amount']; ?></p>

<p><strong>Type:</strong> <?php echo ucfirst($row['type']); ?></p>

<p><strong>Method:</strong> <?php echo $row['method']; ?></p>

<p><strong>Status:</strong> <?php echo $row['status']; ?></p>

<p><strong>Date:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>

<!-- 🔥 ONLY FOR RESERVATION -->
<?php if($row['type'] == 'reservation' && $resv){ ?>

<hr>

<p><strong>Table:</strong> Table <?php echo $resv['table_no']; ?></p>
<p><strong>Date:</strong> <?php echo $resv['date']; ?></p>
<p><strong>Time:</strong> <?php echo $resv['time']; ?></p>
<p><strong>People:</strong> <?php echo $resv['people']; ?></p>

<?php } ?>

</div>

<br>

<button onclick="window.print()" class="btn">Print Receipt</button>

<a href="home.php" class="btn">Back to Home</a>

</div>