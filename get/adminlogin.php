<?php
include '../sql.php';
$str="select * from login where role='admin' and Activeflag=1";
$res=mysqli_query($sql,$str);
$i=0;
$array=[];
while ($arr=mysqli_fetch_assoc($res))
{
    $array[$i++]=$arr;
}
echo json_encode($array);