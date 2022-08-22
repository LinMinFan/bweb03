<?php
include "../base.php";

$id=$_POST['id'];
$mms=$movie->find($id);

$today=strtotime(date("Y-m-d"));
$ondate=strtotime($mms['ondate']);
$days=3-(($today-$ondate)/(60*60*24));

for($i=0;$i<$days;$i++){
    $date=date("Y-m-d",strtotime("+$i days"));
    $d=date("m月d日 l",strtotime("+$i days"));
    echo "<option value='$date'>$d</option>";
}