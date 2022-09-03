<?php
include "../base.php";

$mv=$movies->find($_POST['id']);
$date=$_POST['date'];
$session=(date("H")-12<0)?0:floor((date("H")-12)/2);
for ($i=($session+1); $i <= 5; $i++) {
    $last=20-($orders->math('sum','qt',['name'=>$mv['name'],'date'=>$date,'session'=>$ss_times[$i]]));
    ?>
    <option value="<?=$ss_times[$i];?>"><?=$ss_times[$i];?> 剩餘座位<?=$last;?></option>
    <?php
}