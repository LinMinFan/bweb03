<?php
include "../base.php";


$mmid=$_POST['id'];
$mm=$movie->find($mmid);
$date=$_POST['date'];

$now=ceil((24-date("H"))/2);
$now=((6-$now)<=0)?0:(6-$now);

for($i=($now+1);$i<=5;$i++){
$lave=20-$orders->math('sum','qt',['movie'=>"{$mm['name']}",'date'=>"{$date}",'session'=>"{$session[$i]}"]);
echo "<option value='{$i}'>{$session[$i]} 剩餘座位($lave)</option>";
}