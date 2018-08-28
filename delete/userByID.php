<?php
$id=$_GET['id'];
include '../sql.php';
$str="delete from userdetails where id='$id' and ActiveFlag=1";
mysqli_query($sql,$str);
echo 'User Deleted Successfully';