<?php
include "../base.php";
$ondate=$movie->find($_POST['id'])['ondate'];
$d=((strtotime($today)-strtotime($ondate))/(60*60*24));
$end=3-($d);
for ($i=0; $i < $end; $i++) { 
    ?>
    <option value="<?=date("Y-m-d",strtotime("+$i days"));?>"><?=date("m月d日l",strtotime("+$i days"));?></option>
    <?php
}