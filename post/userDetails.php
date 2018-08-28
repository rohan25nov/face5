<?php
$name=$_GET['name'];
$mobile=$_GET['mobile'];
$email=$_GET['email'];
$gender=$_GET['gender'];
$address=$_GET['address'];
$image=$_GET['image'];
$txtfinger=$_GET['txtfinger'];
if(isset($_GET['street']))
    $street=$_GET['street'];
else
    $street="";

if(isset($_GET['city']))
    $city=$_GET['city'];
else
    $city="";
if(isset($_GET['state']))
    $state=$_GET['state'];
else
    $state="";
if(isset($_GET['pincode']))
    $pincode=$_GET['pincode'];
else
    $pincode="";
include '../sql.php';
$str="insert into userDetails value (0,'$name','$mobile','$email','$gender','$address','$street','$city','$state','$pincode','$image','$txtfinger',1)";
mysqli_query($sql,$str);
$str1="select * from userDetails where mobile='$mobile' and email='$email' and ActiveFlag=1";
$res1=mysqli_query($sql,$str1);
$arr1=mysqli_fetch_assoc($res1);
echo $arr1['id'];