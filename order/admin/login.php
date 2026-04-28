<?php include '../db.php'; ?>
<link rel="stylesheet" href="../style.css">
<div class="navbar">
  <a href="../index.php">Home</a>
  <a href="../menu_view.php">Menu</a>
  <a href="../tables.php">Tables</a>
  <a href="../contact.php">Contact</a>
  <a href="../login_select.php">Login</a>
</div>

<div class="container login-container">
<form class="form" method="post">
  <h3>Admin Login</h3>

  <input type="email" name="email" placeholder="Enter Email" required>

  <input type="password" name="password" placeholder="Enter Password" required>

  <button class="btn" name="login">Login</button><br>
</form></div>
<?php
if(isset($_POST['login'])){
  $q=mysqli_query($conn,"SELECT * FROM users WHERE email='$_POST[email]' AND password='$_POST[password]' AND role='admin'");
  if(mysqli_num_rows($q)){ $_SESSION['admin']=1; header("Location: home.php"); }
}
?>