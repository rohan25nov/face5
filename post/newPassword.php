<?php
include '../sql.php';
$old=$_GET['old'];
$password=$_GET['password'];
$str="update login set password='$password' where password='$old' and ActiveFlag=1";
mysqli_query($sql,$str);
