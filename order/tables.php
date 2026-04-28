<?php include 'db.php'; ?>
<link rel="stylesheet" href="style.css">

<div class="navbar">
  <a href="index.php">Home</a>
  <a href="menu_view.php">Menu</a>
  <a href="tables.php">Tables</a>
  <a href="contact.php">Contact</a>
  <a href="login_select.php">Login</a>
</div>

<div class="container">
  <h2 align="center">Tables</h2><br>

  <div class="table-grid">

  <?php
  $res = mysqli_query($conn, "SELECT * FROM cafe_tables");

  while($r = mysqli_fetch_assoc($res)){

    $capacity = $r['capacity'];

    // decide shape
    $shape = ($capacity <= 4) ? 'circle' : 'rect';
  ?>

    <div class="table-card <?php echo strtolower(trim($r['status'])); ?> <?php echo $shape; ?>">
      <strong>Table <?php echo $r['table_no']; ?></strong>
      <small><?php echo $capacity; ?> seats</small>
      <small><?php echo $r['status']; ?></small>
    </div>

  <?php } ?>

  </div>
</div>