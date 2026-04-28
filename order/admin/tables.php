<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<div class="container">

<h2 align="center">Manage Tables</h2>

<!-- ADD TABLE -->
<form class="form" method="post">
    <input type="text" name="table_no" placeholder="Table Number (T1)" required>
    <input type="number" name="capacity" placeholder="Capacity" required>
    <button class="btn" name="add">Add Table</button>
</form>

<!-- TABLE LIST -->
<table class="table">

<tr>
<th>ID</th>
<th>Table</th>
<th>Capacity</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php
$res = mysqli_query($conn,"SELECT * FROM cafe_tables");

while($row = mysqli_fetch_assoc($res)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['table_no']; ?></td>

<!-- UPDATE CAPACITY -->
<td>
<form method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="number" name="capacity" value="<?php echo $row['capacity']; ?>" style="width:60px;">
<button class="btn small" name="update_cap">Update</button>
</form>
</td>

<!-- UPDATE STATUS -->
<td>
<form method="post">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<select name="status">
<option <?php if($row['status']=="Available") echo "selected"; ?>>Available</option>
<option <?php if($row['status']=="Reserved") echo "selected"; ?>>Reserved</option>
</select>
<button class="btn small" name="update_status">Change</button>
</form>
</td>

<td>
<a class="btn danger" href="?del=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</div>

<?php
// ADD TABLE
if(isset($_POST['add'])){
    mysqli_query($conn,"INSERT INTO cafe_tables(table_no,capacity,status)
    VALUES('$_POST[table_no]','$_POST[capacity]','Available')");
    echo "<script>window.location='tables.php';</script>";
}

// UPDATE CAPACITY
if(isset($_POST['update_cap'])){
    mysqli_query($conn,"UPDATE cafe_tables SET capacity='$_POST[capacity]' WHERE id='$_POST[id]'");
    echo "<script>window.location='tables.php';</script>";
}

// UPDATE STATUS
if(isset($_POST['update_status'])){
    mysqli_query($conn,"UPDATE cafe_tables SET status='$_POST[status]' WHERE id='$_POST[id]'");
    echo "<script>window.location='tables.php';</script>";
}

// DELETE
if(isset($_GET['del'])){
    mysqli_query($conn,"DELETE FROM cafe_tables WHERE id=".$_GET['del']);
    echo "<script>window.location='tables.php';</script>";
}
?>