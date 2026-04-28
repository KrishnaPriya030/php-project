<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<div class="container">
<h2 class="title">Reserve Your Table</h2><br><br>

<div class="table-grid">

<?php
$res = mysqli_query($conn,"SELECT * FROM cafe_tables");

while($t = mysqli_fetch_assoc($res)){

    $capacity = $t['capacity'];
    $shape = ($capacity <= 4) ? 'circle' : 'rect';

    $status = strtolower(trim($t['status']));
?>

<!-- 🟢 AVAILABLE → CLICKABLE -->
<?php if($status == 'available'){ ?>
    
    <a href="book_table.php?id=<?php echo $t['id']; ?>" 
       class="table-card <?php echo $status; ?> <?php echo $shape; ?> clickable">

        <strong>Table <?php echo $t['table_no']; ?></strong>
        <small><?php echo $capacity; ?> seats</small>
        <small><?php echo $t['status']; ?></small>

    </a>

<!-- 🔴 / 🟡 BLOCKED -->
<?php } else { ?>

    <div class="table-card <?php echo $status; ?> <?php echo $shape; ?> blocked">

        <span class="cross"></span>

        <strong>Table <?php echo $t['table_no']; ?></strong>
        <small><?php echo $capacity; ?> seats</small>
        <small><?php echo $t['status']; ?></small>

    </div>

<?php } ?>

<?php } ?>

</div>
</div>