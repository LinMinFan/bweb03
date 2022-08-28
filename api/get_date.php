<?php
include "../base.php";

$ondate=(strtotime($today)-strtotime($movies->find($_POST['id'])['ondate']))/(60*60*24);
$seeday=3-$ondate;
for ($i=0; $i < $seeday; $i++) { 
    ?>
        <option value="<?=date("Y-m-d",strtotime("+$i days"));?>"><?=date("m 月 d 日 l",strtotime("+$i days"));?></option>
    <?php
}