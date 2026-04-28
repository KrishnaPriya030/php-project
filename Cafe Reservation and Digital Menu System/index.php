<?php include 'db.php'; ?>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="navbar">
  <a href="index.php">Home</a>
  <a href="menu_view.php">Menu</a>
  <a href="tables.php">Tables</a>
  <a href="contact.php">Contact</a>
  <a href="login_select.php">Login</a>
</div>

<!-- HERO (UPDATED) -->
<div class="hero-customer">
  <div class="hero-content">
    <h1><i class="fa-solid fa-mug-hot"></i> GrandCafe</h1>
    <p class="tagline">Take a break. Grab your coffee.</p>

    <div class="hero-buttons">
            <a href="menu_view.php" class="btn-primary">View Menu</a>
            <a href="login_select.php" class="btn-secondary">Login</a>
        </div>
  </div>
</div>

<!-- TABLE STATUS -->
<!-- <div class="container">
  <h2 align="center">Live Table Availability</h2>

  <div class="table-grid">
  <?php
  $res=mysqli_query($conn,"SELECT * FROM cafe_tables ORDER BY status ASC");
  while($r=mysqli_fetch_assoc($res)){ ?>
    
    <div class="table-card <?php echo strtolower($r['status']); ?>">
      <div class="table-circle"><?php echo $r['table_no']; ?></div>
      <p class="capacity">Table <?php echo $r['table_no']; ?></p>
      <p class="status"><?php echo $r['status']; ?></p>
    </div>

  <?php } ?>
  </div>
</div> -->