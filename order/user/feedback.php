<?php 
session_start(); 
include '../db.php'; 
include 'navbar.php'; 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="container">

<h2 class="title">Customer Feedback</h2>

<!-- ⭐ ADD FEEDBACK -->
<div class="feedback-form">
    <form method="post">

        <textarea name="message" placeholder="Write your feedback..." required></textarea>

        <label>Rating:</label>
        <select name="rating">
            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
            <option value="4">⭐⭐⭐⭐ Good</option>
            <option value="3">⭐⭐⭐ Average</option>
            <option value="2">⭐⭐ Poor</option>
            <option value="1">⭐ Very Bad</option>
        </select>

        <button class="btn" name="submit">Submit Feedback</button>

    </form>
</div>

<!-- ⭐ SHOW FEEDBACK -->
<div class="feedback-list">

<?php
$res = mysqli_query($conn,"
SELECT feedback.*, users.name 
FROM feedback 
JOIN users ON feedback.user_id = users.id
ORDER BY feedback.id DESC
");

while($row = mysqli_fetch_assoc($res)){
?>

<div class="feedback-card">

    <h3><?php echo $row['name']; ?></h3>

    <p class="msg"><?php echo $row['message']; ?></p>

    <!-- ⭐ SHOW RATING -->
    <p class="rating">
        <?php
        for($i=1; $i<=5; $i++){
            if($i <= $row['rating']){
                echo "&#9733;"; // filled star
            } else {
                echo "&#9734;"; // empty star
            }
        }
        ?>
    </p>

</div>

<?php } ?>

</div>

</div>

<?php
// ⭐ INSERT FEEDBACK
if(isset($_POST['submit'])){

    if(!isset($_SESSION['user'])){
        echo "<script>alert('Please login first'); window.location='login.php';</script>";
        exit();
    }

    $user = $_SESSION['user'];
    $msg = $_POST['message'];
    $rating = $_POST['rating'];

    mysqli_query($conn,"INSERT INTO feedback(user_id,message,rating)
    VALUES('$user','$msg','$rating')");

    echo "<script>
        alert('Feedback Submitted Successfully');
        window.location='feedback.php';
    </script>";
}
?>

</body>
</html>