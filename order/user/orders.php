<?php 
session_start();
include '../db.php'; 
include 'navbar.php'; 
?>
<link rel="stylesheet" href="../style.css">

<div class="container">
<h2 align="center">My Orders</h2>

<table class="table">
<tr>
<th>Order ID</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php
$user = $_SESSION['user'];

$res = mysqli_query($conn,"
SELECT * FROM orders 
WHERE user_id=$user 
ORDER BY id DESC
");

while($row=mysqli_fetch_assoc($res)){
?>
<tr>

<td><?php echo $row['id']; ?></td>
<td>Rs.<?php echo $row['total']; ?></td>

<td>
    <span class="badge b-<?php echo strtolower($row['status']); ?>">
        <?php echo htmlspecialchars($row['status']); ?>
    </span>
</td>

<td><?php echo $row['order_time']; ?></td>

<td>
<?php if($row['status']=="Pending"){ ?>

    <form method="post" style="display:inline;">
        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
        <button class="btn danger" name="cancel_order">Cancel</button>
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
// 🔥 CANCEL ORDER (CONCURRENCY SAFE)
if(isset($_POST['cancel_order'])){

    $order_id = intval($_POST['order_id']);

    mysqli_query($conn, "START TRANSACTION");

    try {

        // 🔒 Lock order row
        $orderRes = mysqli_query($conn,"
            SELECT status FROM orders 
            WHERE id='$order_id' AND user_id='$user' FOR UPDATE
        ");

        $orderRow = mysqli_fetch_assoc($orderRes);

        // ❌ If already cancelled or not pending
        if(!$orderRow || $orderRow['status'] != 'Pending'){
            throw new Exception("Invalid cancellation");
        }

        // 🔒 Lock all items
        $items = mysqli_query($conn,"
            SELECT * FROM order_items 
            WHERE order_id='$order_id' FOR UPDATE
        ");

        while($item = mysqli_fetch_assoc($items)){

            // 🔒 Lock each menu item
            $menuRes = mysqli_query($conn,"
                SELECT quantity FROM menu 
                WHERE id=".$item['menu_id']." FOR UPDATE
            ");

            // ✅ Restore stock
            mysqli_query($conn,"
                UPDATE menu 
                SET quantity = quantity + ".$item['quantity']." 
                WHERE id = ".$item['menu_id']."
            ");
        }

        // ✅ Update order status
        mysqli_query($conn,"
            UPDATE orders 
            SET status='Cancelled' 
            WHERE id='$order_id'
        ");

        mysqli_query($conn, "COMMIT");

        echo "<script>window.location='orders.php';</script>";

    } catch(Exception $e){

        mysqli_query($conn, "ROLLBACK");

        echo "<script>alert('Cancellation failed'); window.location='orders.php';</script>";
    }
}
?>