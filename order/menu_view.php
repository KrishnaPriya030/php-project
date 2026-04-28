<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';
?>

<link rel="stylesheet" href="style.css">
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="menu_view.php">Menu</a>
  <a href="tables.php">Tables</a>
  <a href="contact.php">Contact</a>
  <a href="login_select.php">Login</a>
</div>


<div class="container">

<h2 align="center">Our Menu</h2>

<div class="menu-grid">

<?php
$res = mysqli_query($conn,"SELECT * FROM menu");

while($row = mysqli_fetch_assoc($res)){
?>

<div class="menu-card">

    <img src="uploads/<?php echo $row['image']; ?>" alt="">

    <h3><?php echo $row['name']; ?></h3>

    <p>Rs.<?php echo $row['price']; ?></p>

</div>

<?php } ?>

</div>

</div>