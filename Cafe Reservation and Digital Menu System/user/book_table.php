<?php 
session_start();
include '../db.php'; 
include 'navbar.php'; 
?>
<link rel="stylesheet" href="../style.css">

<?php
if(!isset($_GET['id'])){
    echo "Invalid Access";
    exit();
}

$table_id = $_GET['id'];
?>

<div class="container">

<h2 align="center">Book Table</h2>

<form method="post" class="form">

<label>Date</label>
<input type="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>

<label>Time</label>
<input type="time" name="time" required>

<label>No. of People</label>
<input type="number" name="people" min="1" required>

<button class="btn" name="book">Proceed to Payment</button>

</form>

</div>

<?php
if(isset($_POST['book'])){

    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];

    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');

    if($date < $currentDate){
        echo "<script>alert('Cannot select past date');</script>";
        exit();
    }

    if($date == $currentDate && $time < $currentTime){
        echo "<script>alert('Cannot select past time');</script>";
        exit();
    }

    if($time < "06:00" || $time > "22:00"){
        echo "<script>alert('Booking allowed only between 6 AM and 10 PM');</script>";
        exit();
    }

    // 🔥 START TRANSACTION
    mysqli_query($conn, "START TRANSACTION");

    try {

        // 🔒 LOCK TABLE ROW
        $res = mysqli_query($conn,"
            SELECT capacity FROM cafe_tables 
            WHERE id='$table_id' FOR UPDATE
        ");

        $row = mysqli_fetch_assoc($res);

        // 👥 Capacity check
        if($people > $row['capacity']){
            throw new Exception("Exceeds table capacity!");
        }

        if($people < ($row['capacity'] / 2)){
            throw new Exception("Please select a smaller table");
        }

        // 🔒 CHECK BOOKING AGAIN INSIDE LOCK
        $check = mysqli_query($conn,"
            SELECT id FROM reservations 
            WHERE table_id='$table_id'
            AND date='$date'
            AND time='$time'
            AND status IN ('Pending','Approved')
            FOR UPDATE
        ");

        if(mysqli_num_rows($check) > 0){
            throw new Exception("Table already booked for this time");
        }

        // ✅ SAVE SESSION (safe now)
        $_SESSION['table_id'] = $table_id;
        $_SESSION['date'] = $date;
        $_SESSION['time'] = $time;
        $_SESSION['people'] = $people;
        $_SESSION['amount'] = 100;

        mysqli_query($conn, "COMMIT");

        header("Location: payment.php");
        exit();

    } catch(Exception $e){

        mysqli_query($conn, "ROLLBACK");

        echo "<script>alert('".$e->getMessage()."');</script>";
        exit();
    }
}
?>