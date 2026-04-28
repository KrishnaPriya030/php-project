<?php 
session_start();
include '../db.php'; 
include 'navbar.php'; 
?>
<link rel="stylesheet" href="../style.css">

<div class="container">

<h2 align="center">My Reservations</h2>

<table class="table">

<tr>
    <th>ID</th>
    <th>Table</th>
    <th>Date</th>
    <th>Time</th>
    <th>People</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
$user = $_SESSION['user'];

$res = mysqli_query($conn,"
SELECT r.*, t.table_no 
FROM reservations r
JOIN cafe_tables t ON r.table_id = t.id
WHERE r.user_id='$user'
ORDER BY r.id DESC
");

while($row = mysqli_fetch_assoc($res)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>Table <?php echo $row['table_no']; ?></td>

<td><?php echo $row['date']; ?></td>

<td><?php echo $row['time']; ?></td>

<td><?php echo $row['people']; ?></td>

<td>
<?php
if($row['status']=="Pending"){
    echo "<span class='badge b-pending'>Pending</span>";
}
elseif($row['status']=="Approved"){
    echo "<span class='badge b-approved'>Approved</span>";
}
elseif($row['status']=="Cancelled"){
    echo "<span class='badge b-cancelled'>Cancelled</span>";
}
?>
</td>

<td>
<?php if($row['status']=="Pending"){ ?>
    
    <form method="post" style="display:inline;">
        <input type="hidden" name="cancel_id" value="<?php echo $row['id']; ?>">
        <button class="btn danger" name="cancel">Cancel</button>
    </form>

<?php } else { ?>
    <span style="color:gray;">-</span>
<?php } ?>
</td>

</tr>

<?php } ?>

</table>

</div>

<?php
// 🔥 CANCEL RESERVATION
if(isset($_POST['cancel'])){

    $id = $_POST['cancel_id'];

    // update reservation status
    mysqli_query($conn,"
        UPDATE reservations 
        SET status='Cancelled' 
        WHERE id='$id' AND user_id='$user'
    ");

    // OPTIONAL: make table available again
    $res = mysqli_query($conn,"SELECT table_id FROM reservations WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);

    if($row){
        mysqli_query($conn,"
            UPDATE cafe_tables 
            SET status='Available' 
            WHERE id='".$row['table_id']."'
        ");
    }

    // refresh page
    echo "<script>window.location='my_reservations.php';</script>";
}
?>