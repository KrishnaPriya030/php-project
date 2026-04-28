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
    <h3>Customer Login</h3>

    <input type="email" name="email" placeholder="Enter Email" required>

    <input type="password" name="password" placeholder="Enter Password" required>

    <button class="btn" name="login">Login</button>

    <br><br>
    <a href="register.php" class="btn secondary">Don't have account? Register</a>
  </form>
</div>

<?php
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // 🔍 Debug check
    $q = mysqli_query($conn,"SELECT * FROM users 
    WHERE email='$email' AND password='$password' AND role='customer'");

    if(mysqli_num_rows($q) > 0){

        $row = mysqli_fetch_assoc($q);

        $_SESSION['user'] = $row['id'];

        header("Location: home.php");
        exit(); // IMPORTANT

    } else {

        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>