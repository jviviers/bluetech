<?php
$db = new DBConnect;
$userlogin = $_COOKIE['cu2'];
$loginArr = explode('.',$userlogin);
$checkUser = trim($loginArr[0]);
$checkPass = trim($loginArr[1]);
$dbPass = $db->getPass($checkUser);
if (empty($dbPass) || $dbPass !== $checkPass) {
    sleep(0);
    header('location:index.html');
    exit; 
}  


