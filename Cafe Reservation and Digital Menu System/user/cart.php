<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<?php
// ✅ Ensure cart exists
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// ➕ INCREASE
if(isset($_GET['inc'])){
    $id = $_GET['inc'];

    $res = mysqli_query($conn,"SELECT quantity FROM menu WHERE id=$id");
    $row = mysqli_fetch_assoc($res);

    if(isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id] < $row['quantity']){
        $_SESSION['cart'][$id]++;
    }
}

// ➖ DECREASE
if(isset($_GET['dec'])){
    $id = $_GET['dec'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]--;

        if($_SESSION['cart'][$id] <= 0){
            unset($_SESSION['cart'][$id]);
        }
    }
}

// ❌ REMOVE ITEM
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
}
?>

<div class="container">
<h2 align="center">Your Cart</h2>

<div class="cart-box">

<?php
$total = 0;

if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id => $qty){

        $r = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM menu WHERE id=$id"));

        if(!$r) continue; // safety check

        $sub = $r['price'] * $qty;
        $total += $sub;
?>

<div class="cart-item">

    <img src="../uploads/<?php echo $r['image']; ?>">

    <div>
        <h3><?php echo $r['name']; ?></h3>
        <p>Rs.<?php echo $r['price']; ?></p>

        <!-- QUANTITY -->
        <div class="qty-box">
            <a href="?dec=<?php echo $id; ?>" class="qty-btn">-</a>
            <span><?php echo $qty; ?></span>
            <a href="?inc=<?php echo $id; ?>" class="qty-btn">+</a>
        </div>
    </div>

    <p>Rs.<?php echo $sub; ?></p>

    <!-- REMOVE -->
    <a href="?remove=<?php echo $id; ?>" class="remove-btn">-</a>

</div>

<?php
    }
} else {
    echo "<p style='text-align:center;'>Your cart is empty</p>";
}
?>

<h3 class="total">Total: Rs.<?php echo $total; ?></h3>

<?php
// ✅ STORE TOTAL
$_SESSION['amount'] = $total;
?>

<a class="btn checkout-btn" href="checkout.php">Proceed to Checkout</a>

</div>
</div>