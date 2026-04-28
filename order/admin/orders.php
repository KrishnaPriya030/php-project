<?php $inner_page = true; ?>
<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<div class="container">

<h2 align="center">Manage Orders</h2>

<table class="table">

<tr>
<th>ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
<th>Update</th>
</tr>

<?php
$res = mysqli_query($conn,"
SELECT o.*, u.name
FROM orders o
JOIN users u ON o.user_id = u.id
ORDER BY o.id DESC
");

while($row = mysqli_fetch_assoc($res)){
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td>Rs.<?php echo $row['total']; ?></td>

<td>
    <span class="badge b-<?php echo strtolower($row['status']); ?>">
        <?php echo htmlspecialchars($row['status']); ?>
    </span>
</td>

<td>
<form method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="status">
<option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
<option value="Approved" <?php if($row['status']=="Approved") echo "selected"; ?>>Approved</option>
<option value="Completed" <?php if($row['status']=="Completed") echo "selected"; ?>>Completed</option>
<option value="Cancelled" <?php if($row['status']=="Cancelled") echo "selected"; ?>>Cancelled</option></select>

<button class="btn small" name="update" value="<?php echo $row['id']; ?>">Update</button>
</form>
</td>

</tr>

<?php } ?>

</table>

</div>

<?php
if(isset($_POST['update'])){

    $id = intval($_POST['update']);
    $status = $_POST['status'];

    $allowed = ['Pending','Approved','Completed','Cancelled'];

    if(in_array($status, $allowed)){

        mysqli_query($conn,"UPDATE orders 
        SET status='$status' 
        WHERE id='$id'");

        header("Location: orders.php");
        exit();
    }
}
?>