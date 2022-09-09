<?php
include "../base.php";
$mv=$movies->find($_POST['id']);
$day=(strtotime($today)-strtotime($mv['date']))/(60*60*24);
for ($i=0; $i < (3-$day); $i++) { 
  ?>
  <option value="<?=date("Y-m-d",strtotime("+$i days"));?>"><?=date("m 月 d 日 l",strtotime("+$i days"));?></option>
  <?php
}
?>
