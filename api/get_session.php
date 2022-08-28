<?php
include "../base.php";
$mv=$movies->find($_POST['id']);
$date=$_POST['date'];
$times=(date("H")-12<0)?0:floor((date("H")-12)/2);


for ($i=$times+1; $i <= 5; $i++) {
    $last_s=20-($orders->math('sum','qt',['name'=>$mv['name'],'date'=>$date,'session'=>$session_time[$i]]));
    ?>
        <option value="<?=$session_time[$i];?>"><?=$session_time[$i];?> 剩餘座位<span id="last_s"><?=$last_s;?></span></option>
    <?php
}