<?php
session_start();
include '../sql.php';
$username=$_SESSION['admin'];
$str="select * from login where username='$username' and ActiveFlag=1";
$res=mysqli_query($sql,$str);
$arr=mysqli_fetch_assoc($res);
echo json_encode($arr);