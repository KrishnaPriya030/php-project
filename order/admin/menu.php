<?php include '../db.php'; include 'navbar.php'; ?>

<div class="container">

<form class="form" method="post" enctype="multipart/form-data">
    <h3>Add Menu Item</h3>

    <input name="name" placeholder="Item Name" required>
    <input name="price" placeholder="Price" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <input type="file" name="img" required>

    <button class="btn" name="add">Add Item</button>
</form>

<table class="table">
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Qty</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php
$res = mysqli_query($conn,"SELECT * FROM menu");
while($r = mysqli_fetch_assoc($res)){
?>
<tr>
<td><?php echo $r['id']; ?></td>
<td><?php echo $r['name']; ?></td>
<td>Rs.<?php echo $r['price']; ?></td>
<td><?php echo $r['quantity']; ?></td>
<td><img src="../uploads/<?php echo $r['image']; ?>" width="60"></td>
<td>
<a class="btn" href="edit_menu.php?id=<?php echo $r['id']; ?>">Edit</a>
<a class="btn danger" href="?del=<?php echo $r['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>

</div>

<?php
if(isset($_POST['add'])){
    $file = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "../uploads/".$file);

    mysqli_query($conn,"INSERT INTO menu(name,price,image,quantity)
    VALUES('$_POST[name]','$_POST[price]','$file','$_POST[quantity]')");
    header("Location: menu.php");
    exit();
}

if(isset($_GET['del'])){
    mysqli_query($conn,"DELETE FROM menu WHERE id=".$_GET['del']);
    header("Location: menu.php");
    exit();
}
?>