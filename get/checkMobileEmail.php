<?php
$mobile=$_GET['mobile'];
$email=$_GET['email'];
$count=[];
$count['mobile']=0;
$count['email']=0;
include '../sql.php';
$str="select * from userDetails where mobile='$mobile' and ActiveFlag=1";
$res=mysqli_query($sql,$str);
$count['mobile']=mysqli_num_rows($res);
$str="select * from userDetails where email='$email' and ActiveFlag=1";
$res=mysqli_query($sql,$str);
$count['email']=mysqli_num_rows($res);
echo json_encode($count);