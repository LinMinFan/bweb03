<?php
include "../base.php";

$ondate=$movies->find($_POST['id'])['ondate'];
$d=(strtotime($today)-strtotime($ondate))/(60*60*24);
for ($i=0; $i < (3-$d); $i++) { 
  ?>
  <option value="<?=date("Y-m-d",strtotime("+$i days"));?>"><?=date("m 月 d 日 l",strtotime("+$i days"));?></option>
  <?php
}