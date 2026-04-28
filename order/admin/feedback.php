<?php $inner_page = true; ?>
<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<div class="container">

<h2 align="center">Customer Feedback</h2>

<div class="feedback-list">

<?php
$res = mysqli_query($conn,"
SELECT f.*, u.name
FROM feedback f
JOIN users u ON f.user_id = u.id
ORDER BY f.id DESC
");

while($row = mysqli_fetch_assoc($res)){
?>

<div class="feedback-card">

    <h3>
        <?php echo $row['name']; ?> 
        <span style="font-size:12px; color:gray;">(ID: <?php echo $row['id']; ?>)</span>
    </h3>

    <p class="msg"><?php echo $row['message']; ?></p>

    <!-- ⭐ RATING -->
    <p class="rating">
        <?php
        for($i=1; $i<=5; $i++){
            if($i <= $row['rating']){
                echo "&#9733;"; // filled
            } else {
                echo "&#9734;"; // empty
            }
        }
        ?>
    </p>

</div>

<?php } ?>

</div>

</div>