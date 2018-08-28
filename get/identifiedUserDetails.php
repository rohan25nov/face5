<?php
$id=$_GET['id'];
include '../sql.php';
$str="select * from userdetails where id=$id and ActiveFlag=1";
$res=mysqli_query($sql,$str);
if(mysqli_num_rows($res)>0)
    $arr=mysqli_fetch_assoc($res);
else
    $arr["name"]="not found here";
echo json_encode($arr);