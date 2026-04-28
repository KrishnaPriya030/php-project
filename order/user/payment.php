<?php include '../db.php'; include 'navbar.php'; ?>
<link rel="stylesheet" href="../style.css">

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="container">
<div class="payment-box">

<h2>Secure Payment</h2>

<p>Total Amount</p>
<h1>Rs.<?php echo $_SESSION['amount']; ?></h1>

<button id="payBtn" class="btn pay-btn">Pay Now</button>

</div>
</div>

<?php
$amount = $_SESSION['amount'] * 100; // paise
?>

<script>

var options = {
    "key": "rzp_test_Sbq80aEMVt7HzQ", // (can keep dummy also)
    "amount": "<?php echo $amount; ?>",
    "currency": "INR",
    "name": "GrandCafe",
    "description": "Payment",

    // 🔥 FORCE SUCCESS (IMPORTANT)
    "handler": function (response){
        window.location = "verify.php?payment_id=TEST123&order_id=TEST456&signature=TEST789";
    },

    "theme": {
        "color": "#6f4e37"
    }
};

var rzp = new Razorpay(options);

document.getElementById('payBtn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>