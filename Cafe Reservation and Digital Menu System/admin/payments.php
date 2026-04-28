<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<div class="container">

<h2 align="center">Payment Transactions</h2>

<table class="table">

<tr>
<th>ID</th>
<th>Customer</th>
<th>Amount</th>
<th>Type</th>
<th>Method</th>
<th>Status</th>
</tr>

<?php
$res = mysqli_query($conn,"
SELECT p.*, u.name
FROM payments p
LEFT JOIN users u 
ON p.ref_id = u.id
ORDER BY p.id DESC
");

while($row = mysqli_fetch_assoc($res)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td>Rs.<?php echo $row['amount']; ?></td>

<td><?php echo $row['type']; ?></td>

<td><?php echo $row['method']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>