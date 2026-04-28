<?php include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- HERO (same as index) -->
<div class="hero-customer">
  <div class="hero-content">
    <h1><i class="fa-solid fa-mug-hot"></i> GrandCafe</h1>
    <p class="tagline">Take a break. Lead the way.</p>

    <div class="hero-buttons">
            <a href="orders.php" class="btn-primary">Manage Orders</a>
            <a href="reservations.php" class="btn-secondary">Manage Reservations</a>
        </div>
  </div>
</div>

<!-- DASHBOARD OPTIONS -->
<div class="container">

  <div class="grid">

    <div class="card">
      <h3>Menu</h3>
      <p>Manage food & beverages</p>
      <a class="btn" href="menu.php">Manage</a>
    </div>

    <div class="card">
      <h3>Tables</h3>
      <p>View and update table status</p>
      <a class="btn" href="tables.php">View</a>
    </div>

    <div class="card">
      <h3>Orders</h3>
      <p>Track and manage orders</p>
      <a class="btn" href="orders.php">Manage</a>
    </div>

    <div class="card">
      <h3>Reservations</h3>
      <p>Handle table bookings</p>
      <a class="btn" href="reservations.php">View</a>
    </div>


    <div class="card">
      <h3>Feedback</h3>
      <p>View customer feedback</p>
      <a class="btn" href="feedback.php">View</a>
    </div>

  </div>

</div>