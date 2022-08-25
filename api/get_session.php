<?php
include "../base.php";
$mv=$movie->find($_POST['id']);
$date=$_POST['date'];
$can_see=floor((date("H")-12)<0?0:(date("H")-12)/2);
for ($i=($can_see+1); $i <= 5; $i++) { 
    $last=20-$orders->math('sum','qt',['movie'=>$mv['name'],'date'=>$date,'session'=>$session[$i]]);
    ?>
       <option value="<?=$session[$i];?>"><?=$session[$i];?>剩餘座位(<?=$last;?>)</option> 
    <?php
}