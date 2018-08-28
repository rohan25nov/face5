<?php
include '../sql.php';
$str="select * from userdetails where ActiveFlag=1";
$res=mysqli_query($sql,$str);
$array=[];
$i=0;
while ($arr=mysqli_fetch_assoc($res))
{
    $array[$i]["id"]=$arr['id'];
    $array[$i++]["iso"]=$arr['txtfinger'];
}
echo json_encode($array);