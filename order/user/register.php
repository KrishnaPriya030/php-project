<?php 
session_start();
include '../db.php';

// show errors (remove later)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $confirm_email = trim($_POST['confirm_email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // ✅ NAME VALIDATION
    if(!preg_match("/^[A-Za-z ]{3,50}$/", $name)){
        echo "<script>alert('Name must contain only letters (min 3 characters)');</script>";
    }

    // ✅ EMAIL VALIDATION
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format');</script>";
    }

    // ✅ CONFIRM EMAIL
    elseif($email !== $confirm_email){
        echo "<script>alert('Emails do not match');</script>";
    }

    // ✅ PASSWORD VALIDATION
    elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/", $password)){
        echo "<script>alert('Password must have at least 6 characters, including uppercase, lowercase and number');</script>";
    }

    // ✅ CONFIRM PASSWORD
    elseif($password !== $confirm_password){
        echo "<script>alert('Passwords do not match');</script>";
    }

    else{

        // 🔍 CHECK DUPLICATE EMAIL
        $check = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){
            echo "<script>alert('Email already exists');</script>";
        }
        else{

            // ✅ INSERT (no hashing as per your request)
            $insert = mysqli_query($conn,"
                INSERT INTO users(name,email,password,role)
                VALUES('$name','$email','$password','customer')
            ");

            if($insert){
                echo "<script>
                    alert('Registration Successful');
                    window.location='login.php';
                </script>";
                exit();
            } else {
                echo "<script>alert('Database error');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
  <a href="../index.php">Home</a>
  <a href="../menu_view.php">Menu</a>
  <a href="../tables.php">Tables</a>
  <a href="../contact.php">Contact</a>
  <a href="../login_select.php">Login</a>
</div>

<div class="container login-container">

<form class="form" method="post">

    <h3>Customer Register</h3>

    <input type="text" name="name" placeholder="Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="email" name="confirm_email" placeholder="Confirm Email" required>

    <input type="password" name="password" placeholder="Password" required>

    <input type="password" name="confirm_password" placeholder="Confirm Password" required>

    <button type="submit" class="btn">Register</button>

    <br><br>

    <a href="login.php" class="btn secondary">Already have account? Login</a>

</form>

</div>

</body>
</html>