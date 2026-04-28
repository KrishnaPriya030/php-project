<?php include '../db.php'; include 'navbar.php';

$id = $_GET['id'];
$r = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM menu WHERE id=$id"));
?>

<div class="container">
<form class="form" method="post">

<h3>Edit Menu</h3>

<input name="name" value="<?php echo $r['name']; ?>">
<input name="price" value="<?php echo $r['price']; ?>">
<input type="number" name="quantity" value="<?php echo $r['quantity']; ?>">

<button class="btn" name="update">Update</button>

</form>
</div>

<?php
if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE menu SET 
    name='$_POST[name]',
    price='$_POST[price]',
    quantity='$_POST[quantity]'
    WHERE id=$id");

    header("Location: menu.php");
}
?>