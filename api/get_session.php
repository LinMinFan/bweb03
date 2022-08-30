<?php
include "../base.php";
$name=$movies->find($_POST['id'])['name'];
$date=$_POST['date'];
$times=(date("H")-12<0)?0:floor((date("H")-12)/2)+1;

for ($i=$times; $i <= 5 ; $i++) {
    $last=20-($orders->math('sum','qt',['name'=>$name,'date'=>$date,'session'=>$ss_times[$i]])) ;
    ?>
    <option value="<?=$ss_times[$i];?>"><?=$ss_times[$i];?> 剩餘座位 <?=$last;?></option>
    <?php
}