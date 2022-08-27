<?php
include "../base.php";
$odn=$movie->find($_POST['id'])['name'];
$odd=$_POST['date'];
$see=((date("H")-12)<0)?0:floor((date("H")-12)/2);
for ($i=$see+1; $i <= 5; $i++) { 
    $s=$orders->math('sum','qt',['name'=>$odn,'date'=>$odd,'session'=>$session_str[$i]]);
    $last_s=20-($s);
    ?>
    <option value="<?=$session_str[$i];?>"><?=$session_str[$i];?> 剩餘座位(<?=$last_s;?>)</option>
    <?php
}