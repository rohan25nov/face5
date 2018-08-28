<?php
include '../sql.php';
$str="select * from userdetails where ActiveFlag=1";
$res=mysqli_query($sql,$str);
$array=[];
$i=0;
while ($arr=mysqli_fetch_assoc($res))
{
    $array[$i]=$arr;
    $array[$i]["no"]=$i+1;
    $array[$i]["caddress"]=$arr['address'];
    if($arr['street']!="")
        $array[$i]["caddress"].=",".$arr['street'];
    if($arr['city']!="")
        $array[$i]["caddress"].=",".$arr['city'];
    if($arr['state']!="")
        $array[$i]["caddress"].=",".$arr['state'];
    if($arr['pincode']!="")
        $array[$i]["caddress"].="-".$arr['pincode'];
    $i++;
}
echo json_encode($array);