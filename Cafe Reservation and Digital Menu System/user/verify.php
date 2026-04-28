<?php 
session_start();
include '../db.php'; 
include 'navbar.php'; 
?>

<?php
if(isset($_SESSION['amount']) && isset($_SESSION['user'])){

    $amount = $_SESSION['amount'];
    $user   = $_SESSION['user'];

    // =========================
    // 🪑 RESERVATION FLOW
    // =========================
    if(isset($_SESSION['table_id']) && !empty($_SESSION['table_id'])){

        $table_id = $_SESSION['table_id'];
        $date     = $_SESSION['date'];
        $time     = $_SESSION['time'];
        $people   = $_SESSION['people'];

        $expire = date("Y-m-d H:i:s", strtotime("$date $time +3 hours"));

        mysqli_query($conn, "START TRANSACTION");

        try {

            // 🔒 Check table (lock row)
            $res = mysqli_query($conn,"
                SELECT status FROM cafe_tables 
                WHERE id='$table_id' FOR UPDATE
            ");

            $row = mysqli_fetch_assoc($res);

            // ❌ Block if not available
            if($row['status'] != 'Available'){
                throw new Exception("Already booked");
            }

            // ✅ FIX 1: Do NOT reserve immediately → set Pending
            mysqli_query($conn,"
                UPDATE cafe_tables 
                SET status='Pending' 
                WHERE id='$table_id'
            ");

            // ✅ Reservation stays Pending (correct)
            mysqli_query($conn,"
                INSERT INTO reservations
                (user_id,table_id,date,time,people,amount,status,expire_time)
                VALUES('$user','$table_id','$date','$time','$people','$amount','Pending','$expire')
            ");

            // ✅ Insert payment (reservation)
            mysqli_query($conn,"
                INSERT INTO payments
                (ref_id,amount,type,method,status)
                VALUES('$user','$amount','reservation','UPI','Paid')
            ");

            // ✅ FIX 3: Save payment id immediately after insert
            $_SESSION['last_payment'] = mysqli_insert_id($conn);

            mysqli_query($conn, "COMMIT");

            // 🔥 Clear reservation session
            unset($_SESSION['table_id']);
            unset($_SESSION['date']);
            unset($_SESSION['time']);
            unset($_SESSION['people']);

        } catch(Exception $e){

            mysqli_query($conn, "ROLLBACK");

            echo "<script>alert('Table already booked!'); window.location='reservation.php';</script>";
            exit();
        }
    }

    // =========================
    // 🍽 ORDER FLOW
    // =========================
    else{

        mysqli_query($conn,"
            INSERT INTO payments
            (ref_id,amount,type,method,status)
            VALUES('$user','$amount','order','UPI','Paid')
        ");

        // ✅ FIX 3: Save payment id for orders as well
        $_SESSION['last_payment'] = mysqli_insert_id($conn);

        // 🔥 REDUCE STOCK
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id => $qty){

        mysqli_query($conn,"
            UPDATE menu 
            SET quantity = quantity - $qty 
            WHERE id = $id
        ");
    }
}

        unset($_SESSION['cart']);
    }

    header("Location: receipt.php");
    exit();
}
?>