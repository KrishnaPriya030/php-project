<!-- <?php include '../db.php'; ?>
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
    <h3>Admin Register</h3>

    <input type="text" name="name" placeholder="Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Password" required>

    <button class="btn" name="reg">Register</button>

    <br><br>
    <a href="login.php" class="btn secondary">Already have account? Login</a>
  </form>
</div>

<?php
if(isset($_POST['reg'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 🔍 Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){

        // ❌ Email exists
        echo "<script>alert('Email already exists! Try another email');</script>";

    } else {

        // ✅ Insert new admin
        mysqli_query($conn,"INSERT INTO users(name,email,password,role)
        VALUES('$name','$email','$password','admin')");

        // ✅ Success + redirect
        echo "<script>
            alert('Registration Successful');
            window.location='login.php';
        </script>";
    }
}
?> -->