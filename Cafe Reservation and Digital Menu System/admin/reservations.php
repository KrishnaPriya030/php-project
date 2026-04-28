<?php 
include '../db.php'; 
include 'navbar.php'; 
?>
<link rel="stylesheet" href="../style.css">

<div class="container">

<h2 align="center">Manage Reservations</h2>

<table class="table">

<tr>
<th>ID</th>
<th>Customer</th>
<th>Table</th>
<th>Date</th>
<th>Time</th>
<th>People</th>
<th>Status</th>
<th>Update</th>
</tr>

<?php
$res = mysqli_query($conn,"
SELECT r.*, u.name, t.table_no
FROM reservations r
JOIN users u ON r.user_id = u.id
JOIN cafe_tables t ON r.table_id = t.id
ORDER BY r.id DESC
");

while($row = mysqli_fetch_assoc($res)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td>Table <?php echo $row['table_no']; ?></td>

<td><?php echo $row['date']; ?></td>

<td><?php echo $row['time']; ?></td>

<td><?php echo $row['people']; ?></td>

<td>
    <span class="badge b-<?php echo strtolower($row['status']); ?>">
        <?php echo htmlspecialchars($row['status']); ?>
    </span>
</td>

<td>
<form method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="status" required>
<option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
<option value="Approved" <?php if($row['status']=="Approved") echo "selected"; ?>>Approved</option>
<option value="Cancelled" <?php if($row['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
</select>

<button class="btn small" name="update" value="<?php echo $row['id']; ?>">Update</button>
</form>
</td>

</tr>

<?php } ?>

</table>

</div>

<?php
// 🔄 UPDATE STATUS + SYNC TABLE
if(isset($_POST['update'])){

    $id = intval($_POST['update']);
    $status = $_POST['status'];

    // ✅ VALIDATION
    $allowed = ['Pending','Approved','Cancelled'];

    if(in_array($status, $allowed)){

        // 🔹 Update reservation
        mysqli_query($conn,"UPDATE reservations 
        SET status='$status' 
        WHERE id='$id'");

        // 🔹 Get table_id
        $res2 = mysqli_query($conn,"SELECT table_id FROM reservations WHERE id='$id'");
        $row2 = mysqli_fetch_assoc($res2);
        $table_id = $row2['table_id'];

        // 🔥 CORRECT TABLE LOGIC
        if($status == 'Approved'){
            $table_status = 'Reserved';   // lock table
        } else {
            $table_status = 'Available';  // free table
        }

        // 🔹 Update table
        mysqli_query($conn,"UPDATE cafe_tables 
        SET status='$table_status' 
        WHERE id='$table_id'");

        header("Location: reservations.php");
        exit();
    }
}
?>