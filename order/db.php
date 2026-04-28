<?php
$conn = mysqli_connect("localhost","root","","ordering_db");
if(!$conn){ die("DB error"); }
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>