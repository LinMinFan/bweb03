<?php
include "../base.php";

$mv=$movies->find($_POST['id']);
$date=$_POST['date'];
$ss=(date("H")-12<0)?0:floor((date("H")-12)/2);
for ($i=$ss+1; $i <= 5; $i++) { 
  $last=20-($orders->math('sum','qt',['name'=>$mv['name'],'date'=>$date,'session'=>$ss_time[$i]]));
  ?>
  <option value="<?=$ss_time[$i];?>"><?=$ss_time[$i];?> 剩餘座位<?=$last;?></option>
  <?php
}