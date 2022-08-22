<?php
include "../base.php";

$mv=$movie->find($_POST['id']);

$now=strtotime($today);
$ondate=strtotime($mv['ondate']);
$days=3-($now-$ondate)/(60*60*24);
for ($i=0; $i < $days; $i++) { 
    $mmtimes=date("Y-m-d",strtotime("+$i days"));
    $mtime=date("m 月 d 日 l",strtotime("+$i days"));
    ?>
        <option value="<?=$mmtimes;?>"><?=$mtime;?></option>
    <?php
}


