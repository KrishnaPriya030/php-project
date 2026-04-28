<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<div class="container grid">

<?php
$res = mysqli_query($conn,"SELECT * FROM menu");

while($r = mysqli_fetch_assoc($res)){
?>

<div class="card menu-card">

<img src="../uploads/<?php echo $r['image']; ?>">

<h3><?php echo $r['name']; ?></h3>
<p>Rs.<?php echo $r['price']; ?></p>

<?php if($r['quantity'] > 0){ ?>
    <p style="color:green;">Available: <?php echo $r['quantity']; ?></p>
    <a class="btn" href="?add=<?php echo $r['id']; ?>">Add to Cart</a>
<?php } else { ?>
    <p style="color:red;">Out of Stock</p>
<?php } ?>

</div>

<?php } ?>

</div>

<?php
// ✅ ADD TO CART
if(isset($_GET['add'])){
    $id = $_GET['add'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

     echo "<script>
        alert('Item added to cart');
        window.location='menu.php';
    </script>";
    exit();

    }
?>