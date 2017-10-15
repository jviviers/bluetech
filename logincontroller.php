<?php
session_start(); 
    $User = $_POST['email'];
    $Passx = $_POST['pwd'];
    $cu2 = 'cu2';
    setcookie($cu2, $User.'.'.$Passx);
    sleep(0);
    header('location:dashboard.php');
    exit;
