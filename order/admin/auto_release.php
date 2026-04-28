<?php include '../db.php'; ?>

<?php
$res = mysqli_query($conn,"
SELECT * FROM reservations 
WHERE status='Confirmed' 
AND expire_time < NOW()
");

while($row = mysqli_fetch_assoc($res)){

    $table_id = $row['table_id'];

    // FREE TABLE
    mysqli_query($conn,"
        UPDATE cafe_tables 
        SET status='Available' 
        WHERE id='$table_id'
    ");

    // MARK COMPLETED
    mysqli_query($conn,"
        UPDATE reservations 
        SET status='Completed' 
        WHERE id='".$row['id']."'
    ");
}
?>