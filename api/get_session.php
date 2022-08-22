<?php
include "../base.php";

$mv=$movie->find($_POST['id']);
$date=$_POST['date'];
$now=floor(((date("H")-12)/2<0)?0:(date("H")-12)/2);
for($i=($now+1);$i<=5;$i++){
$lave=20-$orders->math('sum','qt',['movie'=>$mv['name'],'date'=>$date,'session'=>$session[$i]]);?>
<option value="<?=$session[$i];?>"><?=$session[$i];?>剩餘座位(<?=$lave;?>)</option>
<?php
}

?>
<!-- <option value="">剩餘座位</option> -->

